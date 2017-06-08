@section('title') New multimedia content @endsection
@extends('layouts.app')
@section('content')
  <div class=" page-wrapper{{-- jumbotron --}}">
    <div class="container-fluid">
      <div class="">

        <!-- Page Heading -->
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h1 class="page-header">
              Multimedia <small>Crear nuevo contenido multimedia</small>
            </h1>
            <ol class="breadcrumb">
              <li class="active">
                <i class="fa fa-dashboard"></i> Cree nuevo contenido Multimedia.
              </li>
            </ol>
          </div>
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
            @include('alerts.allAlerts')
          </div><!-- .col-* -->
          <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
            {!!Form::open(['route'=>'multimedia.store', 'method'=>'POST', 'id'=>'multimedia_create'])!!}
            @include('multimedia.forms.fieldsCreateEdit')
          </div><!-- .col-* -->

          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
            <div class="list-group">
              <div class="list-group-item">
                Espacio publicitario
              </div><!-- -->
              <div class="list-group-item">
                Sugerencias, relateds, etc.
              </div><!-- -->
            </div><!-- .list-group -->
          </div><!-- .col-* -->

        </div><!-- .row -->
      </div><!-- -->
    </div><!-- .container-fluid -->
  </div><!-- .page-wrapper -->

@endsection