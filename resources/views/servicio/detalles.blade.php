@extends('layouts.cabeceraSS')


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

            </div>
            <div class="card-body">
                <!--.........Ventana Registro ................................-->
                @if ($solicitud->count())
                    @foreach ($solicitud as $alum)

                        <div class="container register">
                            <div class="row">
                                <div class="col-md-12 register-right">
                                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist"></ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                                            aria-labelledby="home-tab">
                                            <br>

                                            <form class="" method="POST" enctype="multipart/form-data"
                                                action="{{ route('/docencia/ss/solicitudes/actualizar') }}">
                                                @csrf
                                                <input hidden type="text" id="last-name" name="solicitud"
                                                    value="{{ $alum->id }}" class="form-control">
                                                <input hidden type="text" id="last-name" name="p_r"
                                                    value="{{ $alum->primer_revisor }}" class="form-control">
                                                <input hidden type="text" id="last-name" name="s_r"
                                                    value="{{ $alum->segundo_revisor }}" class="form-control">
                                                <input hidden type="text" id="last-name" name="t_r"
                                                    value="{{ $alum->tercer_revisor }}" class="form-control">
                                                <div class="row ">
                                                    <div class="col-md-6">
                                                        <div class="">
                                                            <label for="inputfirstName">Primer Nombre</label>
                                                            <input disabled id="inputfirstName" type="text"
                                                                class="form-control  @error('name') is-invalid @enderror"
                                                                name="p_nombre" autocomplete="name"
                                                                placeholder="{{ $alum->p_nombre }}" autofocus required />
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputSecondName">Segundo Nombre</label>
                                                            <input disabled id="inputSecondName" name="s_nombre" type="text"
                                                                class="form-control" placeholder="{{ $alum->s_nombre }}" />
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputAp">Apellido Paterno</label>
                                                            <input disabled id="inputAp" name="a_paterno" type="text"
                                                                class="form-control" placeholder="{{ $alum->a_paterno }}" />
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputAm">Apellido Materno</label>
                                                            <input disabled id="inputAm" name="a_materno" type="text"
                                                                class="form-control" placeholder="{{ $alum->a_materno }}" />
                                                        </div>

                                                        <div class=" form-label-group">
                                                            <label for="inputemail2">Segundo Correo</label>
                                                            <input disabled id="inputemail2" name="s_correo" type="email"
                                                                class="form-control" placeholder="{{ $alum->s_correo }}" />
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputtel">Telefono de Casa</label>
                                                            <input disabled id="inputtel" name="telefono" type="tel"
                                                                class="form-control" placeholder="{{ $alum->telefono }}" />
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputtel2">Celular</label>
                                                            <input disabled id="inputtel2" name="celular" type="tel"
                                                                minlength="10" maxlength="10" class="form-control"
                                                                placeholder="{{ $alum->celular }}" />
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputciudad">Municipio</label>
                                                            <input disabled id="inputciudad" name="municipio" type="text"
                                                                class="form-control" placeholder="{{ $alum->municipio }}" />
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputcp">CP</label>
                                                            <input disabled id="inputcp" name="cp" type="text"
                                                                class="form-control" placeholder="{{ $alum->cp }}" />
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputestado">Entidad Federativa</label>
                                                            <input disabled id="inputestado" name="entidad_f" type="text"
                                                                class="form-control" placeholder="{{ $alum->entidad_f }}" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class=" form-label-group">
                                                            <label for="inputNcontrol">Numero de Control</label>
                                                            <input disabled id="inputNcontrol" name="n_control" type="text"
                                                                class="form-control" placeholder="{{ $alum->n_control }}" />
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputCarrera">Carrera</label>
                                                            <input disabled id="inputCarrera" name="carrera" type="text"
                                                                class="form-control" placeholder="{{ $alum->carrera }}" />
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputCarrera">Plan</label>
                                                            @foreach ($planes as $plan)
                                                                @if ($alum->plan == $plan->id)
                                                                    <input disabled id="inputCarrera" name="plan"
                                                                        type="text" class="form-control"
                                                                        placeholder="{{ $plan->nombre }}" required />
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                        <br>
                                                        <div class=" form-label-group">
                                                            <label for="inputCarrera">Fecha de Ingreso</label>
                                                            <input disabled id="inputCarrera" name="f_ingreso" type="text"
                                                                class="form-control" placeholder="{{ $alum->f_ingreso }}"
                                                                required />
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputCarrera">Fecha de Egreso</label>
                                                            <input disabled id="inputCarrera" name="f_egreso" type="text"
                                                                class="form-control" placeholder="{{ $alum->f_egreso }}"
                                                                required />
                                                        </div>
                                                        @foreach ($op_titulaciones as $op_t)
                                                            @if ($alum->op_titulacion == $op_t->id)
                                                                <div class=" form-label-group">
                                                                    <label for="inputCarrera">Opcion de titulacion</label>
                                                                    <input disabled id="inputCarrera" name="op_titulacion"
                                                                        type="text" class="form-control"
                                                                        placeholder="{{ $op_t->nombre }}" required />
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                        @if ($alum->op_titulacion != 4 and $alum->s_estatus == 2)
                                                            <div class=" form-label-group">
                                                                <label for="inputCarrera">Archivo del Proyecto</label>
                                                                <a href="{{ route('descargar_archivo', $alum->proy_archivo) }}"
                                                                    download="proyecto_{{ $alum->n_control }}.pdf"
                                                                    class="btn btn-success pull-right form-control text-light"
                                                                    style="margin-right: 5px;"><i
                                                                        class="fa fa-cloud-download"></i>&nbsp;&nbsp;<i
                                                                        class="fa fa-file-pdf-o"></i>&nbsp;Descargar
                                                                    Archivo</a>
                                                            </div>
                                                            <div class=" form-label-group">
                                                                <label for="inputCarrera">Asesor Interno</label>
                                                                @foreach ($profesores as $prof)
                                                                    @if ($alum->asesor == $prof->id)
                                                                        <input disabled id="inputCarrera" name="carrera"
                                                                            type="text" class="form-control"
                                                                            placeholder="{{ $prof->p_nombre }}" required />
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                            <br>
                                                            <h5 class="centrar">Asignacion de Revisores</h5>
                                                            <br>
                                                            <div class=" form-label-group">
                                                                <label for="">Primer Revisor</label>
                                                                <select id="primer_rev" name="primer_revisor"
                                                                    class="form-control" required>
                                                                    <option class="hidden" selected disabled>Primer revisor
                                                                    </option>
                                                                    @foreach ($profesores as $prof)
                                                                        <option value="{{ $prof->id }}">
                                                                            {{ $prof->p_nombre }}
                                                                        </option>

                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class=" form-label-group">
                                                                <label for="">Segundo Revisor</label>
                                                                <select id="segundo_rev" name="segundo_revisor"
                                                                    class="form-control" required>
                                                                    <option class="hidden" selected disabled>Segundo revisor
                                                                    </option>
                                                                    @foreach ($profesores as $prof)
                                                                        <option value="{{ $prof->id }}">
                                                                            {{ $prof->p_nombre }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class=" form-label-group">
                                                                <label for="">Tercer Revisor</label>
                                                                <select id="tercer_rev" name="tercer_revisor"
                                                                    class="form-control" required>
                                                                    <option class="hidden" selected disabled>Tercer revisor
                                                                    </option>
                                                                    @foreach ($profesores as $prof)
                                                                        <option value="{{ $prof->id }}">
                                                                            {{ $prof->p_nombre }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @else


                                                            <!---------------inicio --------------->
                                                            @if ($alum->s_estatus == 4)
                                                                <br>
                                                                <h5 class="centrar">Asignacion de Sinodales</h5>
                                                                <div class=" form-label-group">
                                                                    <label for="">Presidente</label>
                                                                    <select id="presidente" name="presidente"
                                                                        class="form-control" required>
                                                                        <option class="hidden" selected disabled>Presidente
                                                                        </option>
                                                                        @foreach ($profesores as $prof)
                                                                            <option value="{{ $prof->id }}">
                                                                                {{ $prof->p_nombre }}
                                                                            </option>

                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class=" form-label-group">
                                                                    <label for="">Secretario</label>
                                                                    <select id="secretario" name="secretario"
                                                                        class="form-control" required>
                                                                        <option class="hidden" selected disabled>Secretario
                                                                        </option>
                                                                        @foreach ($profesores as $prof)
                                                                            <option value="{{ $prof->id }}">
                                                                                {{ $prof->p_nombre }}
                                                                            </option>

                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class=" form-label-group">
                                                                    <label for="">Vocal</label>
                                                                    <select id="v_propietario" name="v_propietario"
                                                                        class="form-control" required>
                                                                        <option class="hidden" selected disabled>Vocal
                                                                        </option>
                                                                        @foreach ($profesores as $prof)
                                                                            <option value="{{ $prof->id }}">
                                                                                {{ $prof->p_nombre }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class=" form-label-group">
                                                                    <label for="">Vocal suplente</label>
                                                                    <select id="v_suplente" name="v_suplente"
                                                                        class="form-control" required>
                                                                        <option class="hidden" selected disabled>Vocal
                                                                            suplente
                                                                        </option>
                                                                        @foreach ($profesores as $prof)
                                                                            <option value="{{ $prof->id }}">
                                                                                {{ $prof->p_nombre }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                            @endif

                                                            <!---------------FIN --------------->

                                                        @endif

                                                        <hr class="my-4">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-xs-6 col-centrada">
                                                        <button type="submit"
                                                            class="btn btn-success btn-block">Actualizar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                @else
                    <div align="center">
                        <h4>¿Este Registro no Existe? =C</h4>

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
            Titulacion SGE by <a href="">IT Morelia</a>
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->

@endsection
