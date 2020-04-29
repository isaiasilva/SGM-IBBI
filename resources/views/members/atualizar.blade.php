
@extends('layouts.app')

@section('title') Atualização de Membros @endsection

@section('link')
<link href="{{ URL::asset('css/cam-style.css') }}" rel="stylesheet">
<!-- inline style -->
<style media="screen">
    .element {
        display: inline-flex;
        align-items: center;
    }
    i.fa-camera {
        margin: 10px;
        cursor: pointer;
        font-size: 30px;
    }
    i:hover {
        opacity: 0.6;
    }
    input {
        display: none;
    }
</style>
@endsection

@section('content')

<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Breadcrumb-->
    <div id="page-head">
        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Atualizar Membro</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->
        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home"></i><a href="{{route('dashboard')}}"> Dashboard</a>
            </li>
            <li class="active">Atualizar Membro</li>
        </ol>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End breadcrumb-->
    </div>
    <!--FIM Breadcrumb-->


<?php
            $id = $member->id;
            $nome_completo = $member->nome_completo;
            $cpf = $member->cpf;
            $rg = $member->rg;
            $address = $member->address;
            $bairro = $member->bairro;
            $dob = $member->dob;
            $email = $member->email;
            $phone = $member->phone;
            $position = $member->position;            
            $postal = $member->postal;   
            $city = $member->city;
            $state = $member->state;
            $country = $member->country;
            $occupation = $member->occupation;
            $sexo = $member->sexo;
            $estado_civil = $member->estado_civil;
            $status = $member->status;
            $batismo_status = $member->batismo_status;
            $data_batismo = $member->data_batismo;            
            $wedding_anniversary = $member->wedding_anniversary;
            $photo = $member->photo;

