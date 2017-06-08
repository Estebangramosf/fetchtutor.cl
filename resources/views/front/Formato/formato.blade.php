@extends('layouts.front')
@section('title', 'Inicio')
@section('content')

<div class="container">

        <div class="row">
            <ol class="breadcrumb">
                <li class="active">Eventos</li>
                <li class="active">Formato</li>
            </ol>
            <div class="col-md-3">
                <p class="lead">Mazos</p>
                <div class="list-group">
                    @foreach($mazos as $m)
                        <a href="#" class="list-group-item">{{$m->MAZ_NOMBRE}}</a>
                    @endforeach
                </div>
            </div>

            <div class="col-md-9">

                <div class="thumbnail">
                    <!-- <img class="img-responsive" src="../img/screen1.jpg" alt=""> -->
                    <div class="caption-full">
                        <!--  <h4 class="pull-right">$24.99 </h4>
                        <h4><a href="#">Eventos</a>
                        </h4>
                        -->
                        @foreach($eventos as $e)
                        
                        <div class="col-md-4 portfolio-item">
                            <h3>
                                <a href="#">{{$e->EVN_NOMBRE}}</a>
                            </h3>
                            <p>
                                    <em>{{$e->EVN_FECHA}}</em>  
                                    <br>
                                    Formato : {{$e->ToFormatos->FTO_NOMBRE}}  </a> 
                                    <br>
                                    Tienda : {{$e->ToTiendas->TND_NOMBRE}}
                                    <br>
                                    Jugadores : 50
                                    <br>
                            </p>
                        </div>
                        
                        @endforeach
                        
                        <div class="col-lg-12">
                            <nav class="paginacion">
                                {!! $eventos->render() !!}
                            </nav>
                        </div>
                        

                    </div>
                    
                </div>

                

            </div>

        </div>

    </div>

@endsection
@section('js')
<script>
    $(document).ready(function () {
        
    });
    
</script>
@endsection