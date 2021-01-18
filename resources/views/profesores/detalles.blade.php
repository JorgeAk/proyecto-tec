@extends('layouts.cabeceraPr')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
  <div>
    <div class="col-lg-12">
      <h1 class="page-header">
        Panel <small>Proyecto Docencia Profesores</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active">
          <i class="fa fa-dashboard"></i> Profesor/<STRONG>Home</STRONG>
        </li>
      </ol>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h5>Solicitud Titulación</h5>
    </div>
   

    <div class="card-body">
@if (count($alumno))
 
 
    <div class="row">

                <div class="col-md-12 register-right">
                  <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist"></ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active table-responsive" id="home" role="tabpanel" aria-labelledby="home-tab">   
                      <table class="table table-striped jambo_table ">
                                        <table class="table table-bordered table-hover table-striped ">
            <thead>

            </thead>
            <tbody >
             @foreach ($alumno as $alum)
              <tr class="centrar">
                <th>Nombre</th>
                  <td>{{ $alum->p_nombre}}</td>
                </tr>
                <tr class="centrar">
                  <th>Carrera</th>
                  <td>{{ $alum->carrera }}</td>
                </tr>
                <tr class="centrar">
                  <th>Nombre del proyecto</th>
                  <td>{{$alum->n_proyecto}}</td>
                </tr>
                
                <tr class="centrar">
                  <th>Proyecto PDF</th>
                  <td><a href="{{ route('storage',$alum->proy_archivo)}}" download="proyecto_{{$alum->n_control}}.pdf" class="btn btn-success" > <i class="fa fa-wrench"></i>  Descargar</a></td>
                </tr>

                <tr class="centrar">
                  <th >Opciones</th>
                  <td><a href="#" class="btn btn-success " data-toggle="modal" data-target="#basicModal2"> <i class="fa fa-wrench"></i>  Editar</a>

                  </td>
                </tr>
                @endforeach
                

              </tbody>
                                        </table>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>    
                  
                

    </div>
  </div>
 
  @else
   @if(Session::has('message'))
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      {{Session::get('message')}}
    </div>
    @endif

@endif

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
