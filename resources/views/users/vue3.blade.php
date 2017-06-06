@section('title') Usuarios @endsection
@extends('layouts.app')
@section('content')



  <div id="main" class="page-wrapper">

    <div class="row">
      <div class="col-md-8 col-md-offset-2">

        <h1>Repaso : Vuejs</h1>

        <table class="table table-striped">
          <tr>
            <th>Categoría</th>
            <th>Nota</th>
            <th width="50px">&nbsp;</th>
          </tr>

          <tr v-for="(note, key) in notes">

            <template v-if="! note.editing">
              <td>@{{ note.category_id,categories | category }}</td>
              <td>@{{ note.text }}</td>
              <td>
                <a href="#!" @click="editNote(key)">
                  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>
                <a href="#!" @click="deleteNote(key)">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </a>
              </td>

            </template>

            <template v-else>
              <td>
                <!-- component-implementation -->
                <select-category :categories="categories" :id="note.category_id"></select-category>
              </td>
              <td>
                <input type="text" v-model="note.text" class="form-control">
              </td>
              <td>
                <a href="#!" @click="updateNote(key)">
                  <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                </a>
              </td>
            </template>

          </tr>

        </table>

        <pre>
          @{{ $data }}
        </pre>

      </div>
    </div>
  </div>

  <!-- component-code -->
  <script type="text/x-template" id="select_category_tpl">
    <div>
      <select v-model="id" :value="id" class="form-control">
        <option value="">-selecciona una categoría-</option>
        <option v-for="category in categories" :value="category.id">
          @{{ category.name }}
        </option>
      </select>
    </div>
  </script>


@endsection
{{--Favorite Button Enabled With a Value True--}}
{{--<favorite name="favorite" value></favorite>--}}
{{--Favorite Button Enabled With a disabled state--}}
{{--<favorite name="favorite" value disabled></favorite>--}}