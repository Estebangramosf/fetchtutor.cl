@section('title') Usuarios @endsection
@extends('layouts.app')
@section('content')

  <div class="page-wrapper">
    <div class="container-fluid">

      <div id="app">
        {{--
        <input type="text" name="nombre" placeholder="Ingresa tu nombre" v-model="nombre">
        <p>
          Tu nombre en mayusculas es @{{ nombre | uppercase }}
        </p>
        --}}

        <form v-on:submit.prevent="submit">
          <h2>¿Cuales son tus cursos favoritos?</h2>

          <template v-for="curso in cursos">
            <curso @checked="selectCurso" :curso="curso"></curso>
            {{-- v-on:checked === @checked --}}
            {{--
            <input v-model="cursosSeleccionados"
                   type="checkbox"
                   :id="curso.value"
                   :value="curso.value">
            <label :for="curso.value">@{{ curso.nombre }}</label><br>
            --}}
          </template>

          <pre>
            @{{ cursosSeleccionados }}
          </pre>
          {{--
          <input v-model="cursos" type="checkbox" id="vue" value="vue">
          <label for="vue">Curso de Vue JS</label>
          <br>
          <input v-model="cursos" type="checkbox" id="seo" value="seo">
          <label for="seo">Curso de SEO</label>
          <br>
          <input v-model="cursos" type="checkbox" id="react" value="react">
          <label for="react">Curso de React y Redux</label>
          <br>
          <input v-model="cursos" type="checkbox" id="growth" value="growth">
          <label for="growth">Curso de Growth Marketing</label>
          <br>
          --}}
          <button type="submit">Enviar</button>
        </form>

        <!-- Segunda y terceras lecciones -->
        {{--
        <h1>@{{ titulo | uppercase }}</h1>
        <h2>@{{ subtitulo | lowercase }}</h2>
        <h3>@{{ capitalize | capitalize }}</h3>
        --}}
        {{-- v-on:click === @click --}}
        {{--
        <button @click="sumar">Sumar 1</button>
        <button @click="restar">Restar 1</button>
        El contador está en @{{ contador }}
        --}}



        <!-- Primeras lecciones -->
        {{--
        Editar uno a uno con v-if para validar que se muestre el contenido
        <hr>
        <h3 v-if="mostrar">Este es mi titulo</h3>
        <h4 v-if="mostrar">Este es mi subtitulo</h4>
        <a v-if="mostrar" v-bind:href="url" target="_blank">Ir a @{{ pagina }}</a>
        <br><br>

        Englobar dentro de un div la condicion para que se agrupe e ir ahorrando codigo, pero no es tan óptimo
        <hr>
        <div v-if="mostrar">
          <h3>Este es mi titulo</h3>
          <h4>Este es mi subtitulo</h4>
          <a v-bind:href="url" target="_blank">Ir a @{{ pagina }}</a>
        </div>
        <br><br>

        Permite crear la validacion pero no dibuja un div con el contenido, sino que lo utiliza para validar sin mostrar un elemento padre
        Template es un englobador de objetos que vue interpreta pero no se ve en el dom del html
        <hr>
        <template v-if="mostrar">
          <h3>Este es mi titulo</h3>
          <h4>Este es mi subtitulo</h4>
          <a v-bind:href="url" target="_blank">Ir a @{{ pagina }}</a>
        </template>
        <br><br>

        v-show Permite mostrar y ocultar, a diferencia de v-if que lo elimina, v-show lo oculta
        <hr>
        <div v-show="mostrar">
          <h3>Este es mi titulo</h3>
          <h4>Este es mi subtitulo</h4>
          <a v-bind:href="url" target="_blank">Ir a @{{ pagina }}</a>
        </div>
        <div v-show="!mostrar">
          Esto está oculto
        </div>
        <br><br>

        <hr>
        <br>
        Hola @{{ nombre }}
        --}}
      </div><!-- #app -->

    </div><!-- .container-fluid -->
  </div><!-- .page-wrapper -->

@endsection