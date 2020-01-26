@extends('layouts.index')

@section('title', 'Panel de Escritorio')

@section('css')
    @parent
 <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/selectlist/src/bootstrap-duallistbox.css')}}">
 <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
@endsection
@section('guia')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-0">Dashboard</h4>
                    <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Busqueda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Consultar</li>
                    </ol>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection


@section('content')
 
<div class="container-fluid">
  
<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <h4 class="card-header mt-0">Error</h4>
                            <div class="card-body">
                                <a type="button" href="{{route('home')}}" class="btn btn-secondary btn-lg btn-block waves-effect waves-light"  >
                                    <i class="ion-home"></i> Inicio
                                </a>
                            </div>
                                
                            </div>
                                
                        </div>
                                
                    </div>
                                
                </div>

@endsection