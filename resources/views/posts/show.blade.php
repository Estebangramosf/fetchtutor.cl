@section('title') Showing @stop
@extends('layouts.app')
@section('content')
  <div class=" page-wrapper{{-- jumbotron --}}">
    <div class="container-fluid">
      <div class="">

        <!-- Page Heading -->
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <h1 class="page-header">
              Posts <small>Ver post · {{$post->title}}</small>
            </h1>
            <ol class="breadcrumb">
              <li class="active">
                <i class="fa fa-dashboard"></i> Posts ·
                <a href="{{url('/posts')}}" class="btn-link">Volver al listado</a>
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

            <div class="list-group">
              <div class="list-group-item">
                <h4>
                  Mostrando post · {{$post->title}}
                  @if(Auth::check()&&Auth::user()->role!='user'&&Auth::user()->role!='admin'&&$post->user_id==Auth::user()->id)
                    <a href="{{url('/posts/'.$post->id.'/edit')}}" style="float:right;" class="btn-link">Editar</a>
                  @endif
                </h4>
              </div><!-- /div .list-group-item -->

              <div class="list-group-item">
                  @foreach($post->image as $key => $image)

                    <a href="#!" class="thumbnail" style="padding:0px;">
                      {{Html::image('/posts_images/'.$image->image,
                        $alt="Photo", $attributes = array('style'=>
                        'width:auto;height:auto;max-width:100%;', 'class'=>'img-responsive')) }}
                    </a>

                  @endforeach
                  @if(count($post->image)==0)
                    <a href="#!" class="thumbnail" style="padding:0px;">
                      {{Html::image('/img/backgrounds/iconoCargando.gif',
                        $alt="Photo", $attributes = array('style'=>
                        'width:100%;height:100%;max-width:300px;max-height:300px;')) }}
                      <div class="caption">
                        Este post no tiene imagen.
                      </div>
                    </a>
                  @endif
              </div>
              <div class="list-group-item">
                <div class="form-group has-feedback has-feedback-left">
                  {{-- DEPRECATED *<25-12-2016 --}}
                  {{--{!!Form::label('Nombre:')!!}--}}
                  {{--{!!Form::text('posttitle',$parameters = $post->title,['class'=>'form-control', 'disabled'])!!}--}}
                  <h2>{{$post->title}}</h2>
                </div><!-- -->
                <div class="form-group has-feedback has-feedback-left">
                  {{-- DEPRECATED *<25-12-2016 --}}
                  {{--{!!Form::label('Descripción:')!!}--}}
                  {{--{!!Form::textarea('postbody',$parameters = $post->body,['class'=>'form-control', 'disabled','rows' => '5'])!!}--}}

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
              </div><!-- -->
            </div>
            <div class="list-group">
              <div class="list-group-item">
                <h4>
                  Comentarios ·
                  <span style="">{{$c = count($comments)}}</span>
                </h4>
              </div><!-- /div .list-group-item -->

              @if($c>0)
                <div class="list-group-item">

                  @foreach($comments as $key => $comment)

                    <div id="comment-{{$comment->id}}" class="">
                      <small style="font-size:.8em;display: block;">
                        @if($comment->user->role=='admin')
                          <span style="font-size:1em;" class="label label-primary">Admin</span>
                        @elseif($comment->user->role=='editor')
                          <span style="font-size:1em;" class="label label-info">Editor</span>
                        @elseif($comment->user->role=='user')
                          <span style="font-size:1em;" class="label label-success">Usuario</span>
                        @endif
                        {{$comment->user->name}} comentó

                        @if(Auth::check() &&
                          ((Auth::user()->role=='editor' &&
                          $comment->user->role!='admin') || //si se saca esta linea se puede permitir eliminar el post del admin
                          $comment->user_id==Auth::user()->id ||
                          Auth::user()->role=='admin'))

                          {!! Form::open(
                            ['method' => 'DELETE',
                              'id' => 'formDeleteComment'.$comment->id,
                              'route'=>['posts.comments.destroy',$comment->post_id,$comment->id],
                            ])!!}

                            <a href="#!" class="detele-comment" style="float:right;">
                              <input name="post_id" type="hidden" value="{{base64_encode($comment->post_id)}}">
                              <input name="comment_id" type="hidden" value="{{base64_encode($comment->id)}}">
                              <span id="textDeleteComment{{$comment->id}}">
                                Eliminar Comentario
                              </span>
                            </a>

                          {!! Form::close() !!}
                        @endif
                      </small>
                      <div>
                        <h5>
                          {{--<b>Titulo : </b>--}}
                          <span>{{$comment->title}}</span>
                        </h5>
                      </div>
                      <div>
                        <h6>
                          {{--<b>Comentario : </b>--}}

                          <?php

                            $comment->body =
                              preg_replace("/((http|https|www)[^\s]+)/",
                                '<a target=\"_blank\" href="$1">$0</a>',
                                $comment->body);
                            $comment->body =
                              preg_replace("/href=\"www/",
                                'href="http://www',
                                $comment->body);
                            $comment->body =
                              preg_replace("/(@[^\s]+)/",
                                '<a target=\"_blank\" href="http://twitter.com/intent/user?screen_name=$1">$0</a>',
                                $comment->body);
                            $comment->body =
                              preg_replace("/( #[^\s]+)/",
                                '<a class="hashtag" target=\"_blank\" href="https://twitter.com/hashtag/$1?src=tren">$0</a>',
                                $comment->body);
                            /*
                            $comment->body =
                              preg_replace("/( &[^\s]+)/",
                                '<a class="searchTwitter" target=\"_blank\" href="https://twitter.com/search?q=$1">$0</a>',
                                $comment->body);
                            */

                          ?>
                          {!!strip_tags($comment->body,'<ul><li><ol><img><a><p><span><strong><blockquote><b><pre><em><h1><h2><h3><h4><h5><h6><sup><sub><code>')!!}<!--etiquetas a las que escapa strip_tags-->


                        </h6>
                      </div>

                      @if($key+1 < $comments->count())
                        <hr>
                      @endif
                    </div>
                  @endforeach
                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                </div><!-- /div .list-group-item -->
              @endif

            </div>

            <div class="list-group">

              @if(Auth::check())
                <div class="list-group-item">
                  <h4>
                    Deja un comentario
                  </h4>
                </div><!-- /div .list-group-item -->
                <div class="list-group-item">
                  {!!Form::open(['route'=>['posts.comments.store',$post->id], 'method'=>'POST', 'id'=>'formComments'])!!}
                  {!!Form::label('Título')!!}
                  <div class="form-group has-feedback has-feedback-left">
                    {!!Form::text('title',null,['class'=>'form-control form-comment-input', 'required'])!!}
                  </div>
                  {!!Form::label('Contenido del comentario')!!}
                  <div class="form-group has-feedback has-feedback-left">
                    {!!Form::textarea('body',null,['class'=>'form-control form-comment-input','rows' => '1', 'required'])!!}
                  </div>
                  {!!Form::submit('Enviar', ['class'=>'btn btn-success send-post', 'style'=>''])!!}
                  {!!Form::close()!!}
                </div><!-- -->
              @else
                Para dejar un comentario debes iniciar sesión.
              @endif

            </div><!-- -->



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
@stop
