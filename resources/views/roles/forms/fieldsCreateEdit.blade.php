<div class="list-group" >
  <div class="list-group-item">
    <h4>
      @if(Request::path()=='roles/create')
        <a href="{{url('/roles/create')}}">Nuevo rol</a>
      @else
        <a href="{{url('/roles/'.(isset($role->id)?$role->id:1).'/edit')}}">Editar rol</a>
      @endif

      <a href="{{url('/roles')}}" style="float:right;" class="btn btn-success">Volver al listado</a>
    </h4>
  </div><!-- /div .list-group-item -->
  <div class="list-group-item">

    <div class="form-group has-feedback has-feedback-left">
      {!!Form::label('Nombre:')!!}
      {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre del rol'])!!}
    </div><!-- /div .list-group-item -->
    <div class="form-group has-feedback has-feedback-left">
      {!!Form::label('Descripción:')!!}
      {!!Form::textarea('description',null,['class'=>'form-control','placeholder'=>'Ingrese descripción del rol','rows' => '5'])!!}
    </div><!-- /div .form-group .has-feedback .has-feedback-left -->
    <div class="form-group has-feedback has-feedback-left">
      {!!Form::submit('Guardar', ['class'=>'btn btn-primary btn-success'])!!}
      {!!Form::close()!!}

      @if(strpos(Request::path(),'edit', 8))
        {!!Form::open(['action'=> ['RoleController@destroy', $role->id], 'method'=>'DELETE'])!!}
        {!!Form::submit('Eliminar', ['class'=>'btn btn-primary btn-danger', 'id'=>'eliminar'])!!}﻿
        {!!Form::close()!!}
      @endif
    </div><!-- -->
  </div><!-- /div .list-group-item -->
</div><!-- /div .list-group -->
