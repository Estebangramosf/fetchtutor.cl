@extends('bootstrap.layouts.master')
@section('title', 'Afinidades')
@section('title_content', 'Afinidades')

@section('content')
<ol class="breadcrumb">
    <li class="active">Inicio</li>
    <li class="active">Creación - Mantención</li>
    <li class="active">Afinidades</li>
</ol>

<div class="bg_contenido">

<a class="btn btn-default pull-right btn_ok" data-toggle="modal" data-target="#modal" href="{!!URL::to('/afinidad/create')!!}" class="btn btn-default" >Agregar</a>
<table class="table table-hover table-striped"  >
    <thead>
        <tr>
            <th class="encabezado_tabla">Codigo Afinidad</th>
            <th class="encabezado_tabla">Nombre Afinidad</th>
            <th class="encabezado_tabla">Marca</th>
            <th class="encabezado_tabla">Tipo</th>
            <th class="encabezado_tabla">Logo</th>
            <th class="encabezado_tabla">Estado</th>
            <th class="encabezado_tabla" colspan="2" style="text-align: center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($afn as $afinidad)
            <tr>
                <td class="fuente_registro_tabla">{{$afinidad->AFN_CDG_INTERNO}}</td>
                <td class="fuente_registro_tabla">{{$afinidad->AFN_NMB}}</td>
                <td class="fuente_registro_tabla">{{$afinidad->productoMarcas->PRO_MRC_NMB}}</td>
                <td class="fuente_registro_tabla">{{$afinidad->productoTipos->PRO_TPO_NMB}}</td>
                <td class="fuente_registro_tabla">{{$afinidad->productoAlianzas->PRO_ALI_NMB}}</td>
                <td style="text-align: right">
                    <a class="btn btn-default btn-sm btn_tabla" data-toggle="modal" data-target="#modal" href="{{ url('afinidad/' . $afinidad->AFN_ID . '/edit') }}"><i class="fa fa-pencil"></i> editar</a>
                    <a class="btn btn-default btn-sm btn_tabla" data-toggle="modal" data-target="#modal" href="{{ url('afinidad/' . $afinidad->AFN_ID) }}"><i class="fa fa-times"></i> deshabilitar</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<nav class="paginacion">
    {!! $afn->render() !!}
</nav>

</div>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content"></div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        
    });
</script>
@endsection