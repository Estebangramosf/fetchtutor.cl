<div class="row">
    
    {!! Form::hidden('MAZ_ID',isset($mazo->MAZ_ID) ? $mazo->MAZ_ID : '', ['class' => 'form-control','type'=>'hidden']) !!}
    <div class="col-lg-6 ">
            {!! Form::label('FTO_ID', 'FORMATO', array('class' => 'col-lg-3')) !!}
            <div class="col-lg-9">
               {!! Form::select('FTO_ID', $formatos, isset($mazo->FTO_ID) ? $mazo->FTO_ID : '', array('class' => 'form-control col-lg-6')) !!}
            </div>
    </div>
    <div class="col-lg-6">
         {!! Form::label('MAZ_NOMBRE', 'NOMBRE', array('class' => 'col-lg-3')) !!}
         <div class="col-lg-9">
         {!! Form::text('MAZ_NOMBRE',isset($mazo->MAZ_NOMBRE) ? $mazo->MAZ_NOMBRE : '', ['class' => 'form-control']) !!}
         </div>
    </div>
    
</div>
    

 