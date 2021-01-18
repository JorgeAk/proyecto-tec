@extends('layouts.cabeceraSS')

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
                        <i class="fa fa-dashboard"></i> Alumnos/<STRONG>Solicitudes</STRONG>
                    </li>
                </ol>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
            </div>
            @if (Session::has('message'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="card-body">
                <!-- table -->
                <div class="row">
                    <div class="col-md-12 register-right">
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist"></ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active table-responsive" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <br>
                                <table id="example" class="table table-striped jambo_table ">
                                    <thead>
                                        <tr>
                                            <th># Control</th>
                                            <th>Nombre</th>
                                            <th>Apellido Paterno</th>
                                            <th>Apellido Materno</th>
                                            <th>Carrera</th>
                                            <th>Plan&nbsp;&nbsp;&nbsp;</th>
                                            <th>Opcion de titulación</th>
                                            <th>Estatus</th>
                                            <th>Modificar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($alumno as $alum)
                                            <tr class="centrar">
                                                <td>{{ $alum->n_control }}</td>
                                                <td>{{ $alum->p_nombre }} {{ $alum->s_nombre }}</td>
                                                <td>{{ $alum->a_paterno }}</td>
                                                <td>{{ $alum->a_materno }}</td>
                                                <td>{{ $alum->carrera }}</td>
                                                @foreach ($planes as $plan)
                                                    @if ($alum->plan == $plan->id)
                                                        <td>{{ $plan->nombre }}</td>
                                                    @endif
                                                @endforeach
                                                @foreach ($titulacion as $op_t)
                                                    @if ($alum->op_titulacion == $op_t->id)
                                                        <td>{{ $op_t->nombre }}</td>
                                                    @endif
                                                @endforeach
                                                @foreach ($estatus as $est)
                                                    @if ($alum->s_estatus == $est->id)
                                                        <td>{{ $est->nombre }}</td>
                                                    @endif
                                                @endforeach
                                                <td><a href="#" class="btn btn-lg btn-success btn-sm"
                                                        data-toggle="modal" data-target="#M{{ $alum->id }}">Ver</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @foreach ($alumno as $alum)
                                    <!-- basic modal -->
                                    <div class="modal fade " id="M{{ $alum->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="M{{ $alum->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Solicitud Alumno</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container register">
                                                        <div class="row">
                                                            <div class="col-md-12 register-right">
                                                                <div class="tab-content" id="myTabContent">
                                                                    <div class="tab-pane fade show active" id="home"
                                                                        role="tabpanel" aria-labelledby="home-tab">
                                                                        <div class="row ">
                                                                            <div class="col-md-6">
                                                                                <div class="">
                                                                                    <label for="inputfirstName">Primer
                                                                                        Nombre</label>
                                                                                    <input disabled
                                                                                        id="inputfirstName"
                                                                                        type="text"
                                                                                        class="form-control  @error('name') is-invalid @enderror"
                                                                                        name="p_name"
                                                                                        value="{{ $alum->p_nombre }}"
                                                                                        autocomplete="name"
                                                                                        placeholder="{{ $alum->p_nombre }}"
                                                                                        required autofocus />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label
                                                                                        for="inputSecondName">Segundo
                                                                                        Nombre</label>
                                                                                    <input disabled
                                                                                        id="inputSecondName"
                                                                                        name="s_name" type="text"
                                                                                        class="form-control"
                                                                                        placeholder="{{ $alum->s_nombre }}" />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputAp">Apellido
                                                                                        Paterno</label>
                                                                                    <input disabled id="inputAp"
                                                                                        name="ap_paterno" type="text"
                                                                                        class="form-control"
                                                                                        placeholder="{{ $alum->a_paterno }}"
                                                                                        required />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputAm">Apellido
                                                                                        Materno</label>
                                                                                    <input disabled id="inputAm"
                                                                                        name="ap_materno" type="text"
                                                                                        class="form-control"
                                                                                        placeholder="{{ $alum->a_materno }}"
                                                                                        required />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputemail2">Segundo
                                                                                        Correo</label>
                                                                                    <input disabled id="inputemail2"
                                                                                        name="email2" type="email"
                                                                                        class="form-control"
                                                                                        placeholder="{{ $alum->s_correo }}" />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputtel">Telefono de
                                                                                        Casa</label>
                                                                                    <input disabled id="inputtel"
                                                                                        name="tel" type="tel"
                                                                                        class="form-control"
                                                                                        placeholder="{{ $alum->telefono }}" />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label
                                                                                        for="inputtel2">Celular</label>
                                                                                    <input disabled id="inputtel2"
                                                                                        name="cel" type="tel"
                                                                                        minlength="10" maxlength="10"
                                                                                        class="form-control"
                                                                                        placeholder="{{ $alum->celular }}"
                                                                                        required />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label
                                                                                        for="inputciudad">Municipio</label>
                                                                                    <input disabled id="inputciudad"
                                                                                        name="municipio" type="text"
                                                                                        class="form-control"
                                                                                        placeholder="{{ $alum->municipio }}"
                                                                                        required />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputcp">CP</label>
                                                                                    <input disabled id="inputcp"
                                                                                        name="cp" type="text"
                                                                                        class="form-control"
                                                                                        placeholder="{{ $alum->cp }}"
                                                                                        required required />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputestado">Entidad
                                                                                        Federativa</label>
                                                                                    <input disabled id="inputestado"
                                                                                        name="entidad" type="text"
                                                                                        class="form-control"
                                                                                        placeholder="{{ $alum->entidad_f }}"
                                                                                        required />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputNcontrol">Numero
                                                                                        de Control</label>
                                                                                    <input disabled id="inputNcontrol"
                                                                                        name="n_control" type="text"
                                                                                        class="form-control"
                                                                                        placeholder="{{ $alum->n_control }}"
                                                                                        required />
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class=" form-label-group">
                                                                                    <label
                                                                                        for="inputCarrera">Carrera</label>
                                                                                    <input disabled id="inputCarrera"
                                                                                        name="carrera" type="text"
                                                                                        class="form-control"
                                                                                        placeholder="{{ $alum->carrera }}"
                                                                                        required />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label
                                                                                        for="inputCarrera">Plan</label>
                                                                                    @foreach ($planes as $plan)
                                                                                        @if ($alum->plan == $plan->id)
                                                                                            <input disabled
                                                                                                id="inputCarrera"
                                                                                                name="plan"
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                placeholder="{{ $plan->nombre }}"
                                                                                                required />
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputCarrera">Fecha de
                                                                                        Ingreso</label>
                                                                                    <input disabled id="inputCarrera"
                                                                                        name="f_ingreso" type="text"
                                                                                        class="form-control"
                                                                                        placeholder="{{ $alum->f_ingreso }}"
                                                                                        required />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputCarrera">Fecha de
                                                                                        Egreso</label>
                                                                                    <input disabled id="inputCarrera"
                                                                                        name="f_egreso" type="text"
                                                                                        class="form-control"
                                                                                        placeholder="{{ $alum->f_egreso }}"
                                                                                        required />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputCarrera">Opcion
                                                                                        de titulacion</label>
                                                                                    @foreach ($titulacion as $op_t)
                                                                                        @if ($alum->op_titulacion == $op_t->id)
                                                                                            <input disabled
                                                                                                id="inputCarrera"
                                                                                                name="op_titulacion"
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                placeholder="{{ $op_t->nombre }}"
                                                                                                required />
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                                                <!-- validados la solicitud para asignar rev-->
                                                                                @if ($alum->op_titulacion != 4 and $alum->s_estatus== 2)
                                                                                <div class=" form-label-group"><label for="inputCarrera">Archivo</label>
                                                                                   <a href="{{ route('descargar_archivo',$alum->proy_archivo)}}" download="proyecto_{{$alum->n_control}}.pdf"><button class="btn btn-success pull-right form-control" style="margin-right: 5px;"><i class="fa fa-cloud-download"></i>&nbsp;&nbsp;<i class="fa fa-file-pdf-o"></i>&nbsp;Descargar Archivo</button></a>
                                                                                 </div>
                                                                                  <div class=" form-label-group">
                                                                                     <label for="inputCarrera">Asesor Interno</label>
                                                                                       @foreach ($profesores as $prof)
                                                                                          @if ($alum->asesor== $prof->id)
                                                                                            <input disabled id="inputCarrera" name="carrera" type="text" class="form-control" placeholder="{{$prof->p_nombre}}" required />
                                                                                          @endif 
                                                                                       @endforeach
                                                                                  </div>
                                                                                  <br>
                                                                                    <h5 class="centrar">Asignacion de Revisores</h5>
                                                                                    <br>
                                                                                    <!----------- Primer Revisor -------------->
                                                                                  @if ($alum->primer_revisor!=0)
                                                                                  <div class=" form-label-group">
                                                                                    @foreach ($profesores as $prof)
                                                                                      @if ($alum->primer_revisor == $prof->id)
                                                                                        <label for="inputCarrera">Primer Revisor</label>
                                                                                       @foreach ($revisores as $rev)
                                                                                         @if($rev->id_profesor == $alum->primer_revisor and $rev->id_solicitud== $alum->id)
                                                                                           <input disabled id="inputCarrera" name="carrera" type="text" class="form-control" placeholder="{{$prof->p_nombre}}" required />
                                                                                             @foreach ($estatus as $est)
                                                                                                @if ($rev->id_estatus==$est->id)
                                                                                                 <small class="text-danger">*Estatus: {{$est->nombre}} </small>
                                                                                               @endif
                                                                                             @endforeach
                                                                                         @endif 
                                                                                       @endforeach
                                                                                       @endif 
                                                                                     @endforeach
                                                                                   </div>
                                                                                  @else 
                                                                                    <div class=" form-label-group">
                                                                                      <label for="inputCarrera"> Sin Revisor Asignado</label>
                                                                                      <input disabled id="inputCarrera"
                                                                                        name="f_ingreso" type="text"
                                                                                        class="form-control"
                                                                                        placeholder=""
                                                                                        required />
                                                                                    </div>   
                                                                                  @endif
                                                                                    <!----------- Fin Primer Revisor -------------->
                                                                                    <!----------- Segundo Revisor -------------->
                                                                                  @if ($alum->segundo_revisor!=0)
                                                                                  <div class=" form-label-group">
                                                                                    @foreach ($profesores as $prof)
                                                                                      @if ($alum->segundo_revisor == $prof->id)
                                                                                        <label for="inputCarrera">Segundo Revisor</label>
                                                                                       @foreach ($revisores as $rev)
                                                                                         @if($rev->id_profesor == $alum->segundo_revisor and $rev->id_solicitud== $alum->id)
                                                                                           <input disabled id="inputCarrera" name="carrera" type="text" class="form-control" placeholder="{{$prof->p_nombre}}" required />
                                                                                             @foreach ($estatus as $est)
                                                                                                @if ($rev->id_estatus==$est->id)
                                                                                                 <small class="text-danger">*Estatus: {{$est->nombre}} </small>
                                                                                               @endif
                                                                                             @endforeach
                                                                                         @endif 
                                                                                       @endforeach
                                                                                       @endif 
                                                                                     @endforeach
                                                                                   </div>
                                                                                  @else 
                                                                                    <div class=" form-label-group">
                                                                                      <label for="inputCarrera"> Sin Revisor Asignado</label>
                                                                                      <input disabled id="inputCarrera"
                                                                                        name="f_ingreso" type="text"
                                                                                        class="form-control"
                                                                                        placeholder=""
                                                                                        required />
                                                                                    </div>   
                                                                                  @endif
                                                                                    <!----------- Fin Segundo Revisor -------------->
                                                                                    <!----------- Segundo Revisor -------------->
                                                                                  @if ($alum->tercer_revisor!=0)
                                                                                  <div class=" form-label-group">
                                                                                    @foreach ($profesores as $prof)
                                                                                      @if ($alum->tercer_revisor == $prof->id)
                                                                                        <label for="inputCarrera">Tercer Revisor</label>
                                                                                       @foreach ($revisores as $rev)
                                                                                         @if($rev->id_profesor == $alum->tercer_revisor and $rev->id_solicitud== $alum->id)
                                                                                           <input disabled id="inputCarrera" name="carrera" type="text" class="form-control" placeholder="{{$prof->p_nombre}}" required />
                                                                                             @foreach ($estatus as $est)
                                                                                                @if ($rev->id_estatus==$est->id)
                                                                                                 <small class="text-danger">*Estatus: {{$est->nombre}} </small>
                                                                                               @endif
                                                                                             @endforeach
                                                                                         @endif 
                                                                                       @endforeach
                                                                                       @endif 
                                                                                     @endforeach
                                                                                   </div>
                                                                                  @else 
                                                                                    <div class=" form-label-group">
                                                                                      <label for="inputCarrera"> Sin Revisor Asignado</label>
                                                                                      <input disabled id="inputCarrera"
                                                                                        name="f_ingreso" type="text"
                                                                                        class="form-control"
                                                                                        placeholder=""
                                                                                        required />
                                                                                    </div>   
                                                                                  @endif
                                                                                    <!----------- Fin Segundo Revisor -------------->
                                                                                @else
                                                                                    @if ($alum->s_estatus == 3)
                                                                                    <br>
                                                                                    <h5 class="centrar">Asignacion de Sinodales</h5>
                                                                                    <br>
                                                                                    <!----------- Presidente -------------->
                                                                                    <div class=" form-label-group">
                                                                                      @foreach ($profesores as $prof)
                                                                                      @if ($alum->presidente == $prof->id)
                                                                                      <label for="inputCarrera">Presidente</label>
                                                                                      @foreach ($sinodales as $sino)
                                                                                      @if($sino->id_profesor == $alum->presidente and $sino->id_solicitud== $alum->id)
                                                                                      <input disabled id="inputCarrera" name="carrera" type="text" class="form-control" placeholder="{{$prof->p_nombre}}" required />
                                                                                      @foreach ($estatus as $est)
                                                                                      @if ($sino->id_estatus==$est->id)
                                                                                      <small class="text-danger">*Estatus: {{$est->nombre}} </small>
                                                                                      @endif
                                                                                      @endforeach
                                                                                      @endif 
                                                                                      @endforeach
                                                                                      @endif 
                                                                                      @endforeach
                                                                                    </div>
                                                                                    <!----------- Fin Presidente -------------->
                                                                                    <!----------- Secretario -------------->
                                                                                    <div class=" form-label-group">
                                                                                      @foreach ($profesores as $prof)
                                                                                      @if ($alum->secretario == $prof->id)
                                                                                      <label for="inputCarrera">Secretario</label>
                                                                                      @foreach ($sinodales as $sino)
                                                                                      @if($sino->id_profesor == $alum->secretario and $sino->id_solicitud== $alum->id)
                                                                                      <input disabled id="inputCarrera" name="carrera" type="text" class="form-control" placeholder="{{$prof->p_nombre}}" required />
                                                                                      @foreach ($estatus as $est)
                                                                                      @if ($sino->id_estatus==$est->id)
                                                                                      <small class="text-danger">*Estatus: {{$est->nombre}} </small>
                                                                                      @endif
                                                                                      @endforeach
                                                                                      @endif 
                                                                                      @endforeach
                                                                                      @endif 
                                                                                      @endforeach
                                                                                    </div>
                                                                                    <!----------- Fin Secretario -------------->
                                                                                    <!----------- Vocal Propietario -------------->
                                                                                    <div class=" form-label-group">
                                                                                      @foreach ($profesores as $prof)
                                                                                      @if ($alum->v_propietario == $prof->id)
                                                                                      <label for="inputCarrera">Vocal propietario</label>
                                                                                      @foreach ($sinodales as $sino)
                                                                                      @if($sino->id_profesor == $alum->v_propietario and $sino->id_solicitud== $alum->id)
                                                                                      <input disabled id="inputCarrera" name="carrera" type="text" class="form-control" placeholder="{{$prof->p_nombre}}" required />
                                                                                      @foreach ($estatus as $est)
                                                                                      @if ($sino->id_estatus==$est->id)
                                                                                      <small class="text-danger">*Estatus: {{$est->nombre}} </small>
                                                                                      @endif
                                                                                      @endforeach
                                                                                      @endif 
                                                                                      @endforeach
                                                                                      @endif 
                                                                                      @endforeach
                                                                                    </div>
                                                                                    <!----------- Fin Vocal Propietario -------------->
                                                                                    <!----------- Vocal Suplente -------------->
                                                                                    <div class=" form-label-group">
                                                                                      @foreach ($profesores as $prof)
                                                                                      @if ($alum->v_suplente == $prof->id)
                                                                                      <label for="inputCarrera">Vocal suplente</label>
                                                                                      @foreach ($sinodales as $sino)
                                                                                      @if($sino->id_profesor == $alum->v_suplente and $sino->id_solicitud== $alum->id)
                                                                                      <input disabled id="inputCarrera" name="carrera" type="text" class="form-control" placeholder="{{$prof->p_nombre}}" required />
                                                                                      @foreach ($estatus as $est)
                                                                                      @if ($sino->id_estatus==$est->id)
                                                                                      <small class="text-danger">*Estatus: {{$est->nombre}} </small>
                                                                                      @endif
                                                                                      @endforeach
                                                                                      @endif 
                                                                                      @endforeach
                                                                                      @endif 
                                                                                      @endforeach
                                                                                    </div>
                                                                                    <!----------- Fin Vocal Propietario -------------->

                                                                                    @endif



                                                                                @endif




                                                                                <a
                                                                                    href="{{ route('detalleSS', $alum->id) }}"><button
                                                                                        class="btn btn-success pull-right form-control"
                                                                                        style="margin-right: 5px;"><i
                                                                                            class="fa fa-pencil-square-o"
                                                                                            aria-hidden="true"> </i>
                                                                                        &nbsp;Modificar </button>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- basic modal END-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /table-->
            </div>
        </div>
    </div>
    <!-- /page content -->
    <!-- footer content -->
    <footer>
        <div class="pull-right">
            Titulacion SGE by <a href="">IT Morelia</a>
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
@endsection
