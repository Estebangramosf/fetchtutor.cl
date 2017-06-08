<div class="row">
    <?php /*
    {!! Form::hidden('JGD_ID',isset($jugador->JGD_ID) ? $jugador->JGD_ID : '', ['class' => 'form-control','type'=>'hidden']) !!}
    <div class="col-lg-6 ">
            {!! Form::label('JGD_NOMBRE', 'NOMBRE', array('class' => 'col-lg-3')) !!}
            <div class="col-lg-9">
               {!! Form::text('JGD_NOMBRE',isset($jugador->JGD_NOMBRE) ? $jugador->JGD_NOMBRE : '', ['class' => 'form-control']) !!}
            </div>
    </div>
    <div class="col-lg-6">
         {!! Form::label('JGD_DCI', 'DCI', array('class' => 'col-lg-3')) !!}
         <div class="col-lg-9">
         {!! Form::text('JGD_DCI',isset($jugador->JGD_DCI) ? $jugador->JGD_DCI : '', ['class' => 'form-control']) !!}
         </div>
    </div>
     */ ?>
    <div class="col-lg-6">
        {!! Form::label('EVN_NOMBRE', 'NOMBRE', array('class' => 'col-lg-3')) !!}
        <div class="col-lg-9">
            {!! Form::text('EVN_NOMBRE',isset($evento->EVN_NOMBRE) ? $evento->EVN_NOMBRE : '', ['class' => 'form-control' , 'id' => 'EVN_NOMBRE' ,]) !!}
        </div>
    </div>
    <div class="col-lg-6">
        {!! Form::label('FTO_ID', 'FORMATO', array('class' => 'col-lg-3')) !!}
        <div class="col-lg-9">
            {!! Form::select('FTO_ID', $formatos, isset($evento->FTO_ID) ? $evento->FTO_ID : '', array('class' => 'form-control col-lg-6')) !!}
        </div>
    </div>
    <div class="col-lg-6">
        {!! Form::label('TND_ID', 'TIENDA', array('class' => 'col-lg-3')) !!}
        <div class="col-lg-9">
            {!! Form::select('TND_ID', $tiendas, isset($evento->TND_ID) ? $evento->TND_ID : '', array('class' => 'form-control col-lg-6')) !!}
        </div>
    </div>
    <div class="col-lg-6">
        {!! Form::label('FECHA', 'FECHA', array('class' => 'col-lg-3')) !!}
        <div class="col-lg-9">
            <div class="input-group date" data-provide="datepicker">
                <input type="text" class="form-control" name="FECHA" id="FECHA" readonly="readonly" value="{{isset($fecha) ? $fecha : ''}}" >
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>
    </div>
    
   
</div>
    

 