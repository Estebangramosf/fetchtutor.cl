@section('title') New User @endsection
@extends('layouts.app')
@section('content')
	<div class="page-wrapper{{-- jumbotron --}}">
		<div class="container-fluid">
			<div class="">

				<!-- ID Controller for vueJs -->
				<div id="Create">

					<!-- Page Heading -->
					<!-- row principal que contiene ambas secciones editar/crear -->
					<div class="row">

						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<h1 class="page-header">
								Usuarios <small>Crear nuevo usuario</small>
							</h1>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							@include('alerts.allAlerts')
						</div>

						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

							<ol class="breadcrumb">
								<li class="active">
									<i class="fa fa-dashboard"></i>
									Cree rápidamente un nuevo usuario.
								</li>
							</ol>

						</div><!-- Segunda seccion -->

						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<users-create></users-create>
							<input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
						</div>

					</div><!-- /.row -->

				</div><!-- /#Create -->
			</div><!-- -->
		</div><!-- /.cointainer-fluid -->
	</div><!-- /.page-wrapper -->
@endsection

	<!-- Section to push view scripts -->
@section('VueFrontend')
	{!!Html::script('js/api/controllers/users/CreateController.js')!!}
@endsection