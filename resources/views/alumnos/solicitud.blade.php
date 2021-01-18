@extends('layouts.cabecera')

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
                  <i class="fa fa-dashboard"></i> Alumno/<STRONG>Solicitud</STRONG>
              </li>
          </ol>
      </div>
  </div>
  <div class="card">
      <div class="card-header">
        <h5>Solicitud Titulación</h5>
        <div class=" ">
          <a href="{{ route('imprimir') }}">
              <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generar PDF</button>
          </a>
      </div>
      <div class=" ">
          <a href="{{ route('imprimir/ver') }}">
              <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Ver PDF</button>
          </a>
      </div>
  </div>
  <div class="card-body">
    @if ($solicitud->count())
    @foreach ($solicitud as $alum)
    
    

    <!--.........Ventana Registro ................................-->

    <div class="col-md-12 register-right">
        <div class="panel panel-default">
            <div class="panel-heading ">

            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped  ">
                        <thead>
                            <tr>
                                <div align="center">
                                 <h5>SOLICITUD DE REGISTRO DE OPCIÓN DE TITULACIÓN INTEGRAL</h5>
                             </div>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td>

                             </td>
                         </tr>
                     </thead>
                     <tbody>
                        <tr>

                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td align="center">
                                <div class="centrarf">
                                    <img class="img-thumbnail img-circle " width="80" height="80"  src="{{asset('/res/imagen/default.png') }}">
                                </div>
                            </td>
                        </tr>
                        <!-- ......................... Datos generales ......................-->
                        <tr>
                            <th>Datos Generales</th>
                            <tr>
                                <th>Nombre</th>
                                <th>(s)</th>
                                <th>Apellido paterno</th>
                                <th>Apellido Materno</th>
                            </tr>
                            <td>{{$alum->p_nombre}}</td>
                            <td>{{$alum->s_nombre}}</td>
                            <td>{{$alum->a_paterno}}</td>
                            <td>{{$alum->a_materno}}</td>
                        </tr>
                        <!-- ......................... Datos de contacto ......................-->
                        <tr>
                            <th>Datos de contacto</th>
                            <tr>
                                <th>Municipio</th>
                                <th>CP</th>
                                <th>Entidad</th>
                                
                            </tr>
                            <td>{{$alum->municipio}}</td>
                            <td>{{$alum->cp}}</td>
                            <td>{{$alum->entidad_f}}</td>
                            
                            <tr>
                                <th>Correo</th>
                                <th>Segundo Correo</th>
                                <th>Telefono</th>
                                <th>Celular</th>
                            </tr>
                            <td>{{$alum->p_correo}}</td>
                            <td>{{$alum->s_correo}}</td>
                            <td>{{$alum->telefono}}</td>
                            <td>{{$alum->celular}}</td>
                        </tr>
                        <!-- ......................... Datos egreso......................-->
                        <tr>
                            <th>Datos de egreso</th>
                            <tr>
                                <th>Numero de Control</th>
                                <th>Carrera</th>
                                <th>Plan de estudios</th>
                                <th>Opcion de titulacion</th>
                            </tr>
                            <td>{{$alum->n_control}}</td>
                            <td>{{$alum->carrera}}</td>
                            @foreach ($planes as $pl)
                            @if ($alum->plan == $pl->id)
                            <td>{{$pl->nombre}}</td>
                            @endif
                            @endforeach
                            @foreach ($op_titulaciones as $op_t)
                            @if ($alum->op_titulacion == $op_t->id)
                            <td>{{$op_t->nombre}}</td>
                            @endif
                            @endforeach
                            @if ($alum->asesor != 0)
                            <tr>
                                <th>Asesor</th>
                                <th>Nombre del proyecto</th>
                            </tr>
                            @foreach ($profesores as $prof)
                            @if ($prof->id==$alum->asesor)
                            <td>{{$prof->p_nombre}}</td>
                            @endif
                            @endforeach
                            <td>{{$alum->n_proyecto}}</td>
                            @endif
                        </tr>
                        <!-- ......................... Revisores  ......................-->
                        @if(!empty($revisores) )
                        <tr>
                            <th>Revisores Asignados</th>
                            <tr>
                                <th>Primer Revisor</th>
                                <th>Segundo Revisor</th>
                                <th>Tercer Revisor</th>
                                <th>Cuarto Revisor</th>
                            </tr>
                            @foreach ($revisores as $rev)
                            @if ($rev->id==$alum->primer_revisor)
                            <td>{{$rev->p_nombre}}</td>
                            @endif
                            @endforeach

                            @foreach ($revisores as $rev)
                            @if($rev->id==$alum->segundo_revisor)
                            <td>{{$rev->p_nombre}}</td>
                            @endif
                            @endforeach

                            @foreach ($revisores as $rev)
                            @if($rev->id==$alum->tercer_revisor)
                            <td>{{$rev->p_nombre}}</td>
                            @endif
                            @endforeach

                            @foreach ($revisores as $rev)
                            @if($rev->id==$alum->cuarto_revisor)
                            <td>{{$rev->p_nombre}}</td>
                            @endif
                            @endforeach

                        </tr>
                        @endif
                        <!-- ......................... Propuesta sinodal ......................-->
                        @if(!empty($sinodales) )
                        <tr>
                            <th>Propuesta de Sinodales</th>
                            <tr>
                                <th>Presidente</th>
                                <th>Secretario</th>
                                <th>Vocal propietario</th>
                                <th>Vocal Suplente</th>
                            </tr>
                            @foreach ($sinodales as $sin)
                            @if ($sin->id==$alum->presidente)
                            <td>{{$sin->p_nombre}}</td>
                            @endif
                            @endforeach

                            @foreach ($sinodales as $sin)
                            @if($sin->id==$alum->secretario)
                            <td>{{$sin->p_nombre}}</td>
                            @endif
                            @endforeach

                            @foreach ($sinodales as $sin)
                            @if($sin->id==$alum->v_propietario)
                            <td>{{$sin->p_nombre}}</td>
                            @endif
                            @endforeach

                            @foreach ($sinodales as $sin)
                            @if( $sin->id==$alum->v_suplente)
                            <td>{{$sin->p_nombre}}</td>
                            @endif
                            @endforeach
                        </tr>
                        
                        @endif
                        
                    </tbody>
                </table>
            </div>
            @if ($alum->s_estatus==1)
            <div class="row">
                <div class="col-xs-6 col-centrada" >
                    <form class="form-inline " method="POST" action="{{ route('/confirmarSol') }}">
                        @csrf
                        <div class="form-group ">
                          <input hidden type="text" readonly class="form-control-plaintext" id="staticEmail2" value="SI" name="confirm_sol">
                        </div>
                        <button type="submit" class="btn btn-success btn-block" title="*Al enviar no se podran actualizar los datos">Enviar </button>
                        
                      </form>
                </div>
              </div>

              @endif
            
        </div>
    </div>
</div>
@endforeach
@else
<div align="center">
    <h4>¿Deseas generar tu solicitud?</h4>
    <a href="{{ route('/alumnos/solicitud/generar') }}">
      <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generar</button>
  </a>
</div>  

@endif

<!--..................Fin Registro ................................-->
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
