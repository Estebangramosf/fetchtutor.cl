<div class="row">
        
        {!! Form::hidden('EVN_ID',$evento->EVN_ID, ['class' => 'form-control','readonly'=>'readonly']) !!}
        <div class="col-lg-12">
            {!! Form::label('EVENTO', 'EVENTO', array('class' => 'col-lg-3')) !!}
            <div class="col-lg-9">
                {!! Form::text('EVENTO',$evento->EVN_NOMBRE, ['class' => 'form-control','readonly'=>'readonly']) !!}
            </div>
        </div>
        <div class="col-lg-12">
            {!! Form::label('BUSCADOR', 'BUSCADOR DCI', array('class' => 'col-lg-3')) !!}
            <div class="col-lg-9">
                {!! Form::text('DCI','', ['class' => 'form-control', 'id'=>'DCI']) !!}
            </div>
        </div>
        <div class="col-lg-12">
            {!! Form::label('JUGADOR', 'JUGADOR', array('class' => 'col-lg-3')) !!}
            <div class="col-lg-9">
                {!! Form::select('JGD_ID', $jugadores, isset($eventomazo->JGD_ID) ? $eventomazo->JGD_ID : '' , array('class' => 'form-control col-lg-6' , 'id'=>'JGD_ID')) !!}
            </div>
        </div>
        <div class="col-lg-12">
            {!! Form::label('EVM_NOMBRE_MAZO', 'NOMBRE MAZO', array('class' => 'col-lg-3')) !!}
            <div class="col-lg-9">
                {!! Form::text('EVM_NOMBRE_MAZO',isset($eventomazo->EVM_NOMBRE_MAZO) ? $eventomazo->EVM_NOMBRE_MAZO : '' , ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-12">
            {!! Form::label('MAZO', 'TIPO MAZO', array('class' => 'col-lg-3')) !!}
            <div class="col-lg-9">
                {!! Form::select('MAZ_ID', $mazos, isset($eventomazo->MAZ_ID) ? $eventomazo->MAZ_ID : '' , array('class' => 'form-control col-lg-6')) !!}
            </div>
        </div>
        <div class="col-lg-12">
            {!! Form::label('POSICION', 'POSICIÓN', array('class' => 'col-lg-3')) !!}
            <div class="col-lg-9">
                {!! Form::text('EVM_POSICION',isset($eventomazo->EVM_POSICION) ? $eventomazo->EVM_POSICION : '', ['class' => 'form-control']) !!}
            </div>
        </div>
</div>

 