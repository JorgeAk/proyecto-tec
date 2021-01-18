@extends('layouts.cabeceraPr')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
  <div>
    <div class="col-lg-12">
      <h1 class="page-header">
        Panel <small>Proyecto Docencia</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active">
          <i class="fa fa-dashboard"></i> Alumno/Solicitud/<STRONG>Estatus</STRONG>
        </li>
      </ol>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h5>Eventos asignados</h5>
    </div>
    <div class="card-body">

      
      
      <div class="x_content">
        <ul class="list-unstyled timeline">
          @foreach ($ceremonia as $estat)
          <li>
            <div class="block">

              <div class="tags">
                <a href="" class="tag">
                  <span>Evento</span>
                </a>
              </div>
              
              <div class="block_content">
                <h2 class="title">
                  <a>{{$estat->nombre}}</a>
                </h2>
                <div class="byline">
                  <span>Lugar:</span> <a>{{$estat->lugar}}</a>
                </div>
                <div class="byline"> 
                  <span>Fecha:</span> <a>{{$estat->fecha}}</a>                  
                </div>
                <div class="byline">
                  <span>Hora:</span> <a>{{$estat->hora}}</a>
                </div>
                <p class="excerpt">{{$estat->descripcion}}<a>&nbsp;</a>
                </p>
              </div>
              
            </div>
          </li>
          @endforeach    
        </ul>
      </div>
     
      

    </div>
  </div>

</div>
<!-- /page content -->
<!-- footer content -->
<footer>
  <div class="pull-right">
    Titulacion SGE  by <a href="">IT Morelia</a>
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->

@endsection