?>
    
    <!--Page content PARTE 01-->
    <!--===================================================-->
    <div id="page-content">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel rounded-top" style="background-color: #e8ddd3;">
                    <div class="panel-heading">
                        <h1 class="text-center" style="padding-top:5px">Atualizar Membro</h2>
                    </div>
                    <div class="col-lg-10 col-lg-offset-2">
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                        @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                        @endif
                    </div>


                    <div class="row panel-body" style="background-color: #e8ddd3;">
                        <div class=""  style="border:1pt solid #090c5e; border-radius:25px;">
                            <!-- BASIC FORM ELEMENTS -->
                            <!--===================================================-->
                            <form id="atualizar-form" method="POST" action="{{route('member.atualizar')}}" class="panel-body form-horizontal form-padding" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <!--Static-->
                                    <div class="form-group" >
                                        <label class="col-md-3 control-label" for="demo-readonly-input">Congregação</label>
                                        <div class="col-md-9">
                                            <input type="text" id="branch_id" value="{{\Auth::user()->branchcode}}" class="form-control" placeholder="Readonly input here..." readonly>
                                        </div>
                                    </div>

                                    <!--NOME-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="demo-text-input">Nome</label>
                                        <div class="col-md-9">
                                            <input type="text" id="nome_completo" name="nome_completo" value="{{$nome_completo}}" class="form-control" placeholder="Informe o Nome" required>
                                        </div>
                                    </div>
                                    <!--CPF-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="demo-text-input">CPF</label>
                                        <div class="col-md-9">
                                            <input type="text" id="cpf" value="{{$cpf}}" name="cpf" class="form-control" placeholder="CPF" required>
                                        </div>
                                    </div>
                                    <!--RG-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="demo-text-input">RG</label>
                                        <div class="col-md-9">
                                            <input type="text" id="rg" value="{{$rg}}" name="rg" class="form-control" placeholder="RG" required>
                                        </div>
                                    </div>


                                    <!--DATA NASCIMENTO-->
                                    <div class="form-group">
                                    <label class="col-md-3 control-label" for="demo-text-input">Data de Nascimento</label>
                                    <div class="col-md-9">
                                        <input id="dob" type="text" placeholder="Data de Nascimento" value="{{$dob}}" name="dob" class="datepicker form-control" required/>
                                    </div>
                                </div>

                                    <!--EMAIL-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="demo-email-input">Email</label>
                                        <div class="col-md-9">
                                            <input id="email" type="email" id="demo-email-input" value="{{$email}}" class="form-control" name="email" placeholder="Informe o email" required>
                                        </div>
                                    </div>
                                    <!--TELEFONE-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="demo-email-input">Telefone (WhatsApp)</label>
                                        <div class="col-md-9">
                                            <input id="phone" type="text" class="form-control" name="phone" value="{{$phone}}" placeholder="Digite o número do celular" required>
                                        </div>
                                    </div>




                                    <!--PROFISSAO-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="demo-email-input">Profissão</label>
                                        <div class="col-md-9">
                                            <input id="occupation" type="text" value="{{$occupation}}" class="form-control" name="occupation" placeholder="Informe sua profissão">
                                        </div>
                                    </div>
                                    <!--FUNCAO ECLESIASTICA-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="demo-text-input">Função Eclesiástica</label>
                                        <div class="col-md-9">
                                            <select name="position" class="selectpicker col-xs-6 col-sm-4 col-md-6 col-lg-9" data-style="btn-success">
                                                <option selected value="{{$position}}">{{$position}}</option>
                                                <option value="Membro">Membro</option>
                                                <option value="Pastor Presidente">Pastor Presidente</option>
                                                <option value="Pastor">Pastor</option>
                                                <option value="Pastor Auxiliar">Pastor Auxiliar</option>
                                                <option value="Administrador">Administrador</option>
                                                <option value="1º Secretário">1º Secretário</option>
                                                <option value="2º Secretário">2º Secretário</option>
                                                <option value="1º Tesoureiro">1º Tesoureiro</option>
                                                <option value="2º Tesoureiro">2º Tesoureiro</option>
                                                <option value="Funcionário">Funcionário</option>
                                                <option value="Corista">Corista</option>
                                                <option value="Técnico">Técnico</option>
                                                <option value="Instrumentista">Instrumentista</option>
                                                <option value="Diácono/Obreiro">Diácono/Obreiro</option>
                                                <option value="Lider de Ministerio">Lider de Ministerio</option>
                                                <option value="Evangelista">Evangelista</option>
                                                <option value="Missionário">Missionário</option>
                                                <option value="Músico">Músico</option>
                                                <option value="Produtor">Produtor</option>
                                                <option value="Sonoplasta">Sonoplasta</option>
                                                <option value="Sem Função">Sem Função</option>
                                                <option value="Outros">Outros</option>
                                            </select>
                                        </div>
                                    </div>

                            <!--É BATIZADO?-->
                            <div class="form-group pad-ve">
                                    <label class="col-md-3 control-label">É Batizado?</label>
                                    <div class="col-md-9">
                                        <div class="radio">
                                            <input id="demo-inline-form-radio" class="magic-radio" value="SIM" type="radio" name="batismo_status" <?php if($batismo_status == 'sim'){echo 'checked';}?> >
                                            <label for="demo-inline-form-radio">SIM</label>
                                            <input id="demo-inline-form-radio-2" class="magic-radio" value="NÃO" type="radio" name="batismo_status" <?php if($batismo_status == 'nao'){echo 'checked';}?> >
                                            <label for="demo-inline-form-radio-2">NÃO</label>
                                        </div>
                                    </div>
                            </div>



                               <!--DATA BATISMO-->
                                <div id="wedding_batismo" class="form-group" style="display:none">
                                    <label class="col-md-3 control-label" for="demo-text-input">Data de Batismo</label>
                                    <div class="col-md-9">
                                        <input id="data_batismo"  type="text" placeholder="Data de Batismo" value="{{$data_batismo}}" name="data_batismo" class="datepicker form-control"/>
                                    </div>
                                </div>
                               

                                </div>

                                 <!--CEP-->
                                <div class="col-md-6">
                                    <?php $ipInfo = app('App\Http\Controllers\VisitorController')->ip_info(app('App\Http\Controllers\VisitorController')->getUserIP(), "Location"); ?>
                                    <?php if ($ipInfo['continent'] != 'Africa') { ?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="demo-textarea-input">CEP</label>
                                            <div class="col-md-9">
                                                <input id="postal" type="text" class="form-control" value="{{$postal}}" name="postal" placeholder="Informe o CEP" onblur="pesquisacep(this.value);" />
                                            </div>
                                        </div>
                                    <?php } ?>


                                    <!--ENDERECO-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="demo-textarea-input">Endereço</label>
                                        <div class="col-md-9">
                                            <input id="address" type="text" class="form-control"  value="{{$address}}" name="address" rows="2" placeholder="Informe o Endereço" required>
                                        </div>
                                    </div>
                                    
                                    <!--BAIRRO-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="demo-textarea-input">Bairro</label>
                                        <div class="col-md-9">
                                            <input id="bairro" type="text" class="form-control" value="{{$bairro}}" name="bairro" placeholder="Informe o Bairro" required>
                                        </div>
                                    </div>

                                    <!--CIDADE-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="demo-textarea-input">Cidade</label>
                                        <div class="col-md-9">
                                            <input id="city" type="text" class="form-control" value="{{$city}}" name="city" placeholder="Informe a Cidade" required>
                                        </div>
                                    </div>
                                    <!--ESTADO-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="demo-textarea-input">Estado</label>
                                        <div class="col-md-9">
                                            <input id="state" type="text" class="form-control" value="{{$state}}" name="state" placeholder="Informe o Estado" required>
                                        </div>
                                    </div>
                                    <!--PAIS-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="demo-textarea-input">Pais</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="country" placeholder="Informe o País">
                                                <option selected value="{{$country}}">{{$country}}</option>
                                            </select>
                                        </div>
                                    </div>

                            <!--SEXO-->
                            <div class="form-group pad-ve">
                                <label class="col-md-3 control-label">Sexo</label>
                                <div class="col-md-9">
                                        <div class="radio">
                                        <input id="demo-form-radio" class="magic-radio" value="masculino" type="radio" name="sexo" <?php if($sexo == 'Masculino'){echo 'checked';}?> >
                                        <label for="demo-form-radio">Masculino</label>
                                        <input id="demo-form-radio-2" class="magic-radio" value="feminino" type="radio" name="sexo" <?php if($sexo == 'Feminino'){echo 'checked';}?> >
                                        <label for="demo-form-radio-2">Feminino</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Estado Civil</label>
                                <div class="col-md-9">
                                    <div class="col-md-9">
                                        <select class="form-control" id="estado_civil" name="estado_civil" >
                                            <option selected value="{{$estado_civil}}">{{$estado_civil}}</option>
                                            <option value="Solteiro(a)">Solteiro(a)</option>
                                            <option value="Casado(a)">Casado(a)</option>
                                            <option value="Viúvo(a)">Viúvo(a)</option>
                                            <option value="Divorciado(a)">Divorciado(a)</option>
                                            <option value="Separado(a)">Separado(a)</option>
                                        </select>
                                    </div>
                                </div>   
                            </div>


                            <!--DATA CASAMENTO-->
                            <div id="wedding" class="form-group" style="display:none">
                                <label class="col-md-3 control-label" for="demo-text-input">Aniversário de Casamento</label>
                                <div class="col-md-9">
                                    <input id="wedding_anniversary" value="{{$wedding_anniversary}}" type="text" placeholder="Aniversário Casamento" name="wedding_anniversary" class="datepicker form-control"/>
                                </div>
                            </div>


                            <!--STATUS-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="demo-text-input">Status</label>
                                <div class="col-md-9">
                                    <div class="col-md-9">
                                        <select class="form-control" name="status">
                                            <option selected value="{{$status}}">{{$status}}</option>
                                            <option value="Ativo">Ativo</option>
                                            <option value="Inátivo">Inátivo</option>
                                            <option value="Visitante">Visitante</option>
                                            <option value="Congregando">Congregando</option>
                                            <option value="Óbito">Óbito</option>
                                        </select>
                                    </div>  
                                </div>                               
                            </div>

                                <!--FOTO-->  
                                                               
                                    <label class="col-md-3 control-label">Foto</label>
                                    <div class="col-md-8">
                                        <div class="btn btn-file element" >
                                            <i class="fa fa-3x fa-folder"></i>
                                            <span class="name">Escolher Arquivo</span>
                                            <input id="photo" type="file" accept="image/members" name="photo">
                                        </div>

                                        <div class="btn element" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-camera"></i>
                                            <span class="name">Câmera Frontal</span>
                                            <input id="photo_frontal" type="file" accept="image/members" capture name="photo" style="display: none">
                                        </div>

                                        <div class="image" id="img-show-container" style="display: none" onclick="resetImgUpl()">
                                            <canvas id="img-show" class="img-thumbnail img-response" style="padding-top:-100px"></canvas>
                                        </div>
                                    </div>
                                </div>
                                 
                                <div class="col-md-9">
                                    <span class=" pull-right">
                                        <button id="submit" class="btn btn-info pull-center" type="submit">SALVAR</button>
                                    </span>
                                </div>
                                
                                
                                <div class="col-md-3">
                                    <span class=" pull-right">
                                        <button class="btn-danger" align="center" onclick="resetForm('#atualizar-form')" >LIMPAR</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>


                    <!--===================================================-->
                    <!-- END BASIC FORM ELEMENTS -->
                    <!--Default Bootstrap Modal-->
                    <!--===================================================-->
                    <div class="modal fade" id="demo-default-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!--Modal header-->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                                    <h4 class="modal-title">Add a Relative</h4>
                                </div>


                                <!--Modal body-->
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="demo-email-input">Search Relative</label>
                                        <div class="col-md-10">
                                            <input type="text" id="search-relative-input" class="form-control" name="name" placeholder="Enter relative Name">
                                        </div>
                                    </div>

                                    <div class="col-md-12" id="relatives-result-container"></div>
                                </div>

                                <!--Modal footer-->
                                <div class="modal-footer">
                                    <button data-dismiss="modal" id="close-modal-btn" class="btn btn-default" type="button">Close</button>
                                    <button class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- ==============CAMERA FRONTAL================ -->
                    <div class="panel-footer panel-primary bg-dark">
                        <!-- Modal -->
                        
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="fa fa-3x close" onclick="stopWebcam();"  data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Tire uma foto</h4>
                                    </div>
                                    
                                    <div class="modal-body">
                                        <div id="captured" class="" style="display:none">
                                            <h3 class="text-primary">	Screenshots : <h3>
                                                    <canvas  id="myCanvas" width="400" height="350"></canvas>
                                        </div>
                                                  
                                        <div id="container-cam">
                                            <button class="btn btn-warning" onclick="startWebcam();">CLIQUE AQUI PARA INICIAR A WebCam</button>
                                            <div id="vid_container">
                                                <video id="video" autoplay playsinline></video>
                                                <div id="video_overlay"></div>
                                            </div>
                                            <div id="gui_controls">
                                                <button id="switchCameraButton" class="button" name="switch Camera" type="button" aria-pressed="false"></button>
                                                <button id="takePhotoButton" class="button" name="take Photo" type="button"></button>
                                                <button id="toggleFullScreenButton" class="button" name="toggle FullScreen" type="button" aria-pressed="false" style="display:none"></button>
                                            </div>
                                        </div>
                                    </div>
                                            <div class="modal-footer">
                                                <button id="choose-img" type="button" onclick="choose(canvas); stopWebcam();" class="btn btn-success" data-dismiss="modal" style="display:none">Selecione a imagem</button>
                                                <button type="button" onclick="stopWebcam();" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
