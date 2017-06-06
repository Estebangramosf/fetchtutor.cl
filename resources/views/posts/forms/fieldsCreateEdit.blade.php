  <div class="list-group" >
  <div class="list-group-item">
    <h4>
      @if(Request::path()=='posts/create')
        <a href="{{url('/posts/create')}}">Nuevo post</a>
      @else
        <a href="{{url('/posts/'.(isset($post->id)?$post->id:1).'/edit')}}">Modificar post</a>
      @endif

      <a href="{{url('/posts')}}" style="float:right;" class="btn btn-success">Volver al listado</a>
    </h4>
  </div><!-- /div .list-group-item -->
  <div class="list-group-item">

    <div class="form-group has-feedback has-feedback-left">
      {!!Form::label('Titulo:')!!}
      {!!Form::text('title',null,['class'=>'form-control','placeholder'=>'Ingrese el titulo del post','maxlength'=>'60'])!!}
    </div><!-- /div .list-group-item -->
    <div class="form-group has-feedback has-feedback-left">
      {!!Form::label('Contenido:')!!}
      {!!Form::textarea('body',null,['class'=>'form-control','placeholder'=>'Ingrese contenido del post','rows' => '5','maxlength'=>'5000'])!!}
    </div><!-- /div .form-group .has-feedback .has-feedback-left -->
    <div class="form-group has-feedback has-feedback-left">
      <label class="btn btn-default btn-file">
        <img class="out-dashboard-item"
             src="{!! asset('img/glyphicons/glyphicons/png/glyphicons-12-camera.png') !!}" alt="">
        Buscar imagen ...
        <input type="file" style="display: none;" name="image" id="image" maxlength="1000" size="2048" />
        <span id="imagePathValue"></span>
      </label>
    </div>
    <div class="form-group has-feedback has-feedback-left">
      {!!Form::submit('Enviar', ['class'=>'btn btn-success'])!!}
      {!!Form::close()!!}

      @if(strpos(Request::path(),'edit', 8))
        {!!Form::open(['action'=> ['PostController@destroy', $post->id], 'method'=>'DELETE'])!!}
        {!!Form::submit('Eliminar', ['class'=>'btn btn-primary btn-danger', 'id'=>'eliminar'])!!}﻿
        {!!Form::close()!!}
      @endif
    </div><!-- /div .form-group .has-feedback .has-feedback-left -->

  </div><!-- /div .list-group-item -->
</div><!-- /div .list-group -->
