<script>
   export default {
      props:['user'],
      name:'users-edit',
      data () {
         return {
            editable:true,
         }
      },
      ready () {
      },
      created (){

      },
      watch:{},
      methods: {
         findById: function (items, id){
            for (var i in items) {
               if (items[i].id==id) {
                  return items[i];
               }
            }
            return null;
         },         
         editUser: function (){
            return this.editable = true;
         },
         saveUser: function () {
            Vue.http.headers.common['X-CSRF-TOKEN'] = $('#_token').val();
            //Se realiza reemplazo manual en edicion rapida ya que no es amigable hacer el v-model con los campos
            //Vue.http.options.emulateJSON = true;
            //Vue.http.options.emulateHTTP = true;
            //this.$http.post('/users).then(response => {
            this.$http.put('/users/'+this.user.id, {user:this.user}).then(response => {
               // get body json data
               this.editable = false;
               console.log('success');
            console.log(response);
         }, response => {
               // error callback
               console.log('failed');
               console.log(response);
            });
         },
         deleteUser: function () {
            Vue.http.headers.common['X-CSRF-TOKEN'] = $('#_token').val();
            //Vue.http.options.emulateJSON = true;
            //Vue.http.options.emulateHTTP = true;
            //this.$http.post('/users).then(response => {
            this.$http.delete('/users/'+this.user.id, {user:this.user}).then(response => {
               // get body json data
            window.location.href = '/users';
            console.log('success');
            console.log(response);
         }, response => {
               // error callback
               console.log('failed');
               console.log(response);
            });
         },
      },
   }
</script>

<template>
   <transition name="fade">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"  style="padding:10px;">
         <div class="list-group-item list-group-item-info">
            Editar usuario
         </div>
         <div class="list-group-item list-group-item-info">

            <form @submit.prevent="saveUser()">

               <div class="media">
                  <div class="media-left">
                     <a href="#">
                        <img
                           class="media-object"
                           src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWMxMmFmZDY5MyB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1YzEyYWZkNjkzIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMy4wNDY4NzUiIHk9IjM2LjUiPjY0eDY0PC90ZXh0PjwvZz48L2c+PC9zdmc+"
                           alt="...">
                     </a>
                  </div><!-- .media-left -->

                  <div class="media-body">
                  
                     <!-- Name input -->
                     <label>Nombre:</label>
                     {{user.name}}
                     <transition name="bounce">
                        <input v-show="editable" required="required" type="text" id="name" v-model="user.name" class="form-control input-sm">
                     </transition>
                     <br>

                     <!-- Email input -->
                     <label>Correo:</label>
                     {{user.email}}
                     <transition name="bounce">
                        <input v-show="editable" required="required" type="email" id="email" v-model="user.email" class="form-control input-sm">
                     </transition>
                     <br>

                     <!-- Role input -->
                     <div>
                        <label for="role">Rol:</label>
                        <span v-if="user.role=='admin'" class="label label-primary">Admin</span>
                        <span v-else-if="user.role=='editor'" class="label label-info">Editor</span>
                        <span v-if="user.role=='user'" class="label label-success">User</span>
                     </div>
                     <transition name="bounce">
                        <select v-show="editable" required="required" name="role" id="role" v-model="user.role" class="form-control input-sm">
                           <option value="admin">Administrador</option>
                           <option value="editor">Editor</option>
                           <option value="user">User</option>
                        </select>
                     </transition>
                     <br />

                  </div><!-- .media-body -->               
               </div><!-- .media -->
            
            <hr>
            
               <div class="media">

                  <div class="media-left">
                     <a href="#">
                        <img
                           class="media-object"
                           src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWMxMmFmZDY5MyB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1YzEyYWZkNjkzIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMy4wNDY4NzUiIHk9IjM2LjUiPjY0eDY0PC90ZXh0PjwvZz48L2c+PC9zdmc+"
                           alt="...">
                     </a>
                  </div><!-- .media-left -->

                  <div class="media-body">

                     <transition name="bounce">
                        <button v-show="editable" type="submit" class="btn btn-success btn-sm">
                           Guardar
                        </button>
                     </transition>                     

                     <transition name="bounce">
                        <button v-show="!editable" class="btn btn-primary btn-sm" @click.prevent="editUser()">
                           Modificar
                        </button>
                     </transition>

                     <transition name="bounce">
                        <button v-show="editable" style="float: right;" class="btn btn-danger btn-sm" @click.prevent="deleteUser()">Eliminar usuario</button>
                     </transition>

                  </div><!-- .media-body -->
               </div><!-- .media -->

            </form><!-- form -->

         </div><!-- .list-group-item -->
      </div><!-- .col-* -->
   </transition>
</template>

<style scoped="">
   .fade-enter-active, .fade-leave-active {
      transition: opacity .5s
   }
   .fade-enter, .fade-leave-to {
      opacity: 0
   }
   .bounce-enter-active {
      animation: bounce-in .3s;
   }
   .bounce-leave-active {
      animation: bounce-in .2s reverse;
   }
   @keyframes bounce-in {
      0% {
         transform: scale(0);
      }
      50% {
         transform: scale(1);
      }
      100% {
         transform: scale(1);
      }
   }

</style>