@extends('layouts.master')
@section('title', 'Eventos')
@section('content')

@include('layouts.flash')

{{link_to_route('eventos.create', 'Agregar', $parameters = null , $attributes = ['class'=>'btn btn-success'])}}
<div class="table-responsive">
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>FECHA</th>
            <th>NOMBRE</th>
            <th>FORMATO</th>
            <th>TIENDA</th>
            <th colspan='3'>Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($eventos as $e)
        <tr>
            <td>{{$e->EVN_ID}}</td>
            <td>{{$e->EVN_FECHA}}</td>
            <td>{{$e->EVN_NOMBRE}}</td>
            <td>{{$e->ToFormatos->FTO_NOMBRE}}</td>
            <td>{{$e->ToTiendas->TND_NOMBRE}}</td>
            <td>
                <a href="{{ url('eventos/' . $e->EVN_ID . '/edit') }}" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
            <td>
                {!! Form::model($e, array('route' => array('eventos.destroy', $e->EVN_ID), 'method'=>'DELETE', 'class' => 'form-horizontal editar', 'role'=>'form')) !!}
                    <button type="submit" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-minus-sign"></span></button>
                {!! Form::close() !!}
            </td>
            <td>
                <a href="{{ url('participantes/' . $e->EVN_ID . '') }}" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
            </td>
        </tr>    
        @endforeach
    </tbody>
</table>
</div>

<nav class="paginacion">
    {!! $eventos->render() !!}
</nav>

@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        
        
    });
</script>
@endsection