<!--===================================================-->
<!--End Default Bootstrap Modal-->
</div>
</div>
</div>
</div>
<!--===================================================-->
<!--End page content-->
</div>
                                                    <!--===================================================-->
                                                    <!--END CONTENT CONTAINER-->

                                                    @endsection

@section('js')
<script src="{{ URL::asset('js/cam/DetectRTC.min.js')}}"></script>
<script src="{{ URL::asset('js/cam/adapter.min.js')}}"></script>
<script src="{{ URL::asset('js/cam/screenfull.min.js')}}"></script>
<script src="{{ URL::asset('js/cam/howler.core.min.js')}}"></script>
<script src="{{ URL::asset('js/cam/main.js')}}"></script>

       <script>
        function uploadImg() {
            var input = document.querySelector('input[type=file]');
            var file = input.files[0];
            var form = new FormData(),
                    xhr = new XMLHttpRequest();
            // form.append("filename", imageData);
            // console.log(file);
            console.log(blobs);
            form.append('photo', blobs);
            // form.append('photo', file);
            form.append('_token', "{{csrf_token()}}");
            xhr.open('post', "{{route('member.upload.img')}}", true);
            xhr.send(form);
        }
        $(document).ready(function () {
            // Upload file section
            // $("i").click(function () {
            //   $("input[type='file']").trigger('click');
            // });

            $('input[type="file"]').on('change', function () {
                var val = $(this).val();
                $(this).siblings('span').text(val);
            })

            //new
            var input = document.querySelector('input[type=file]'); // see Example 4

            input.onchange = function () {
                var file = input.files[0];

                // upload(file);
                drawOnCanvas(file);   // see Example 6
                // displayAsImage(file); // see Example 7
            };


              //JQuery Javascript (Exibe data de casamento, se status casado selecionado)
               $('#estado_civil').on('change', function () {
                 if (this.value == 'Casado(a)') {
                        $('#wedding').show();
                        $("#wedding_anniversary").prop('required', true);
                    } else {
                        $('#wedding').hide();
                        $("#wedding_anniversary").prop('required', false);
                    }
                });

                // JQuery Javascript (Exibe data de Batismo, caso a pergunta é Batizado=SIM)
                $('input:radio[name="batismo_status"]').change(
                    function(){
                        if(this.checked && this.value == 'sim'){
                            $('#wedding_batismo').show();
                            $("#data_batismo").prop('required',true);
                        }
                        else{
                            $('#wedding_batismo').hide();
                            $("#data_batismo").prop('required',false);
                        }
                    });


            // handle atualizar form submission
            $('#atualizar-form').on('submit', (e) => {
                e.preventDefault()
                toggleAble('#submit', true, 'Atualizando Membro...')
                // let data = {}
                let input = document.querySelector('#img-input')
                data = $('#atualizar-form').serializeArray()
                //send to db route
                $.ajax({url: "{{route('member.atualizar')}}", data, type: 'GET'})
                        .done((res) => {
                            if (res.status) {
                                swal("Success!", res.text, "success");
                                uploadImg()
                                resetForm('#atualizar-form')
                                resetImgUpl()
                                toggleAble('#submit', false)
                            } else {
                                swal("Oops", res.text, "error");
                                toggleAble('#submit', false)
                            }
                        })
                        .fail((e) => {
                            swal("Oops", "Internal Server Error", "error");
                            toggleAble('#submit', false)
                            console.log(e);
                        })
            })
        });

        let html = `<div class="form-group">
                                        <label class="col-md-3 control-label">Relative</label>
                                        <div class="col-md-9">
                                        <button id="add-relative-btn"  class="btn btn-danger"type="button">Add Relative</button>
                                        </div>
                                </div>`;
        $('#add-relative-btn').on('click', function () {

            $('#open-modal-btn').trigger('click');


            //$('#add-relative-btn').parents('.form-group').after(html)
        })

        function remove_relative(id) {

            $(`#container_relative_${id}`).remove()
        }

        function add_relative(id, name) {
            $('#add-relative-btn').parents('.form-group').after(`<div class="form-group" id="container_relative_${id}">
                                        <label class="col-md-3 control-label">Added Relative</label>
                                        <div class="col-md-9">
                <input  value="${name}" readonly>
                <input name="relative_${id}" value="${id}" hidden=hidden>
                                        <select name="relationship_${id}" class="selectpicker" style="border:1px solid #ccc;display:inline !important;outline:none" data-style="btn-success" required>
                                        <option value="relative">Relationship</option>
                                                <option value="husband">Husband</option>
                                                <option value="wife">Wife</option>
                                                <option value="brother">Brother</option>
                                                <option value="sister">Sister</option>
                                                <option value="father">Father</option>
                                                <option value="mother">Mother</option>
                                                <option value="son">Son</option>
                                                <option value="daughter">Daughter</option>
                                        </select>
                                        <button  class="btn btn-xs btn-danger"type="button" onClick="remove_relative(${id})">Remove Relative</button>
                                        </div>
                                </div>`)

            $('#close-modal-btn').trigger('click');
            $('#relatives-result-container').html('')
            $('#search-relative-input').val('')

        }
        $('#search-relative-input').on('keyup', function () {
            //alert('hello')
            $('#relatives-result-container').html('<img class="center-block" width="50" height="50" src="../images/spinner.gif"/>')
            let search_term = $('#search-relative-input').val()
            $.ajax({
                url: `../get-relative/${search_term}`,

            }).done(function (data) {
                console.log(data.result)
                //console.log(typeof data)
                $('#relatives-result-container').html('')

                if (typeof data.result == 'string' || data.result.message) {
                    $('#relatives-result-container').html('<span style="height:50px" class="text-info">No result found</span>')
                    return
                }
                console.log(typeof data.result)
                for (let person in data.result) {
                    console.log(data.result[person])
                    let table = `<div class="col-md-12" style="margin-bottom:10px"><span class="text-info" style="margin-right:30px;width:100px !important">${data.result[person].firstname} ${data.result[person].lastname}</span> <button onClick="add_relative(${data.result[person].id},'${data.result[person].firstname} ${data.result[person].lastname}' )" type="button" class="btn-sm btn btn-info select-relativ
        e">Select Relative</button></div>
                                                        `;
                    $('#relatives-result-container').append(table)
                }
            }).fail(function () {
                $('#relatives-result-container').html('<span style="height:50px" class="text-info">No result found</span>')
            })
        })

        $(document).ready(() => {
            init()
        })

        //--------------------
        // GET USER MEDIA CODE
        //--------------------
        navigator.getUserMedia = (navigator.getUserMedia ||
                navigator.webkitGetUserMedia ||
                navigator.mozGetUserMedia ||
                navigator.msGetUserMedia);

        var video;
        var webcamStream;

   
        function stopWebcam() {
            // if (webcamStream) {
            //    webcamStream.getTracks().forEach(function (track) { track.stop(); });
            // }
            if (window.stream) {
                window.stream.getTracks().forEach(function (track) {
                    track.stop();
                });
            }
            // webcamStream.stop();
        }
        //---------------------
        // TAKE A SNAPSHOT CODE
        //---------------------
        var canvas, ctx;

        function init() {
            // Get the canvas and obtain a context for
            // drawing in it
            canvas = document.getElementById("myCanvas");
            ctx = canvas.getContext('2d');
        }

        function snapshot() {
            // Draws current image from the video element into the canvas
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
        }


          function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('address').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('city').value=("");
            document.getElementById('state').value=("");
          //  document.getElementById('country').value=("");
            
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('address').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('city').value=(conteudo.localidade);
            document.getElementById('state').value=(conteudo.uf);
           // document.getElementById('country').value=(conteudo.pais);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }

    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('address').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('city').value="...";
                document.getElementById('state').value="...";
             //   document.getElementById('country').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };
                                                            
</script>
@endsection

