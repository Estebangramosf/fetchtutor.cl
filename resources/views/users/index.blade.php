<!-- Section to push page title -->
@section('title') Usuarios @endsection

<!-- Parent layout import -->
@extends('layouts.app')

<!-- Section to push page content -->
@section('content')
	<div class="page-wrapper{{-- jumbotron --}}">
		<div class="container-fluid">
			<div class="">

				<!-- ID Controller for vueJs -->
				<div id="List">

					<!-- Page Heading -->
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
							<h1 class="page-header">
								<!-- Admin -->
								<small>Administrador de usuarios</small>
							</h1>
							<a href="{{url('/users/create')}}" style="float:right;" class="btn btn-link btn-sm">
								Crear nuevo usuario
							</a>
							<ol class="breadcrumb">
								<li class="active">
									<i class="fa fa-dashboard"></i> 
									Liste, agregue, edite o elimine usuarios registrados a través de esta página
								</li>
							</ol>
						</div>
					</div><!-- /.row -->

					<div class="row">

						<!-- Alert imports -->
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
							@include('alerts.allAlerts')
						</div><!-- /Alerts imports -->

						<!-- Main cols -->
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
							<div class="list-group">

								<!-- Header content title in group of users list -->
								<div class="list-group-item">
									<h4>
										Listado de Usuarios <span style="float: right;">({{$users}} Usuarios registrados)</span>
									</h4>
								</div>
								<!-- List group for users information -->
								<div class="list-group-item">

									<!-- Input for write term to search -->
									<input type="text" class="form-control" placeholder="Buscar ..." v-model="filterTerm" id="filterTerm">

									<!-- paginators component  -->
									<div class="text-center">
										<paginators :pagination="pagination" @navigate="navigate"></paginators>
									</div><!-- .text-center -->

									<div class="row">
										<!-- Here can be add all filters that u need, in v-for -->
										<!-- users-list component -->
										<users-list
											v-for="user in filterBy(users, filterTerm, 'name', 'role', 'email')"
											:user="user"
											v-bind:key="user">
										</users-list>
										<input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
									</div>


									<!-- paginators component  -->
									<div class="text-center">
										<paginators :pagination="pagination" @navigate="navigate"></paginators>
									</div>

								</div><!-- .list-group-item users info -->
							</div><!-- .list-group parent users -->
						</div><!-- .col-* parent -->

						<!-- Advertisement column, or sugests -->
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
							<div class="list-group">
								<div class="list-group-item">
									Espacio publicitario
								</div><!-- -->
								<div class="list-group-item">
									Sugerencias, relateds, etc.
								</div><!-- -->
							</div><!-- -->
						</div><!-- .col-* -->
					</div><!-- .row parent -->
				</div><!-- #ListController app for vue -->
			</div>
		</div><!-- only div -->
	</div><!-- .container-fluid -->
</div><!-- .page-wrapper -->
@endsection


<!-- Section to push view scripts -->
@section('VueFrontend')
	{!!Html::script('js/api/controllers/users/ListController.js')!!}
@endsection