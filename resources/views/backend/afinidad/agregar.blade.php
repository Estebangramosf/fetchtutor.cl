{!! Form::open(['route' => 'afinidad.store', 'method' => 'POST', 'class' => 'form-horizontal crear','role'=>'form']) !!}
    <div class="modal-header">
            <h4 class="modal-title titulo_formulario" id="">Agregar Afinidad</h4>
    </div>
    <div class="modal-body">    
        @include('bootstrap.afinidad.form.afinidad')
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn_cancel" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary btn_ok">Enviar</button>
    </div>
{!! Form::close() !!}
<script type="text/javascript">
    $('form.crear').submit(function(){
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            method: 'POST',
            dataType: 'json',
            beforeSend: function(xhr) {
                startLoadingForm('.crear');
            },
            success: function(data, textStatus, jqXHR ) {
                //OK
                window.location.reload();
                return true;
            },
            error: function(jqXHR, textStatus, errorThrown){
                stopLoadingForm('.crear', 'Enviar');
                
                var errores = $.parseJSON(jqXHR.responseText);
                var keys    = Object.keys(errores);
                
                for(var i = 0; i < keys.length; i++) {
                    error_sin_cerrar(errores[keys[i]][0], '.modal-body');
                }
            }
        });
        
        return false;
    });
</script>