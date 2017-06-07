@section('title') Edit {!! $user->name !!} @stop
@extends('layouts.app')
@section('content')
	<div class="page-wrapper{{-- jumbotron --}}">
		<div class="container-fluid">
			<div class="">

				<!-- ID Controller for vueJs -->
				<div id="Edit">

					<!-- Page Heading -->
					<!-- row principal que contiene ambas secciones editar/crear -->
					<div class="row">

						<!-- Seccion del encabezado -->
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<h1 class="page-header">
								@if(Auth::user()->role == 'admin')
									<!-- Usuarios -->
								<small>Administrador de usuarios</small>
								@else
									<!-- Mi Perfil -->
								<small>Actualizar Informaci&oacute;n</small>
								@endif
							</h1>
						</div>

						<!-- Seccion de alertas -->
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							@include('alerts.allAlerts')
							<!--<toast v-ref:toast></toast>-->
						</div><!-- -->

						<!-- Primera seccion | izquierda : editar usuario -->
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<div class="row">
								<ol class="breadcrumb">
									<li class="active">
										<i class="fa fa-dashboard"></i>
										Edite personalizadamente al usuario y guarde los datos.
									</li>
								</ol>

								<input type="hidden" id="user" value="{{$user->id}}">
								<!-- Primera seccion -->
								<!-- Declaracion del formulario para editar usuario -->
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<users-edit :user="user"></users-edit>
									<input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
								</div><!-- -->
							</div><!-- /.row -->
						</div><!-- Primera seccion -->

						<!-- Segunda seccion | derecha : crear nuevo usuario -->
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<div class="row">
								<ol class="breadcrumb">
									<li class="active">
										<i class="fa fa-dashboard"></i>
										Ó Cree rápidamente un nuevo usuario.
									</li>
								</ol>
								<!-- Segunda seccion -->
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<users-create></users-create>
								</div><!-- -->
							</div><!-- /.row -->
						</div><!-- Segunda seccion -->

					</div><!-- /.row -->					

				</div><!-- /#Edit -->
			</div><!-- -->
		</div><!-- /.cointainer-fluid -->
	</div><!-- /.page-wrapper -->
@stop

	<!-- Section to push view scripts -->
@section('VueFrontend')
	{!!Html::script('js/api/controllers/users/EditController.js')!!}
@endsection