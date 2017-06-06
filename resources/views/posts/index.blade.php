@section('title') Posts @endsection
@extends('layouts.app')
@section('content')
  <div class="{{-- jumbotron --}}">
    <div class="container-fluid">
      <div class="">

        <!-- Page Heading -->
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <h1 class="page-header">
              Posts <small>Contenido público</small>
            </h1>
            <ol class="breadcrumb">
              <li class="active">
                <i class="| fa-dashboard"></i> Posts
                @if(Auth::check()&&Auth::user()->role!='user'&&Auth::user()->role!='admin')
                  ·
                  <a class="btn-link" href="{{url('/posts/create')}}">Nuevo post</a>
                @endif
              </li>
            </ol>

          </div>
        </div>
        <!-- /.row -->

        <div class="row">

          <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            @include('alerts.allAlerts')
          </div><!-- -->

          <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

            @foreach($posts as $key => $post)
              <div class="list-group">
                <div class="list-group-item">
                  <div class="row">
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" align="middle">

                      @foreach($post->image as $key => $image)

                          <a href="{{url('/posts/'.$post->id)}}" class="thumbnail" style="padding:0px;">
                            {{Html::image('/posts_images/'.$image->image,
                              $alt="Photo", $attributes = array('style'=>
                              'width:auto;height:auto;max-width:100%;', 'class'=>'img-responsive')) }}
                            <div class="caption">
                              {{$post->title}}
                            </div>
                          </a>

                      @endforeach
                      @if(count($post->image)==0)
                        <a href="{{url('/posts/'.$post->id)}}" class="thumbnail" style="padding:0px;">
                          {{Html::image('/img/backgrounds/iconoCargando.gif',
                            $alt="Photo", $attributes = array('style'=>
                            'width:100%;height:100%;max-width:300px;max-height:300px;')) }}
                          <div class="caption">
                            Este post no tiene imagen.
                          </div>
                        </a>
                      @endif

                    </div>

                    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">

                      <div class="form-group has-feedback has-feedback-left">
                        <h3><a href="{{url('/posts/'.$post->id)}}">{{$post->title}}</a></h3>
                      </div><!-- -->
                      <hr>
                      <div class="form-group has-feedback has-feedback-left">
                        <h4>
                          <?php

                              $post->body =
                                preg_replace("/((http|https|www)[^\s]+)/",
                                  '<a target=\"_blank\" href="$1">$0</a>',
                                  $post->body);
                              $post->body =
                                preg_replace("/href=\"www/",
                                  'href="http://www',
                                  $post->body);
                              $post->body =
                                preg_replace("/(@[^\s]+)/",
                                  '<a target=\"_blank\" href="http://twitter.com/intent/user?screen_name=$1">$0</a>',
                                  $post->body);
                              $post->body =
                                preg_replace("/( #[^\s]+)/",
                                  '<a class="hashtag" target=\"_blank\" href="https://twitter.com/hashtag/$1?src=tren">$0</a>',
                                  $post->body);
                            /*
                              $post->body =
                                preg_replace("/( &[^\s]+)/",
                                  '<a class="searchTwitter" target=\"_blank\" href="https://twitter.com/search?q=$1">$0</a>',
                                  $post->body);
                            */

                          ?>
                          {!!strip_tags($post->body,'<ul><li><ol><img><a><p><span><strong><blockquote><b><pre><em><h1><h2><h3><h4><h5><h6><sup><sub><code>')!!}<!--etiquetas a las que escapa strip_tags-->

                        </h4>
                      </div><!-- -->

                    </div><!-- .col-xs\sm\md\lg-8 -->

                    @if(Auth::check()&&$post->user_id==Auth::user()->id)
                      <div align="" class="">
                        <a href="{{url('/posts/'.$post->id.'/edit')}}" style="" class="btn btn-link">
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
                    Publicado por {{$post->user->name}}
                    <span style="float:right;">
                      <a href="{{url('/posts/'.$post->id)}}">{{$post->created_at}}</a>
                    </span>
                  </small>
                </div>
                <div class="list-group-item">
                  Comentarios
                  <span style="float:right;">
                    {{$count_comments = $post->comments->count()}}
                    @if($count_comments>0)
                      <a href="{{url('/posts/'.$post->id)}}">
                        · <small>Ver comentarios</small>
                      </a>
                    @else
                      <a href="{{url('/posts/'.$post->id)}}">
                        · <small>¡Se el primero en comentar!</small>
                      </a>
                    @endif
                  </span>
                </div><!-- .list-group-item -->

              </div><!-- .list-group -->
              @if($key+1 < $posts->count())
                <hr>
              @endif
            @endforeach

            {{--
            DEPRECATED *<25-12-2016
            <div class="list-group">
              <div class="list-group-item">
                <h4>
                  <a href="{{url('/posts')}}">Listado de Posts</a>
                  <a href="{{url('/posts/create')}}" style="float:right;" class="btn btn-success">Crear nuevo post</a>
                </h4>

              </div>
              <div class="list-group-item">
                <table class="table">
                  <thead>
                  <th>Titulo</th>
                  <th>Contenido</th>
                  <th>Usuario</th>
                  </thead>
                  @foreach($posts as $post)
                    <tbody>
                    <td>{!!$post->title!!}</td>
                    <td>{!!$post->body!!}</td>
                    <td>{!!$post->user->name!!}</td>
                    <td>
                      {!!link_to_route('posts.edit', $title = 'Editar', $parameters = $post->id, $attributes = ['class'=>'btn btn-primary'])!!}
                    </td>
                    <td>
                      {!!link_to_route('posts.show', $title = 'Ir a ver este post', $parameters = $post->id, $attributes = ['class'=>'btn btn-primary'])!!}
                    </td>
                    </tbody>
                  @endforeach
                </table><!-- -->
          </div>
        </div>
            --}}
          {{$posts->render()}}
          </div><!-- -->

          {{--
          DEPRECATED 25-12-2016
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
            <div class="list-group">
              <div class="list-group-item">
                Espacio publicitario
              </div><!-- -->
              <div class="list-group-item">
                Sugerencias, relateds, etc.
              </div><!-- -->
            </div><!-- -->
          </div><!-- -->
          --}}

        </div><!-- -->
      </div><!-- -->
    </div>

  </div><!-- -->
@endsection

