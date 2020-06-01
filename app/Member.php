<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [
        'id', 
        'nome_completo', 
        'cpf',
        'rg', 
        'dob', 
        'email',
        'phone', 
        'occupation', 
        'position',
        'batismo_status', 
        'data_batismo',
        'postal', 
        'address', 
        'bairro',
        'city', 
        'state', 
        'country',
        'sexo', 
        'estado_civil',
        'wedding_anniversary', 
        'status'
        ];

  
    public function getFullname(){
      return "$this->nome_completo";
    }

    public function InGroup($group_id){

        $count = \App\GroupMember::where('member_id', $this->id)->where('group_id', $group_id)->get()->count();

        return $count > 0 ;
    }

    public static function getNameById($id){
      return \DB::table('members')->select('nome_completo')->where('id',$id)->orderby('nome_completo')->first();
    }

    public static function getNameByEmail($email){
      if($std = Member::select('nome_completo')->where('email',$email)->orderby('nome_completo')->first()){
        $name = $std->nome_completo;
        return $name;
      }
      return null;
    }

    public static function getPhotoByEmail($email){
      return $std = Member::select('photo')->where('email',$email)->first()->photo;
    }

  public function upgrade(){
    $this->member_status = 'old';
    $this->save();
    return $this->getFullname();
  }

  public function profile(){
    return route('member.profile', ['id' => $this->id]);//../member/profile/${id}
  }

  public function groupMember(){
    return $this->belongsTo(GroupMember::class);
  }

  public function user(){
    return $this->belongsTo(User::class);
  }

  public function member_savings(){
    return $this->hasMany(MemberSavings::class);
  }

  public function attendances(){
    return $this->hasMany(MemberAttendance::class);
  }
}
