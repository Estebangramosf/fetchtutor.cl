<div class="list-group" >
	<div class="list-group-item">
		<h4>
			@if(Request::path()=='users/create')
				<a href="{{url('/users/create')}}">Nuevo usuario</a>
			@else
				@if($user->role == 'admin')
					<a href="{{url('/users/'.(isset($user->id)?$user->id:1).'/edit')}}">Editar usuario</a>
					<a href="{{url('/users')}}" style="float:right;" class="btn btn-success">Volver al listado</a>
				@else
					Actualizar Informaci&oacute;n
				@endif
			@endif


		</h4>
	</div><!-- /div .list-group-item -->
	<div class="list-group-item">

		<div class="form-group has-feedback has-feedback-left">
			{!!Form::label('Nombre:')!!}
			{!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre del usuario'])!!}
		</div><!-- /div .list-group-item -->
		<div class="form-group has-feedback has-feedback-left">
			{!!Form::label('Email:')!!}
			{!!Form::text('email',null,['class'=>'form-control','placeholder'=>'Ingrese email del usuario'])!!}
		</div><!-- /div .form-group .has-feedback .has-feedback-left -->
		@if($user->role == 'admin')
			<div class="form-group has-feedback has-feedback-left">
				{!!Form::label('Role:')!!}
				<select name="role" id="" class="form-control">
					<option value="0">Seleccione tipo de usuario</option>
					<option {{($user->role=='user')?'selected':''}} value="user">Usuario normal</option>
					<option {{($user->role=='editor')?'selected':''}} value="editor">Editor</option>
					<option {{($user->role=='admin')?'selected':''}} value="admin">Administrador</option>
				</select>
				{{--Form::select('role', ['editor' => 'Editor', 'user' => 'Usuario'], null, ['placeholder' => 'Seleccione un rol', 'class' => 'form-control'])--}}
			</div><!-- /div .form-group .has-feedback .has-feedback-left -->
		@endif
		<div class="form-group has-feedback has-feedback-left">
			{!!Form::label('Miembro de Iglesia:')!!}
			@if($user->church)
				<small>Actualmente en {{($user->church->name)}}</small>
			@else
				<small>Actualmente no est&aacute;s inscrito en una iglesia</small>
			@endif
			<select name="church_id" id="" class="form-control">
				<option value="0">Seleccione una Iglesia</option>
				@foreach($churches as $key => $church)
					<option {{($user->church_id!=$church->id)?:'selected'}} value="{{$church->id}}">{{$church->name}}</option>
				@endforeach
			</select>

		</div><!-- /div .form-group .has-feedback .has-feedback-left -->

		<div>
			{!!Form::submit('Guardar', ['class'=>'btn btn-primary btn-success'])!!}
			{!!Form::close()!!}


		</div><!-- -->
		<div >
			@if(strpos(Request::path(),'edit', 8))
				{!!Form::open(['action'=> ['UserController@destroy', $user->id], 'method'=>'DELETE'])!!}
				{!!Form::submit('Eliminar', ['class'=>'btn btn-primary btn-danger', 'id'=>'eliminar'])!!}﻿
				{!!Form::close()!!}
			@endif		
		</div><!-- -->	
	</div><!-- /div .list-group-item -->
</div><!-- /div .list-group -->
