@section('title') Usuarios @endsection
@extends('layouts.app')
@section('content')

  <style>
    .favoriting{
      display: inline-block
    }
    .favorite__heart {
      display: inline-block;
      padding: 3px;
      vertical-align: middle;
      line-height: 1;
      font-size: 24px;
      color: #ABABAB;
      cursor: pointer;
      -webkit-transition: color .2s ease-out;
      transition: color .2s ease-out;
    }
    .favorite__heart.is-disabled:hover {
      cursor: default;
    }
    .favorite__checkbox {
      position: absolute;
      overflow: hidden;
      clip: rect(0 0 0 0);
      height: 10px;
      width: 10px;
      margin: 5px;
      padding: 0;
      border: 0;
    }
    .favorite__heart__selected{
      /*color: #df470b;*/
      color: #edd42c;
    }
  </style>

  <div id="body" class="page-wrapper">
    <!-- Componente de las notas -->
    <ul>
      <notes v-for="(note,index) in notes" :note="note" :index="index"></notes>
    </ul>

    <!-- Template del componente notas -->
    <script type="text/x-template" id="template-notes">
      <li>
        @{{ index+1 }} :
        <div v-show="!inEdit" @dblclick.prevent="editNote">
          @{{ note.text }}
        </div>

        <div v-show="inEdit" class="input-group">
          <input type="text" class="form-control" v-model="note.text" />
          <span class="input-group-btn">
            <button class="btn btn-default" type="button" v-on:click.prevent="saveNote">Guardar</button>
          </span>
        </div><!-- /input-group -->

        <!-- componente dentro de una plantilla de otro componente para boton favoritos -->
        <favorite name="favorite"></favorite>

        <span>
          Autor: @{{ note.author }}
        </span>
        {{--Favorite Button Enabled--}}
      </li>
    </script>

    <!-- Template del componente favorite button -->
    <script type="text/x-template" id="template-favorite">
      <div class="favoriting">
        <label
          data-toggle="tooltip" data-placement="top" v-bind:title="title" v-bind:data-original-title="title"
          class="favorite__heart"
          v-bind:class="{'favorite__heart__selected': value, 'is-disabled': disabled}"
          v-on:click="favorite">
          <input
            class="favorite__checkbox"
            type="checkbox"
            v-bind:name="name"
            v-bind:value="value"
            v-bind:required="required"
            v-bind:disabled="disabled"
            v-model="value">
          🌠{{--🌟⭐☆✩★☆--}}
        </label>
      </div>
    </script>

    <br><br>
    <form @submit.prevent="createNote" class="form">
      <!-- textarea con tinymce no funciona bien con vue, por eso se creo un input text -->
      <input type="text" class="form-control" v-model="new_note.text" placeholder="Agrega un texto para nota">
      <input type="text" class="form-control" v-model="new_note.author" placeholder="Agrega un autor">
      <textarea v-model="new_note.text" placeholder="Agrega una nota"></textarea>
      <button class="btn btn-default" type="submit">Agregar nota</button>
    </form>
  </div>
  <script>
    Vue.component('favorite', {
      template: '#template-favorite',
      data: function() {
        return { };
      },
      props: {
        'name': {
          type: String,
          default: 'favorite'
        },
        'value': {
          type: Boolean,
          default: false
        },
        'disabled': {
          type: Boolean,
          default: false
        },
        'title': {
          type: String,
          default: 'Valorar'
        }
      },
      methods: {
        favorite: function() {
          if (this.disabled==true) {
            return;
          }
          !this.value ? this.title = 'Valorado' : this.title = 'Valorar';
          this.value = !this.value;
          //$('.favoriting').tooltip();
          $('[data-toggle="tooltip"]').tooltip()
        },
      }
    });
    Vue.component('notes', {
      template: '#template-notes',
      data: function () {
        return {
          inEdit: false,
        }
      },
      props:{
        'note':{
          type: Object
        },
        'index':{
          type: Number
        }
      },
      methods: {
        editNote: function (){
          return this.inEdit = true;
        },
        //Acá se puede hacer un ajax para guardar en la base de datos
        saveNote: function (){
          return this.inEdit = false;
        },
      },
    });
    let a = new Vue({
      el:'#body',
      data: {
        note:'',
        index:Number,
        notes:[
          {
            text:'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. ',
            author:'Author1',
            editable:false,
          },
          {
            text:'Lorem Ipsum ha sido el texto de relleno estándar',
            author:'Author2',
            editable:false,
          },
          {
            text:'de las industrias desde el año 1500, cuando un',
            author:'Author3',
            editable:false,
          },
          {
            text:'impresor (N. del T. persona que se dedica a la imprenta) desconocido usó',
            author:'Author4',
            editable:false,
          },
          {
            text:'una galería de textos y los mezcló de tal manera que logró hacer un l',
            author:'Author5',
            editable:false,
          },
        ],
        new_note: {
          text:'',
          author:''
        },
        inEdit:false,
      },
      methods: {
        createNote: function () {
          //this.notes.push(this.new_note);
          //Acá se puede hacer un ajax para insertar la nota en la base de datos
          this.notes.push({text:this.new_note.text,author:this.new_note.author});
          this.new_note.text='';
          this.new_note.author='';
          //{text:this.new_note.text,author:this.new_note.author}
          //console.log(this.new_note.text);
        },
      },
    });
  </script>


@endsection
{{--Favorite Button Enabled With a Value True--}}
{{--<favorite name="favorite" value></favorite>--}}
{{--Favorite Button Enabled With a disabled state--}}
{{--<favorite name="favorite" value disabled></favorite>--}}