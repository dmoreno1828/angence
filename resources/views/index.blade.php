
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
    <form method="post"  id="formulario">
        @csrf
<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <h4 class="card-header mt-0">Por Consultor</h4>
                            <div class="card-body">
       
<div class="row">
                    <div class="col-lg-10">
                        <div class="card">
                            
                            <div class="card-body">
       

                                     <div class="form-group mb-10">
                                        <label>Periodo</label>
                                        <div class="row">
                                             <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="text" required class="form-control" placeholder="dd/mm/yyyy" name="inicio" id="inicio">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                    </div>
                                                </div>
                                             </div>
                                             <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="text" required class="form-control" placeholder="dd/mm/yyyy"  name="final"  id="final">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                    </div>
                                                </div>
                                             </div>
                                        </div>
                                    </div>
                
    <div class="form-group mb-10">
                                        <label>Consultores</label>
                                        <div>
  <select multiple="multiple" id="consultores" size="10" name="consultores[]" required title="consultores[]" class="form-control">
    @foreach ($consultores as $item)
        
    <option value="{{$item->identificacion}}" @if(Route::currentRouteName()=='informacion' || Route::currentRouteName()=='barras' || Route::currentRouteName()=='tortas') @if(in_array($item->identificacion, $input['consultores'])) selected @endif  @endif>{{$item->nombre}}</option>
    @endforeach
  </select>

            </div>
                </div>
 
 

                            </div>
                        </div>
                    </div>


 
                    <div class="col-lg-2">
                        <div class="card">
                            
                            <div class="card-body">
                               
<p class="text-muted m-b-30">&nbsp; </p>
<div class="button-items  m-b-30">
                                    <button type="button" onclick="vista(1)" class="btn btn-primary btn-lg btn-block waves-effect waves-light" >
                                       <i class="ion-clipboard"></i> Relatorio
                                    </button>
                                </div>
<p class="text-muted m-b-30">&nbsp; </p>
<div class="button-items  m-b-30">
                                    <button type="button" onclick="vista(2)" class="btn btn-success btn-lg btn-block waves-effect waves-light "  >
                                      <i class="ion-stats-bars"></i>   Grafico
                                    </button>
                                </div>
<p class="text-muted m-b-30">&nbsp; </p>
<div class="button-items">
                                    <button type="button" onclick="vista(3)" class="btn btn-secondary btn-lg btn-block waves-effect waves-light"  >
                                        <i class="ion-pie-graph"></i> Pizza
                                    </button>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>


                        

                            </div>
                        </div>
                    </div>



</div>
 
</form>         
@if(Route::currentRouteName()=='informacion')
@include('partials.informacion')
@endif      
@if(Route::currentRouteName()=='barras')
@include('partials.barras')
@endif
    
@if(Route::currentRouteName()=='tortas')
@include('partials.tortas')
@endif

</div>
@endsection
@section('script')
    @parent
   <script src="{{asset('assets/plugins/selectlist/src/jquery.bootstrap-duallistbox.js')}}"></script>   
   <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script>
    function goToByScroll(id){
      $('html,body').animate({
          scrollTop: $("#"+id).offset().top},
          'slow');
  }
  var list = $('select[name="consultores[]"]').bootstrapDualListbox();
        jQuery('#inicio').datepicker({
            format: "dd/mm/yyyy", 
            autoclose: true
        });
        jQuery('#final').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true 
        });

        function vista(variable){
            var formulario=$("#formulario");
            if($("#inicio").val().length==0 || $("#final").val().length ==0 || $("#consultores").val().length==0)
            {
                alertify
                .delay(10000)
                .error("Verifique, que alla seleccionado rango de fecha, y a los Consultores");
                return false;
            }
            if(variable==1){
                formulario.attr('action','{{route("informacion")}}')
                formulario.submit()
            }
            if(variable==2){
                formulario.attr('action','{{route("barras")}}')
                formulario.submit()
            }
            if(variable==3){
                formulario.attr('action','{{route("tortas")}}')
                formulario.submit()
            }
        }
</script>   
@if(Route::currentRouteName()=='informacion' || Route::currentRouteName()=='barras' || Route::currentRouteName()=='tortas')  
<script>
   
    $("#inicio").datepicker("setDate",  new Date("{{$inicio}}"));
    $("#final").datepicker("setDate",  new Date("{{$final}}"));
  
</script>
@endif
@if(Route::currentRouteName()=='barras')  
<script src="{{asset('assets/plugins/canvasjs/canvasjs.min.js')}}"></script>   
@include('partials.graficabarras')
@endif
@if(Route::currentRouteName()=='tortas')
<script src="{{asset('assets/plugins/canvasjs/canvasjs.min.js')}}"></script> 
@include('partials.graficatortas')
@endif
@endsection
