@extends('layouts.app')

@section('content')

  <div class="container-fluid">

    <div class="row">

      <div align="center" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="list-group">

          <div class="list-group-item">
            <span style="float:right;">
              <a href="{{url('/users/'.$user->id.'/edit')}}">
                Actualizar mi Informaci&oacute;n
              </a>
            </span>
            <h2>Perfil de usuario</h2> <br>
          </div>

          <div class="list-group-item">
            <img width="30%" src="{!! asset('img/backgrounds/logopuntok.png') !!}" alt="">
          </div>
          <div class="list-group-item">
            <h4>Nombre: {{$user->name}}</h4> <br>
          </div>
          <div class="list-group-item">
            <h4>Dirección de Correo: {{$user->email}}</h4> <br>
          </div>
          <div class="list-group-item">
            <h4>Tipo usuario: {{$user->role}}</h4> <br>
          </div>
          <div class="list-group-item">
            @if($user->church)
              <h4>Iglesia: {{$user->church->name}}</h4> <br>
            @else
              <h4>Aún no escoge su iglesia</h4> <br>
            @endif
          </div>
          <div class="list-group-item">
            <h4>Miembro desde: {{$user->created_at}}</h4> <br>
          </div>
          <div class="list-group-item">
            <h4>Última modificación del perfil: {{$user->updated_at}}</h4> <br>
          </div>

        </div>
      </div>

{{--
      <div align="center" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="list-group">

          <div class="list-group-item">
            <h2>Opciones</h2> <br>
          </div>
          <div class="list-group-item">
            <img width="30%" src="{!! asset('img/backgrounds/DemboraPerfil.png') !!}" alt="">
          </div>
          <div class="list-group-item">
            <h4>
              <a href="#!" class="btn btn-default">Actualizar información</a>
            </h4> <br>
          </div>
        </div>

      </div>
--}}

    </div>

  </div>

@endsection