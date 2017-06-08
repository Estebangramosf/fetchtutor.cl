@section('title') Multimedia @endsection
@extends('layouts.app')
@section('content')
  <div class="{{-- jumbotron --}}">
    <div class="container-fluid">
      <div class="">

        <!-- Page Heading -->
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h1 class="page-header">
              Multimedia <small>Contenido público</small>
            </h1>
            <ol class="breadcrumb">
              <li class="active">
                <i class="fa fa-dashboard"></i> Multimedia
                @if(Auth::check()&&Auth::user()->role!='user'/*&&Auth::user()->role!='admin'*/)
                  ·
                  <a class="btn-link" href="{{url('/multimedia/create')}}">
                    Nuevo contenido multimedia
                  </a>
                @endif
              </li>
            </ol>
          </div>
        </div>
        <!-- /.row -->

        <div class="row">

          <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
            @include('alerts.allAlerts')
          </div><!-- .col-xs-sm-md-lg-12 -->

          <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">

            @foreach($multimedias as $key => $multimedia)
              <div class="list-group">
                <div class="list-group-item">
                  <div class="row">
                    <div class="col-xs-12 col-sm-2 col-md-3 col-lg-3">
                      <div class="embed-responsive embed-responsive-16by9">

                        <iframe class="embed-responsive-item"
                                src="{{str_replace('watch?v=', 'embed/',$multimedia->youtube_link)}}">
                        </iframe>
                        <!-- src="https://www.youtube.com/embed/lgZBsWGaQY0"> -->
                        <!-- src="https://www.youtube.com/embed/lgZBsWGaQY0?autoplay=1">-->
                        @if(!$multimedia->youtube_link)
                          <a href="{{url('/multimedia/'.$multimedia->id)}}" class="thumbnail" style="padding:0px;">
                            {{Html::image('/img/backgrounds/iconoCargando.gif',
                              $alt="Photo", $attributes = array('style'=>
                              'width:100%;height:100%;max-width:300px;max-height:300px;')) }}
                              <div class="caption">
                                El video no se encuentra disponible
                              </div>
                          </a>
                        @endif
                      </div>
                    </div>
                    <!-- https://www.youtube.com/watch?v=Zl1tte139c4  -->
                    <div class="col-xs-12 col-sm-10 col-md-9 col-lg-9">
                      <div class="form-group has-feedback has-feedback-left">
                        <h3><a href="{{url('/multimedia/'.$multimedia->id)}}">{{$multimedia->title}}</a></h3>
                      </div><!-- -->
                      <hr>
                      <div class="form-group has-feedback has-feedback-left">
                        <h4>
                        <?php
                          $multimedia->body =
                            preg_replace("/((http|https|www)[^\s]+)/",
                              '<a target=\"_blank\"
                              href="$1">$0</a>',
                              $multimedia->body);
                          $multimedia->body =
                            preg_replace("/href=\"www/",
                              'href="http://www',
                              $multimedia->body);
                          $multimedia->body =
                            preg_replace("/(@[^\s]+)/",
                              '<a target=\"_blank\"
                                href="http://twitter.com/intent/user?screen_name=$1">
                                  $0
                              </a>',
                              $multimedia->body);
                          $multimedia->body =
                            preg_replace("/( #[^\s]+)/",
                              '<a
                                class="hashtag"
                                target=\"_blank\"
                                href="https://twitter.com/hashtag/$1?src=tren">
                                  $0
                              </a>',
                              $multimedia->body);
                          /*
                          $multimedia->body =
                            preg_replace("/( &[^\s]+)/",
                              '<a
                                class="searchTwitter"
                                target=\"_blank\"
                                href="https://twitter.com/search?q=$1">
                                  $0
                              </a>',
                              $multimedia->body);
                          */
                        ?>
                        {!!strip_tags($multimedia->body,'<ul><li><ol><img><a><p><span><strong><blockquote><b><pre><em><h1><h2><h3><h4><h5><h6><sup><sub><code>')!!}
                          <!-- <'a'> => etiquetas a las que escapa strip_tags-->
                        </h4>
                      </div><!-- .form-group -->

                    </div><!-- .col-xs\sm\md\lg-8 -->		      
                    @if(Auth::check()&&$multimedia->user_id==Auth::user()->id)
                      <div align="" class="">
                        <a href="{{url('/multimedia/'.$multimedia->id.'/edit')}}"
                           style="" class="btn btn-link">
                          {{Html::image('/img/glyphicons/glyphicons/png/glyphicons-31-pencil.png',
                            $alt="Photo", $attributes = array('style'=>
                            'width:15px;height:15px;')) }}
                          Editar
                        </a>
                      </div>
                    @endif		    
		    
                  </div><!-- .row -->
                </div><!-- .list-group-item -->
                <div class="list-group-item">
                  <small>
                    Publicado por {{$multimedia->user->name}}
                    <span style="float:right;">
                      <a href="{{url('/multimedia/'.$multimedia->id)}}">{{$multimedia->created_at}}</a>
                    </span>
                  </small>
                </div>
                <div class="list-group-item">
                  Comentarios

                  <span style="float:right;">
                    {{$count_comments = $multimedia->multimedia_comments->count()}}
                    @if($count_comments>0)
                      <a href="{{url('/multimedia/'.$multimedia->id)}}">
                        · <small>Ver comentarios</small>
                      </a>
                    @else
                      <a href="{{url('/multimedia/'.$multimedia->id)}}">
                        · <small>¡Se el primero en comentar!</small>
                      </a>
                    @endif
                  </span>
                </div><!-- .list-group-item -->
              </div><!-- .list-group -->
              @if($key+1 < $multimedias->count())
                <hr>
              @endif
            @endforeach

          {{$multimedias->render()}}
          </div><!-- .col-xs-sm-md-lg-12 -->

          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
            <div class="list-group">
              <div class="list-group-item">
                Espacio publicitario
              </div><!-- -->
              <div class="list-group-item">
                Sugerencias, relateds, etc.
              </div><!-- -->
            </div><!-- -->
          </div><!-- -->

        </div><!-- -->
      </div><!-- -->
    </div>

  </div><!-- -->
@endsection

