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
          <i class="fa fa-dashboard"></i> Profesor/Alumnos-<STRONG>Asignados</STRONG>
        </li>
      </ol>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h5>Solicitud Titulación</h5>      
    </div>    
    <div class="card-body">

       

      <!--..........................Inicio contenido........................-->
 @if ($asignados->count())
     
              <div class="row">
                <div class="col-md-12 register-right">
                  <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist"></ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active table-responsive" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <br>   
                      <table id="example" class="table table-striped jambo_table ">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Carrera</th>
                                                <th scope="col">Proyecto</th>
                                                <th scope="col">Ser revisor</th>
                                                <th scope="col">Actualizaciones</th>
                                                <th scope="col">Evaluar</th>
                                                <th scope="col">Ver Completo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($asignados as $alum)
                                            @foreach ($revisores as $rev)
                                            @if($rev->id_estatus != 7)
                                            
                                            <tr>
                                                <td scope="row">1</td>
                                                <td>{{$alum->p_nombre}}</td>
                                                <td>{{$alum->carrera}}</td>
                                                <td>{{$alum->n_proyecto}}</td>
                                                <td>
                                                    
                                                        @if ($rev->id_solicitud == $alum->id and $rev->id_estatus==6)
                                                        <a href="#" class="btn btn-lg btn-success btn-sm" data-toggle="modal" data-target="#basicAcept">Aceptar</a>
                                                        <a href="#" class="btn btn-lg btn-danger btn-sm" data-toggle="modal" data-target="#basicCancel">Rechazar</a>
                                                        @else
                                                          @foreach ($estatus as $est)
                                                              @if ($est->id == $rev->id_estatus)
                                                                  <p>{{$est->nombre}}</p>
                                                              @endif
                                                          @endforeach  
                                                        @endif
                                                    
                                                </td>
                                                    <td>Si/No</td>
                                                    @if ($rev->id_estatus == 8)
                                                    <td><a href="#" class="btn btn-lg btn-success btn-sm" data-toggle="modal" data-target="#M{{$alum->id}}">Ver</a></td>
                                                    @else 
                                                    <td>Pendiente</td>
                                                    @endif
                                                    <td style="text-align: center"><a href="{{ route('alumnoDetalle',$alum->id)}}" class="btn btn-lg btn-success btn-sm">Ver</a></td>
                                                </tr>
                                                @endif
                                                @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @foreach ($asignados as $alum) 
                                        <!-- basic modal -->
                                        <div class="modal fade" id="M{{$alum->id}}" tabindex="-1" role="dialog" aria-labelledby="M{{$alum->id}}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Datos del Alumno</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Nombre: {{$alum->p_nombre}}</p>
                                                        <p>Carrera: {{$alum->carrera}} </p>
                                                        <p></p>
                                                        <hr>
                                                        <p><a href="{{ route('storage',$alum->proy_archivo)}}" download="proyecto_{{$alum->n_control}}.pdf" class="btn btn-success" > <button type="button" class="btn btn-success btn-lg btn-sm"> Descargar Proyecto <i class="fas fa-file-download"></i> <span class="oi oi-data-transfer-download"></span></button></a></p>
                                                        <hr>   
                                                        <form>
                                                            <div class="form-group">
                                                                <label for="exampleFormControlTextarea1">Comentario</label>
                                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                        <button type="button" class="btn btn-primary">Enviar Comentario</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                        <!-- basic modalAcept -->
                                        <div class="modal fade" id="basicAcept" tabindex="-1" role="dialog" aria-labelledby="basicAcept" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel"></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4>¿Acepta ser revisor de este proyecto?</h4>
                                                        <h4>No podra volver a cambiarlo de nuevo</h4>
                                                        <form class="" method="POST"  action="{{ route('/profesor/alumnos/asignados/actualizar') }}">
                                                            @csrf
                                                            <input hidden type="text" id="last-name" name="aceptar"  value="si"  class="form-control">
                                                            <input hidden type="text" id="last-name" name="solicitud"  value="{{$alum->id}}"  class="form-control">
                                                            <button type="submit" class="btn btn-success btn-block">Confirmar</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- basic modalCancel -->
                                        <div class="modal fade" id="basicCancel" tabindex="-1" role="dialog" aria-labelledby="basicCancel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4>¿No acepta ser revisor de este proyecto?</h4>
                                                        <form class="" method="POST"  action="{{ route('/profesor/alumnos/asignados/actualizar') }}">
                                                            @csrf
                                                            <input hidden type="text" id="last-name" name="rechazar"  value="si"  class="form-control">
                                                            <input hidden type="text" id="last-name" name="solicitud"  value="{{$alum->id}}"  class="form-control">
                                                            <button type="submit" class="btn btn-success btn-block">Confirmar</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

        </div>
      </div>

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
