<div class="form-group">
    {!! Form::label('PRO_MRC_ID', 'Marca', array('class' => 'col-lg-5 control-label fuente_label')) !!}
    <div class="col-lg-6">
        {!! Form::select('PRO_MRC_ID', $pro_mrc, isset($afn->PRO_MRC_ID) ? $afn->PRO_MRC_ID : '', array('class' => 'form-control bg_input')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('PRO_TPO_ID', 'Sub-Producto', array('class' => 'col-lg-5 control-label fuente_label')) !!}
    <div class="col-lg-6">
        {!! Form::select('PRO_TPO_ID', $pro_tpo, isset($afn->PRO_TPO_ID) ? $afn->PRO_TPO_ID : '', array('class' => 'form-control bg_input')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('PRO_ALI_ID', 'Logo', array('class' => 'col-lg-5 control-label fuente_label')) !!}
    <div class="col-lg-6">
        {!! Form::select('PRO_ALI_ID', $pro_ali, isset($afn->PRO_ALI_ID) ? $afn->PRO_ALI_ID : '', array('class' => 'form-control bg_input')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('AFN_CDG_INTERNO', 'Código Afinidad', array('class' => 'col-lg-5 control-label fuente_label')) !!}
    <div class="col-lg-6">
        {!! Form::text('AFN_CDG_INTERNO', null, ['class' => 'form-control bg_input']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('AFN_NMB', 'Nombre Afinidad', array('class' => 'col-lg-5 control-label fuente_label')) !!}
    <div class="col-lg-6">
        {!! Form::text('AFN_NMB', null, ['class' => 'form-control bg_input']) !!}
    </div>
</div>