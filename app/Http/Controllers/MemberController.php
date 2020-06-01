<?php


namespace App\Providers;

namespace App\Http\Controllers;

use App\Member;
use Yajra\Datatables\Datatables;
use App\CollectionsType;
use App\Http\Requests\Painel\ProductFormRequest;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    private $user;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = \Auth::user();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $user = \Auth::user();
      if ($request->draw) {
        return Datatables::of($user->members)->make(true);
      } else {
        return view('members.all');//, compact('members'));
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('members.register');//, compact('classes', 'sections'));
     # return view('members.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // validate email
      $member = Member::where('email', $request->email)->get(['id'])->first();
      if($member){
        return response()->json(['status' => false, 'text' => "Este email ($request->email) já existe para um membro."]);
          // return redirect()->back()->with('status', "The email ($request->email) já existente para um membro.");
      }
      // validate Phone
      $member = Member::where('phone', $request->phone)->get(['id'])->first();
      if($member){
        return response()->json(['status' => false, 'text' => "Este telefone ($request->phone) já existe para um membro."]);
      }

        $user = \Auth::user();

        $relatives = null;

        // filter $_POST data for keys starting with 'relative'
        // if there's any, then one or more relatives have been assigned
        $array_of_relations_id = array_filter($_POST,
                                function ($key) {
                                    return substr($key,0,8) == 'relative' ? true : false;
                                },
                                ARRAY_FILTER_USE_KEY
                                );
        if (count($array_of_relations_id) > 0) {
            $relatives = [];
            foreach ($array_of_relations_id as $relative_id){

                $relationship = $_POST["relationship_{$relative_id}"];
                array_push($relatives, ['id'=>$relative_id, 'relationship'=>$relationship]);

            }
            $relatives = json_encode($relatives);
        }
        

        $this->validate($request, [
            'nome_completo' => 'bail|required|string|max:255',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dob' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'cpf' => 'required|string|max:255',
        ]);
        
        $image_name = 'profile.png'; // default profile image
      
      //  print $image_name;
        if ($request->hasFile('photo'))
        {
            $image = $request->file('photo');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/members');
            $image->move($destinationPath, $input['imagename']);
            $image_name = $input['imagename'];
        }

        $member = new Member(array(
            'branch_id' => $user->id,
            'nome_completo' => $request->get('nome_completo'),
            'email' => $request->get('email'),
            'dob' => date('d-m-Y',strtotime($request->get('dob'))),
            'phone' => $request->get('phone'),
            'occupation' => $request->get('occupation'),
            'position' => $request->get('position'),
            'address' => $request->get('address'),
            'bairro' => $request->get('bairro'),
            'postal' => $request->get('postal'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'country' => $request->get('country'),
            'sexo' => $request->get('sexo'),
            'estado_civil' => $request->get('estado_civil'),
            'wedding_anniversary' => date('d-m-Y',strtotime($request->get('wedding_anniversary'))),
            'cpf' => $request->get('cpf'),
            'rg' => $request->get('rg'),
            'batismo_status' => $request->get('batismo_status'),
            'data_batismo' => date('d-m-Y',strtotime($request->get('data_batismo'))),
            'status' => $request->status,
            'photo' => $image_name,

        ));

        $member->save();
        return response()->json(['status' => true, 'text' => "Membro registrado com sucesso!"]);
        // return redirect()->route('member.register.form')->with('status', 'Member Successfully registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member, $id)
    {
      $member = Member::find($id);
     // var_dump($member);
      $user = \Auth::user();
      // dd($user->members()->where('members.id', $id)->get());
      $c_types = CollectionsType::getTypes();
      // $sql = 'SELECT COUNT(case when attendance = "yes" then 1 end) AS present, COUNT(case when attendance = "no" then 1 end) AS absent,
      // MONTH(attendance_date) AS month FROM `members_attendances` WHERE YEAR(attendance_date) = YEAR(CURDATE()) AND member_id = '.$member->id.' GROUP BY month';
      $attendance = $member->attendances()->selectRaw("SUM(CASE when attendance = 'yes' then 1 else 0 end) As yes,
        SUM(CASE when attendance = 'no' then 1 else 0 end) As no")->first();//->sum('');
      // dd($attendance);
      return view('members.profile', compact('member', 'attendance', 'member', 'c_types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    
     public function edit($id){
    // Método responsável por carregar a tela de edição, buscando as informações conforme o membro selecionado e congregação(branch) selecionada.
    // Returna o html edit.blade.php
      $user = \Auth::user();
      $member = Member::whereId($id)->where('branch_id',$user->id)->first();
      
      $title = "Editar Membro: {$member->nome_completo}";
      //var_dump($member);
      if (!$member) { 
          return 'Membro não existe'; 
      } 
      return view('members.edit', compact('title','member'));
    }
    
    public function edit_1(Member $member) {
        $array = array('id' => $id);
        Validator::make($array, [
            'id' => 'required|integer|max:10',
        ])->validate();
        $subjects = Subject::all();
        $subject = Subject::whereId($id)->firstOrFail();
        var_dump($subjects);
        $edit = array('editmode' => 'true');
        $classes = TheClass::all();
        
        return view('subject.index', compact('subjects','subject', 'edit', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */

    public function modify($id){
    // Método responsável por carregar a tela de edição, buscando as informações conforme o membro selecionado e congregação(branch) selecionada.
    // Returna o html edit.blade.php
      $user = \Auth::user();
      $member = Member::whereId($id)->where('branch_id',$user->id)->first();
      //var_dump($member);
      if (!$member) { 
          return 'Membro não existe'; 
      } 
      return view('members.edit', compact('member'));
    }

        public function updateMember(Request $request){
            
             return 'Update Memeber'; 
        
      $member = Member::whereId($request->id)->first();
        
      if($member) {
        $errors = [];
        $fields = (array)$request->request;//->parameters;//->ParameterBag->parameters;
        $fields = $fields["\x00*\x00parameters"];
        foreach ($fields as $key => $value) {
          if ($key != 'id' && $key != '_token' && $key != 'action') {
              $member->$key = $request->$key;
          }
        }
        try {
          $member->save();
        } catch (\Exception $e) {
          array_push($errors, $e);
          // dd($e);
          return response()->json(['status' => false, 'text' => $e->errorInfo[2]]);
        }
      }
      else {
          return response()->json(['status' => false, 'text' => "Este Membro nao existe ou nao encontrado"]);
      }
      return response()->json(['status' => true, 'text' => "O Membro foi atualizado!"]);
    }
    
    public function update(Request $request, Member $member)
    {

       if (!empty($request->file('image'))){
           // validate image
           $this->validate($request, [
               'class_id' => 'bail|required|integer|min:1',
               'section_id' => 'required|integer|min:1',
               'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           ]);
           $image = $request->file('image');
           $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
           $destinationPath = public_path('/images');
           $image->move($destinationPath, $input['imagename']);
           $image_name = $input['imagename'];
       }

       //$member = Member::whereId('id')->firstOrFail();
        $member = Member::whereId($request->id)->firstOrFail();;;
              
      # $member->class_id = $request->get('class_id');
      # $member->section_id = $request->get('section_id');
       $member->nome_completo = $request->get('nome_completo');
       $member->email = $request->get('email');
       $member->dob = $request->get('dob');
       $member->phone = $request->get('phone');
       $member->occupation = $request->get('occupation');
       $member->position = $request->get('position');
       $member->address = $request->get('address');
       $member->bairro = $request->get('bairro');
       $member->postal = $request->get('postal');
       $member->city = $request->get('city');
       $member->state = $request->get('state');
       $member->country = $request->get('country');  
       $member->sexo = $request->get('sexo');
       $member->estado_civil = $request->get('estado_civil');
       $member->wedding_anniversary = $request->get('wedding_anniversary');
       $member->cpf = $request->get('cpf');
       $member->rg = $request->get('rg');
       $member->batismo_status = $request->get('batismo_status'); 
       $member->data_batismo = $request->get('data_batismo');
       $member->status = $request->get('status');
       $member->photo = $request->get('photo');
       if (!empty($image_name) && ($image_name!== NULL)) $member->photo = $image_name;

       $member->save();
       return redirect(action('MemberController@index', $member->id))->with('status', 'Registro de membro atualizado com sucesso!');
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member, $id)
    {
      $member = Member::whereId($id)->firstOrFail();
      $member->delete();
      return response()->json(['status' => true, 'text' => "$member->nome_completo has been deleted!"]);
    }

    public function delete(Request $request){
      $failed = 0;
      $text = "All selected members deleted successfully";
      foreach ($request->id as $key => $value) {
        # code...
        $member = Member::whereId($value)->first();
        if($member){
          $member->delete();
        } else {
          $failed++;
          $text = "$failed Operations could not be performed";
        }
      }
      return response()->json(['status' => true, 'text' => $text]);
    }

    public function getRelative(Request $request, $search_term){

      $user = \Auth::user();

      $sql = "SELECT * from members WHERE branch_id = '$user->id' AND  MATCH (nome_completo,)
      AGAINST ('$search_term')";
      $members = \DB::select($sql);
      return response()->json(['success' => true, "result"=> sizeof($members) > 0 ? $members : ['message'=>'no result found']]);
    }

    public function upgrade(Request $request){
      $status = false;
      $user = Member::where('id', $request->id)->first()->upgrade();
      if ($user) { $status = true; $text = "$user is now a full member"; }
      else { $text = "Error occured Please try again"; }
      return response()->json(['status' => $status, 'text' => $text]);
    }

    public function uploadImg(Request $request){
      $image_name = 'profile.png'; // default profile image
      if ($request->hasFile('photo'))
      {
          $image = $request->file('photo');
          $input['imagename'] = ($image->getClientOriginalExtension() != '') ? time().'.'.$image->getClientOriginalExtension() : time().'.jpg';
          print_r($input);

          $destinationPath = public_path('/images');

          $image->move($destinationPath, $input['imagename']);

          $image_name = $input['imagename'];

          $user = Member::orderBy('id', 'desc')->first();
          $user->photo = $image_name;
          $user->save();
          return response()->json(['status' => true,]);
      }
      return response()->json(['status' => false, 'text' => "No photo file"]);
    }

    public function testMail(Request $request){
      return new \App\Mail\MailToMember($request, \Auth::user());
    }


    public function attendance($id, Request $request){
      $member = Member::find($id);
      if ($member) {  $member = $member->attendances()->with(['service_types'])->get(); }
      // dd($member);
      return Datatables::of($member)->make(true);
    }

  public function memberAnalysis (Request $request){
    $user = \Auth::user();
    $c_types = \App\CollectionsType::getTypes();
    $savings = \App\MemberCollection::rowToColumn(\App\MemberCollection::where('branch_id', $user->id)->where('member_id', $request->id)->get());
    $interval = $request->interval;
    $group = $request->group;
    $months = [];
    for ($i = $interval-1; $i >= 0; $i--) {
      $t = 'M';
      switch ($group) {
        case 'day': $t = 'D'; break;
        case 'week': $t = 'W'; break;
        case 'month': $t = 'M'; break;
        case 'year': $t = 'Y'; break;
      }
      $dateOrNot = $group == 'month' ? date('Y-m-01') : '';
      $months[$i] = date($t, strtotime($dateOrNot. "-$i $group")); //1 week ago
    }
    $collections2 = $this->calculateSingleTotal($savings, $group);
    $dt = (function($savings, $c_types, $months, $group){
      $output = [];
      foreach ($months as $key => $value) {
  		$month = $value; $found = false;
  		foreach ($savings as $collection) {
  			if($value == $collection->$group){
  				$found = true;
          $output[] = $this->yData($collection, $c_types, $value);
  			}
  		}
  		if(!$found){
  			$output[] = $this->noData($c_types, $value);
  		}
  	}
    return $output;
  })($collections2, $c_types, $months, $group);
    // dd($dt);
    return response()->json($dt);
  }

  private function yData($collection,$c_types, $value){
    $y = new \stdClass();
    $y->y = $value;  $i = 1; $size = sizeof($c_types);
    foreach ($c_types as $key => $value) {
      $name = $value->name;
      $amount = isset($collection->$name) ? $collection->$name : 0;
      $y->$name = $amount;
      $i++;
    }
    return $y; //. "},";
  }

  private function noData($c_types, $value){
    $y = new \stdClass();
    $y->y = $value; $i=1;
    foreach ($c_types as $key => $value) {
      $name = $value->name;
      $y->$name = 0;
      $i++;
    }
    return $y;//. "},";
  }

  private function calculateSingleTotal($savings, $type){
    $obj = [];
    foreach ($savings as $key => $value) {
      switch ($type) {
        case 'day': $t = 'D'; break;
        case 'week': $t = 'W'; break;
        case 'month': $t = 'M'; break;
        case 'year': $t = 'Y'; break;
      }
      $date = date($t, strtotime($value->date_collected));
      $year = (int)substr($value->date_collected, 0,4);
      foreach ($value->amounts as $ke => $valu) {
        if (isset($obj[$date])) {
          if (isset($obj[$date]->$ke)) {  $obj[$date]->$ke += $valu; } else { $obj[$date]->$ke = $valu; }
        } else {
          $obj[$date] = new \stdClass();
          $obj[$date]->$ke = $valu;
          $obj[$date]->$type = $date;
        }
      }
    }
    return $obj;
  }
// count(case when sex = 'Masculino' then 1 end) AS Masculino, count(case when sex = 'Feminino' then 1 end) AS Feminino,
  public function memberRegStatus(Request $request){
    $user = \Auth::user();
    $members = Member::selectRaw("COUNT(id) as total, SUM(CASE WHEN sexo='Masculino' THEN 1 ELSE 0 END) AS Masculino, SUM(CASE WHEN sexo='Feminino' THEN 1 ELSE 0 END) AS Feminino,
    MONTH(member_since) AS month")->whereRaw("member_since > DATE(now() + INTERVAL - 12 MONTH)")->where("branch_id", $user->id)->groupBy("month")->get();
    // dd($members);
    $group = 'month';
    $months = [];
    $interval = 0;
    $ii = 11;
    $c_types = Array('Masculino', 'Feminino');
    for ($i = $interval; $i <= 11; $i++) {
      $t = 'M';
      switch ($group) {
        case 'day': $t = 'D'; break;
        case 'week': $t = 'W'; break;
        case 'month': $t = 'M'; break;
        case 'year': $t = 'Y'; break;
      }
      $dateOrNot = $group == 'month' ? date('Y-m-01') : '';
      $months[$ii] = date($t, strtotime($dateOrNot. "-$i $group")); //1 week ago
      $ii--;
    }

    $dt = (function($members, $c_types, $months, $group){
      $output = [];
      foreach ($months as $key => $value) {
  		$month = $value; $found = false;
  		foreach ($members as $member) {
        $m;
        switch ($member->$group) {
          case 1: $m = 'Janeiro'; break;
          case 2: $m = 'Fevereiro'; break;
          case 3: $m = 'Março'; break;
          case 4: $m = 'Abril'; break;
          case 5: $m = 'Maio'; break;
          case 6: $m = 'Junho'; break;
          case 7: $m = 'Julho'; break;
          case 8: $m = 'Agosto'; break;
          case 9: $m = 'Setembro'; break;
          case 10: $m = 'Outubro'; break;
          case 11: $m = 'Novembro'; break;
          case 12: $m = 'Dezembro'; break;
        }
        // dd($m);
  			if($month == $m){
  				$found = true;
          $output[] = $this->flotY($member, $c_types, $key);
  			}
  		}
  		if(!$found){
  			$output[] = $this->flotNoData($c_types, $key);
  		}
  	}
    return $output;
  })($members, $c_types, $months, $group);

  return $dt;
  }

  private function flotY($member, $c_types, $value){
    $y = [];
    $y['month'] = $value;  $i = 1; $size = sizeof($c_types);
    foreach ($c_types as $key => $value) {
      $name = $value;
      $amount = isset($member->$name) ? $member->$name : 0;
      $y[$name] = $amount;
      $i++;
    }
    return $y;
  }

  private function flotNoData($c_types, $value){
    $y = [];
    $y['month'] = $value; $i=1;
    foreach ($c_types as $key => $value) {
      $name = $value;   $y[$name] = 0;    $i++;
    }
    return $y;
  }

  public function calculateSingleTotalCollection($savings, $type){
    $obj = [];
    foreach ($savings as $key => $value) {
      switch ($type) {
        case 'day': $t = 'D'; break;
        case 'week': $t = 'W'; break;
        case 'month': $t = 'M'; break;
        case 'year': $t = 'Y'; break;
      }
      $date = date($t, strtotime($value->date_collected));
      $year = (int)substr($value->date_collected, 0,4);

      if ($type == 'year') {
        foreach ($value as $k => $v) {
          // dd($savings);
          $year = substr($k, 0,4);
          foreach ($v['amounts'] as $savingName => $savingAmount) {
            if (!isset($obj->$savingName)) {$obj->$savingName = new \stdClass();}
            if (isset($obj->$savingName->$year)) {
              $obj->$savingName->$year += $savingAmount;
            } else {
              $obj->$savingName->$year = $savingAmount;
            }
          }
        }
      }
    }
    return $obj;
  }
}
