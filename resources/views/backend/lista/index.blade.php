@extends('layouts.master')
@section('title', 'Lista')
@section('content')

@include('layouts.flash')

<div class="row">
    <div class="well col-lg-6">
        
        <p><b> Nombre Mazo : </b> {{$eventoMazo->EVM_NOMBRE_MAZO}}</p>
        <p><b> Evento : </b> {{$eventoMazo->ToEventos->EVN_NOMBRE}}</p>
        <p><b> Tipo  : </b> {{$eventoMazo->ToMazos->MAZ_NOMBRE}}</p>
        <p><b> Jugador : </b> {{$eventoMazo->ToJugadores->JGD_NOMBRE}}</p>
            
    </div>
    <div class='col-lg-6'>
        {{Form::open(array('id' => 'formcarta'))}}
        <div class="form-group col-lg-12">
             {{Form::label('Carta','Nombre')}}            
             {{Form::text('NOMBRE',null,[ 'id'=>'NOMBRE' , 'class'=>'form-control' ])}}            
             {{Form::label('tipocarta','Tipo')}}            
             {{Form::select('TCR_ID', $tiposcarta, null, array('class' => 'form-control','id'=>'TCR_ID'))}}
             {{Form::label('ID_CARTA','Carta')}}   
             <select name="ID_CARTA" id="ID_CARTA" class="form-control" >
                 
             </select>
             {{Form::label('cantidad','Cantidad')}}            
             {{Form::text('CANTIDAD',null,[ 'id'=>'CANTIDAD' , 'class'=>'form-control' ])}} 
             {{link_to('#',$title='Registrar',$attributes = ['id'=>'enviar','class'=>'btn btn-primary'])}}
             {{Form::hidden('EVM_ID',$eventoMazo->EVM_ID,[ 'id'=>'EVM_ID' , 'readonly'=>'readonly' ])}}
        </div>
        {{Form::close()}}
        
      
        
    </div>
    <div class='col-lg-12'>
        <table class='table table-striped'>
            <thead>
                <tr>
                    <th>Cantidad</th>
                    <th>Carta</th>
                    <th>Tipo</th>
                    <th>-</th>
                    <th>-</th>
                </tr>
            </thead>
            <tbody id="bodytable">
                @foreach($listaCartas as $l)
                <tr>
                    <td>{{$l->LST_CANTIDAD}}</td>
                    <td>{{$l->ToCartas->CRT_NOMBRE}}</td>
                    <td>{{$l->ToTipoCarta->TCR_NOMBRE}}</td>
                    <td> 
                    <a class="btn btn-default btn-xs btn-default edit" data-toggle="modal" data-target="#myModal" title="Editar" href="{{ url('lista/' . $l->LST_ID . '/edit') }}"> 
                     <span class="glyphicon glyphicon-search"></span>   
                    </a>
                    </td>
                    <td>
                        <button name="eliminar" type="buton" class="btn btn-xs btn-danger" onclick="Eliminar({{$l->LST_ID}})">
                            <span class="glyphicon glyphicon-minus-sign"></span>
                        </button>
                    </td>
                </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
    
    
    
</div>



<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
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
            $( "#enviar" ).click(function() {
                event.preventDefault();
                //alert('click');
                var data_form = $("#formcarta").serialize();
                var token  = $('#token').val();
                var url = "{!!URL::to('/lista')!!}";
                var tabla = $('#bodytable');
                //alert(ruta);
                    $.ajax({
                    headers: {"X-CSRF-TOKEN": token},
                    method: "POST",
                    url: url,
                    data: data_form,
                    dataType: "json",
                            success: function(result) {
                                //$("#myInfo").remove();
                                //alert("Data found");
                                //alert(result);
                                var html = "";
                                tabla.html("");
                                $(result).each(function( index, value ) {
                                    html = "<tr>";
                                    html += "<td>"+value.cantidad+"</td>";
                                    html += "<td>"+value.nombre+"</td>";
                                    html += "<td>"+value.tipocarta+"</td>";
                                    html += "<td><a class='btn btn-default btn-xs btn-default edit' data-toggle='modal' data-target='#myModal' title='ver' href='{!!URL::to('/lista/"+value.id+"/edit')!!}'><span class='glyphicon glyphicon-search'></span> </a></td>"; 
                                    html += "<td><button name='eliminar' type='buton' class='btn btn-xs btn-danger' onclick='Eliminar("+value.id+")' ><span class='glyphicon glyphicon-minus-sign'></span></button></td>"; 
                                    html += "</tr>";
                                    tabla.append(html);
                                    console.log( value.id + value.nombre );
                                });
                                $('#NOMBRE').val("");
                            },
                            error: function(result) {
                                alert("Data not found");
                            }
                  });
            }); 

            $( "#NOMBRE" ).keyup(function() {

                        var selectcbo = $("#ID_CARTA");
                        var nombrecarta  = $("#NOMBRE" ).val();
                        var route = "{!!URL::to('/getcartasbyid')!!}";
                        var token  = $("input[name*='_token']").val();

                       if(parseInt(nombrecarta.length) > 3  ){
                           console.clear();
                           console.log('BUSCAR');
                        selectcbo.html("");
                        //selectjgd.append("<option value=''>SELECCIONE UN JUGADOR</option>");
                        $.post( route, { nombrecarta: nombrecarta , _token : token })
                        .done(function( data ) {
                            $(data).each(function( index, value ) {
                                selectcbo.append("<option value='"+value.id+"'> "+value.nombre+"</option>");
                                console.log( value.id + value.nombre );
                            });
                        });
                       }
            });


            function  Eliminar(id){
                var cartid = id;
                var token  = $("input[name*='_token']").val();
                var url = "{!!URL::to('/lista/"+cartid+"')!!}";
                var tabla = $('#bodytable');
             
                    $.ajax({
                         headers: {"X-CSRF-TOKEN": token},
                         method: "DELETE",
                         url: url,
                         dataType: "json",
                                 success: function(result) {
                                     alert("Eliminado con exito");
                                     var html = "";
                                     tabla.html("");
                                     $(result).each(function( index, value ) {
                                         html = "<tr>";
                                         html += "<td>"+value.cantidad+"</td>";
                                         html += "<td>"+value.nombre+"</td>";
                                         html += "<td>"+value.tipocarta+"</td>";
                                         html += "<td><a class='btn btn-default btn-xs btn-default edit' data-toggle='modal' data-target='#myModal' title='ver' href='{!!URL::to('/lista/"+value.id+"/edit')!!}'><span class='glyphicon glyphicon-search'></span> </a></td>"; 
                                         html += "<td><button name='eliminar' type='buton' class='btn btn-xs btn-danger' onclick='Eliminar("+value.id+")' ><span class='glyphicon glyphicon-minus-sign'></span></button></td>"; 
                                         html += "</tr>";

                                         tabla.append(html);
                                         console.log( value.id + value.nombre );
                                     });
                                     //$('#formcarta').trigger("reset");
                                 },
                                 error: function(result) {
                                     alert("No se pudo eliminar");
                                 }
                    });
            }
    


</script>
@endsection
