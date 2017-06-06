{{--
(Mensaje sin componente)
<h4 v-if="name">Bienvenid@{{ gender == 'm' ? 'o':'a' }}: @{{ name }}</h4>
<p v-else>Por favor escribe tu nombre</p>
--}}
{{--<h4 v-if="name">Bienvenid@{{ gender == 'm' ? 'o':'a' }}: @{{ name }}</h4>--}}
{{--<h4>Bienvenid@{{ $parent.gender == 'm' ? 'o':'a' }}: @{{ $parent.name }}</h4>--}}


<form @submit.prevent="signUp(false, $event)"> <!-- v-on:submit -->
  <select name="" v-model="gender" id="gender">
    <option v-for="gender in genders" :value="gender.index">
      @{{ gender.detail }}
    </option>
  </select>
  <br>
  <label>
    Hombre: <input v-model="gender" type="radio" value="m">
  </label>
  <br>
  <label>
    Mujer: <input v-model="gender" type="radio" value="f">
  </label>
  <br>
  {{--
  <label for="">Nombre</label>
  <input type="text" v-model="name">
  <br>
  --}}
  <label for="">Nombre</label>
  <input type="text" class="form-control" v-model="first_name">
  <br>
  <label for="">Apellido</label>
  <input type="text" class="form-control" v-model="last_name">
  <br>

  <input type="text" v-model="message">Mensaje en sentido normal
  <br>

  <input type="text" v-model="message.split('').reverse().join('')">Mensaje en sentido inverso
  <br>

  <p v-show="message&&gender">
    <button type="submit" class="btn btn-primary"> <!--@click.prevent="signUp"-->
      <!-- click.prevent o click.stop previene la ejecucion del formulario -->
      <!-- se puede usar v-on:click o también @click -->
      Registrar
    </button>

    <button @click.prevent="signUp(true, $event)" type="button" class="btn btn-primary">
      Registrar y salir del sistema
    </button>
  </p>


  {{--
  <!-- componente hello-world create apuntoando a un id de un div en la creacion -->
  <div id="hw">
    <hello-world></hello-world>
  </div>
  <br>
  <!-- componente other-message creado directamente (2da forma) -->
  <other-message></other-message>
  <br>
  <hr>
  --}}

</form>
<welcome-message v-bind:name="name" v-bind:gender="gender"></welcome-message>
<h4>@{{ welcome_message }}: @{{ name }}</h4>
<h4>@{{ welcome_message }}: @{{ name.split('').reverse().join('') }}</h4>


{{--
            <div id="welcome_message_component">
            </div>
--}}


<label for="">
  ¿Hablas español?
  <input v-model="spanish" type="checkbox">
</label>

<script type="text/template" id="welcome_template">
  <div>
    <h4>@{{ welcome_message }}: @{{ name | ucwords }}</h4>
    (Mensaje creado con componente)
  </div>
</script>

{{--
          <years-exp :years.sync="years_php" tech="PHP"></years-exp>
          <years-exp :years.sync="years_js" tech="JS"></years-exp>
          <years-exp :years.sync="years_css" tech="CSS"></years-exp>
--}}


<template v-for="tech in techs">
  <years-exp :years.sync="tech.years" :tech="tech.name" :level="tech.level"></years-exp>
</template>

<label for="">
  ¿Desea agregar una nueva tecnología?
</label>
<form @submit.prevent="addTech">
  <input type="text" v-model="newTech">
  <button type="submit" class="btn btn-success btn-sm">Agregar tecnología</button>
</form>
Techs
<ul v-for="tech in orderedTechs">
  <li>
    <h3>@{{ tech.name }}</h3>
  </li>
</ul>

<script type="text/template" id="years_template">
  <div>
    <p>
      ¿Cuántos años de experiencia tienes con @{{ tech }}?
    </p>
    <p>
      Respuesta: <b>@{{ years }}</b>
      <button type="button"
              :class="{btn: true, 'btn-danger': years > 10}"
              @click.prevent="add">
        +
      </button>
      <!--:style="getAddYearButtonStyles()"-->
      <button type="button"
              :disabled="years == 0"
              class="btn"
              @click.prevent="sub">
        -
      </button>
      Nivel: @{{ level }}
        <!--
                 v-bind:disabled="condicion" es equivalente a solo colocar :disabled="condicion"
                -->
    </p>
  </div>

  {{--
  <img :title="years_php" :style="{'width': years_php+'1%'}" width="10%;" src="https://vuejs.org/images/logo.png" alt="">
  --}}
</script>


@{{ $data }}

<h4 v-if="message">Mensaje:@{{ message }}</h4> <!-- en caso que no exista, lo elimina del html -->
<p v-else>Por favor escribe un mensaje</p>

<p v-if="!message" class="alert alert-danger">
  El mensaje es obligatorio
</p>
<p v-if="message.length < 20" class="alert alert-danger">
  El mensaje debe contener mínimo 20 caracteres
</p>
<p v-if="message.length > 50" class="alert alert-danger">
  El mensaje debe contener máximo 50 caracteres
</p>
{{--
<p v-if="mensaje == ''" class="alert alert-danger">
  El mensaje es obligatorio
</p>
--}}
{{--
 <h4 v-show="message">@{{ message }}</h4> <!-- en caso que no exista, solo lo oculta con display:none -->
--}}

<pre>
            {{--@{{ gender | json }}--}}
  {{--@{{ genders | json }}--}}
  {{--@{{ genders }}--}}
          </pre>


</div>

<div id="app-2">
  <ul>
    <li v-for="todo in todos">
      @{{ todo.text }}
    </li>
  </ul>
</div>

<div id="app-3">
  <button v-on:click="clickMe">Click me</button>
</div>

<div id="app-4">
  <br>

          <pre class="well">
            {{--@{{ datas | json }}--}}
            @{{ datas }}
          </pre>

  <input type="text" v-model="newData">
  <button v-on:click="addNewData">Add New</button>
  <ul>
    <li v-for="data in datas">
      @{{ data.text }}
      <button v-on:click="removeData()">x</button>
    </li>
  </ul>
</div>

