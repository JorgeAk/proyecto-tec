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
          <i class="fa fa-dashboard"></i> Alumno/Solicitud/<STRONG>Estatus</STRONG>
        </li>
      </ol>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h5>Estatus de la Solicitud</h5>
    </div>
    <div class="card-body">
      @foreach ($estatus as $estat)
      @if ($estat->s_estatus=="1") 
      <div class="x_content">
        <ul class="list-unstyled timeline">
          <li>
            <div class="block">
              <div class="tags">
                <a href="" class="tag">
                  <span>CAPTURA DE SOLICITUD</span>
                </a>
              </div>
              <div class="block_content">
                <h2 class="title">
                  <a>CAPTURA DE SOLICITUD&nbsp;</a>
                </h2>
                <div class="byline">
                  <span>Fecha</span> <a>{{$estat->created_at}}</a>
                </div>
                <p class="excerpt">datos..... <a>&nbsp;</a>
                </p>
              </div>
            </div>
          </li>    
        </ul>
      </div>
      @else

      @if($estat->s_estatus=="2")
      <div class="x_content">
        <ul class="list-unstyled timeline">
          <li>
            <div class="block ">
              <div class="tags">
                <a href="" class="tag ">
                  <span class="">SOLICITUD ENVIADA</span>
                </a>
              </div>
              <div class="block_content ">
                <h2 class="title ">
                  <a>SOLICITUD ENVIADA &nbsp;</a>
                </h2>
                <div class="byline">
                  <span>Fecha</span> <a>{{$estat->updated_at}}</a>
                </div>
                <p class="excerpt">datos..... <a>&nbsp;</a>
                </p>
              </div>
            </div>
          </li>
          <li>
            <div class="block ">
              <div class="tags ">
                <a href="" class="tag bg-secondary ">
                  <span class="bg-secondary">CAPTURA DE SOLICITUD</span>
                </a>
              </div>
              <div class="block_content">
                <h2 class="title">
                  <a>CAPTURA DE SOLICITUD&nbsp;</a>
                </h2>
                <div class="byline">
                  <span>Fecha</span> <a>{{$estat->created_at}}</a>
                </div>
                <p class="excerpt">datos..... <a>&nbsp;</a>
                </p>
              </div>
            </div>
          </li>

        </ul>
      </div>
      @else
      @if($estat->s_estatus=="3")
      <div class="x_content">
        <ul class="list-unstyled timeline">
          <li>
            <div class="block ">
              <div class="tags">
                <a href="" class="tag ">
                  <span class="">SOLICITUD EN REVISION</span>
                </a>
              </div>
              <div class="block_content ">
                <h2 class="title ">
                  <a>SOLICITUD EN REVISION &nbsp;</a>
                </h2>
                <div class="byline">
                  <span>Fecha</span> <a>{{$estat->updated_at}}</a>
                </div>
                <p class="excerpt">datos..... <a>&nbsp;</a>
                </p>
              </div>
            </div>
          </li>
          <li>
            <div class="block ">
              <div class="tags ">
                <a href="" class="tag bg-secondary ">
                  <span class="bg-secondary">SOLICITUD ENVIADA</span>
                </a>
              </div>
              <div class="block_content">
                <h2 class="title">
                  <a>SOLICITUD ENVIADA&nbsp;</a>
                </h2>
                <div class="byline">
                </div>
                <p class="excerpt">datos..... <a>&nbsp;</a>
                </p>
              </div>
            </div>
          </li>
          <li>
            <div class="block ">
              <div class="tags ">
                <a href="" class="tag bg-secondary ">
                  <span class="bg-secondary">CAPTURA DE SOLICITUD</span>
                </a>
              </div>
              <div class="block_content">
                <h2 class="title">
                  <a>CAPTURA DE SOLICITUD&nbsp;</a>
                </h2>
                <div class="byline">
                  <span>Fecha</span> <a>{{$estat->created_at}}</a>
                </div>
                <p class="excerpt">datos..... <a>&nbsp;</a>
                </p>
              </div>
            </div>
          </li>

        </ul>
      </div>
      @endif

      @endif
      

      @endif
      @endforeach

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
