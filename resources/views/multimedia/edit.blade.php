@section('title') Edit @stop
@extends('layouts.app')
@section('content')
  <div class=" page-wrapper{{-- jumbotron --}}">
    <div class="container-fluid">
      <div class="">

        <!-- Page Heading -->
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <h1 class="page-header">
              Multimedia <small>Editar contenido multimedia {{$multimedia->title}}</small>
            </h1>
            <ol class="breadcrumb">
              <li class="active">
                <i class="fa fa-dashboard"></i> Multimedia
              </li>
            </ol>
          </div>
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            @include('alerts.allAlerts')
          </div><!-- -->
          <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            {!!Form::model($multimedia,[
              'method'=>'PUT',
              'id'=>'multimedia_edit',
              'route' => ['multimedia.update', $multimedia->id] ])!!}
            @include('multimedia.forms.fieldsCreateEdit')
          </div><!-- -->

          {{--
          DEPRECATED 25-12-2016
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
            <div class="list-group">
              <div class="list-group-item">
                Espacio publicitario
              </div><!-- -->
              <div class="list-group-item">
                Sugerencias, relateds, etc.
              </div><!-- -->
            </div><!-- -->
          </div><!-- -->
          --}}

        </div><!-- -->
      </div><!-- -->
    </div>
  </div><!-- -->
@stop