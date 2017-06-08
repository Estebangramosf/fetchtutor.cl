@extends('layouts.master')
@section('title', 'Jugadores')
@section('content')

@include('layouts.flash')
<!-- <button type="button" class="btn btn-xs btn-success"><a href="{!!URL::to('/mazos/create')!!}" > AGREGAR </a> </button> -->

<?php /* {{link_to_route('formatos.create', 'Agregar', $parameters = null , $attributes = ['class'=>'btn btn-success'])}} */ ?>
<div align="center">
        <table class="table table-striped table-condensed table-hover">
            <tr >
                <th>ID</th>
                <th>FORMATO</th>
            </tr>

            @foreach($formatos as $f)
            <tr>
                <td> {{$f->FTO_ID}} </td>
                <td> {{$f->FTO_NOMBRE}} </td>
            </tr>
            @endforeach         
        </table>

        <nav class="paginacion">
            {!! $formatos->render() !!}
        </nav>
</div>

@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        
        
    });
</script>
@endsection