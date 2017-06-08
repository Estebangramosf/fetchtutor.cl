@extends('layouts.master')
@section('title', 'Mazos')
@section('content')

@include('layouts.flash')

<!-- <button type="button" class="btn btn-xs btn-success"><a href="{!!URL::to('/mazos/create')!!}" > AGREGAR </a> </button> -->
{{link_to_route('mazos.create', 'Agregar', $parameters = null , $attributes = ['class'=>'btn btn-success'])}}
<div align="center">
        <table class="table table-striped table-hover">
            <tr >
                <th>ID</th>
                <th>NOMBRE</th>
                <th>FORMATO</th>
                <th colspan="2">OPCIONES</th>
            </tr>

            @foreach($mazos as $m)
            
            <tr>
                <td> {{ $m->MAZ_ID }}</td>
                <td> {{ $m->MAZ_NOMBRE }}</td>
                <td> {{ $m->formato->FTO_NOMBRE }}</td>
                <td> {{link_to_route('mazos.edit', 'editar', $parameters = $m->MAZ_ID , $attributes = ['class'=>'btn btn-xs btn-warning'])}} </td>
                <td> </td>
            </tr>
            @endforeach         
        </table>

        <nav class="paginacion">
            {!! $mazos->render() !!}
        </nav>
</div>

@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        
    });
</script>
@endsection