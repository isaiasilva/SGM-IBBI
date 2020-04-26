
@extends('layouts.app')

@section('title') Todos Membros @endsection

@section('content')
<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <div id="page-head">

        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Membros</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li>
                <a href="forms-general.html#">
                    <i class="demo-pli-home"></i>
                </a>
            </li>
            <li>
                <a href="forms-general.html#">Membros</a>
            </li>
            <li class="active">Todos</li>
        </ol>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End breadcrumb-->

    </div>


    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
    <div class="row">
					        
					        <div class="col-md-4 col-md-offset-4" >
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
					
					
					            <!-- Line Chart -->
					            <!---------------------------------->
					            <div class="panel" style="padding-top:45px;padding-bottom:45px;margin-bottom:250px">
					                <div class="panel-heading">
					                    <h3 class="panel-title">Selecionar data para participação</h3>
					                </div>
					                <div class="pad-all">
                                    <form method="POST" action="{{route('attendance.selectDate')}}">
                                    @csrf
                                        <input type="date" name="date" style="padding:4px;border-radius:2px;border:1px solid #ccc"/>
                                        <button type="submit" class="btn btn-success btn-md">CONTINUE</button>
					                </form>
                                    </div>
					            </div>
					            <!---------------------------------->
					
					
                            </div>
                            
					    </div>
					
					


    </div>
    <!--===================================================-->
    <!--End page content-->

</div>
<!--===================================================-->
<!--END CONTENT CONTAINER-->
@endsection


