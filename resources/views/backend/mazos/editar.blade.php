@extends('layouts.master')
@section('title', 'Mazos')
@section('content')

@include('layouts.error')

{!! Form::model($mazo, array('route' => array('mazos.update', $mazo->MAZ_ID), 'method'=>'PUT', 'class' => 'form-horizontal editar', 'role'=>'form')) !!}
<div class="modal-header">
    <h4 class="modal-title titulo_formulario" id="">EDITAR MAZO</h4>
</div>
<div class="modal-body">    
    @include('backend.mazos.form.mazos')
</div>
<div class="modal-footer">
    
    <button type="submit" class="btn btn-primary btn_ok">Actualizar</button>
</div>
{!! Form::close() !!}

@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        
    });
</script>
@endsection