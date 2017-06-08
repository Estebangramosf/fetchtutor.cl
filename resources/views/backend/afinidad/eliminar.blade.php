{!! Form::open(['route' => array('afinidad.destroy', $afn->AFN_ID), 'method' => 'DELETE', 'class' => 'form-horizontal eliminar', 'role'=>'form']) !!}
    <div class="modal-header">
        <h4 class="modal-title titulo_formulario" id="">Confirmar eliminación</h4>
    </div>
    <div class="modal-body">    
        <p>Seguro desea eliminar la afinidad {{ $afn->AFN_NMB }}?</p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn_cancel" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary btn_ok">Confirmar</button>
    </div>
{!! Form::close() !!}

<script type="text/javascript">
    $('form.crear').submit(function(){
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            method: 'DELETE',
            dataType: 'json',
            beforeSend: function(xhr) {
                startLoadingForm('.eliminar');
            },
            success: function(data, textStatus, jqXHR ) {
                //OK
                window.location.reload();
                return true;
            },
            error: function(jqXHR, textStatus, errorThrown){
                stopLoadingForm('.eliminar', 'Confirmar');
                
                var errores = $.parseJSON(jqXHR.responseText);
                var keys    = Object.keys(errores);
                
                for(var i = 0; i < keys.length; i++) {
                    error(errores[keys[i]][0], '.modal-body');
                }
            }
        });
        
        return false;
    });
</script>
