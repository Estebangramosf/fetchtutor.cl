@extends('layouts.master')
@section('title', 'Eventos')
@section('content')

@include('layouts.flash')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-lg-12">
    <a class="btn btn-success btn_ok" data-toggle="modal" data-target="#myModal" href="{!! URL::to('participantes/scoreparticipantes/'.$evento->EVN_ID) !!}">Agregar</a>
    <br><br>
    </div>
</div>
<div class="row">
    @foreach($participantes as $p)
        <div class="col-sm-4">
            <div class="panel panel-default"">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$p->EVM_POSICION}}  {{$p->ToMazos->MAZ_NOMBRE}}</h3>
                </div>
                <div class="panel-body">
                    <div class="col-lg-12"> 
                        <p>{{$p->EVM_NOMBRE_MAZO}}</p>
                        <p>{{$p->ToJugadores->JGD_NOMBRE}}</p>
                        <p>{{$p->ToEventos->EVN_NOMBRE}}</p>
                    </div>
                    
                    <div class="col-xs-4  col-sm-4 col-lg-4">
                        <a class="btn btn-default  btn-warning edit" data-toggle="modal" data-target="#myModal" title="Editar" href="{{ url('participantes/editscoreparticipantes/' . $p->EVM_ID . '') }}"> <span class="glyphicon glyphicon-pencil"></span></a> 
                    </div>
                    <div class="col-xs-4  col-sm-4 col-lg-4">
                        {!! Form::model($p, array('route' => array('participantes.destroy', $p->EVM_ID), 'method'=>'DELETE', 'class' => 'form-horizontal editar', 'role'=>'form')) !!}
                            {!! Form::hidden('EVN_ID',$evento->EVN_ID, ['class' => 'form-control','readonly'=>'readonly']) !!}
                            {!! Form::hidden('EVM_ID',$p->EVM_ID, ['class' => 'form-control','readonly'=>'readonly']) !!}
                            <button type="submit" class="btn  btn-danger"><span class="glyphicon glyphicon-minus-sign"></span></button>
                        {!! Form::close() !!}
                    </div>
                    <div class="col-xs-4  col-sm-4 col-lg-4">
                        <a class="btn btn-default  btn-primary edit"  title="Agregar" href="{{ url('lista/' . $p->EVM_ID . '') }}"> <span class="glyphicon glyphicon-plus-sign"></span></a>
                    </div>
                </div>
            </div>
        </div>
    
    
        
    @endforeach
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" id="modal_body">
            
            <div class="modal-body" >
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div> 

@endsection
@section('js')
<script type="text/javascript">
    
        
        
    
</script>
@endsection
