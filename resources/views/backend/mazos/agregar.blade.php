@extends('layouts.master')
@section('title', 'Mazos')
@section('content')

@include('layouts.error')

{!! Form::open(['route' => 'mazos.store', 'method' => 'POST', 'class' => 'form-horizontal crear','role'=>'form']) !!}
<div class="modal-header">
    <h4 class="modal-title titulo_formulario" id="">AGREGAR MAZO</h4>
</div>
<div class="modal-body">    
    @include('backend.mazos.form.mazos')
</div>
<div class="modal-footer">
    
    <button type="submit" class="btn btn-primary btn_ok">Enviar</button>
</div>
{!! Form::close() !!}

@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        
    });
</script>
@endsection