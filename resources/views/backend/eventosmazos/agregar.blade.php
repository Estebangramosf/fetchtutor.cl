{!! Form::open(['route' => 'participantes.store', 'method' => 'POST', 'class' => 'form-horizontal crear','role'=>'form']) !!}
<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">AGREGAR RESULTADO</h4>
</div>
<div class="modal-body">   
    @include('backend.eventosmazos.form.resultado')
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary btn_ok">Enviar</button>
</div>
{!! Form::close() !!}

<script type="text/javascript" >
$(document).ready(function () {
        
         $( "#DCI" ).keyup(function() {
             
            var selectjgd = $("#JGD_ID");
            var dci  = $("#DCI" ).val();
            var route = "{!!URL::to('/getjugadoresbydci')!!}";
            var token  = $("input[name*='_token']").val();
            
            //alert(token);
            selectjgd.html("");
            //selectjgd.append("<option value=''>SELECCIONE UN JUGADOR</option>");
            $.post( route, { DCI: dci , _token : token })
            .done(function( data ) {
                $(data).each(function( index, value ) {
                    selectjgd.append("<option value='"+value.id+"'> "+value.nombre+"</option>");
                    console.log( value.id + value.nombre );
                });
            });
         });
});
</script>