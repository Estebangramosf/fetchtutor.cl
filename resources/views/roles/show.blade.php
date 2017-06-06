@section('title') Showing @stop
@extends('layouts.app')
@section('content')
  <div class=" page-wrapper{{-- jumbotron --}}">
    <div class="container-fluid">
      <div class="">

        <!-- Page Heading -->
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h1 class="page-header">
              Roles
              <small>
                Administrador de roles
                ·
                {!! $role->name !!}
              </small>
            </h1>
            <ol class="breadcrumb">
              <li class="active">
                <i class="fa fa-dashboard"></i> Roles ·
                <a href="{{url('/roles')}}" class="btn-link">Volver al listado</a>
              </li>
            </ol>
          </div>
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @include('alerts.allAlerts')
          </div><!-- -->
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <div class="list-group" >
              <div class="list-group-item">
                <h4>
                  Mostrando rol ·
                  {!! $role->name !!}
                  <a href="{{url('/roles/'.$role->id.'/edit')}}" style="float:right;" class="btn-link">Editar</a>
                </h4>
              </div><!-- /div .list-group-item -->
              <div class="list-group-item">
                <div class="form-group has-feedback has-feedback-left">
                  <h2>{{$role->name}}</h2>
                </div><!-- -->
                <div class="form-group has-feedback has-feedback-left">
                  <h4>{{$role->description}}</h4>
                </div><!-- -->
              </div><!-- -->
            </div><!-- -->


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