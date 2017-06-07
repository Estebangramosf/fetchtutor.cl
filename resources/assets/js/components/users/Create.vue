<script>
   export default {
      props:['churches'],
      name:'users-create',
      data () {
         return {
            church:'',
            newuser:{
               name:'',
               email:'',
               role:'',
               church_id:'',
               password:'',
            },
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
         newUser: function (){
            this.clearForm();
            return this.editable = !this.editable;
         },
         clearForm: function () {
            this.newuser.name='';
            this.newuser.email='';
            this.newuser.password='';
         },
         createUser: function () {
            Vue.http.headers.common['X-CSRF-TOKEN'] = $('#_token').val();
            this.$http.post('/users', {user:this.newuser}).then(response => {
               // get body json data
               //window.location.href = '/users';
               this.church = this.findById(this.churches,this.newuser.church_id);
               this.newuser = response.body.rid;
               this.editable = false;
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
         <div class="list-group-item list-group-item-success">
            Crear nuevo usuario
         </div>
         <div class="list-group-item list-group-item-success">

         <form @submit.prevent="createUser()" accept-charset="utf-8">

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
                  {{newuser.name}}
                  <transition name="bounce">
                     <input v-show="editable" type="text" id="name" required="required" v-model="newuser.name" 
                        class="form-control input-sm">
                  </transition>
                  <br>

                  <!-- Email input -->
                  <label>Correo:</label>
                  {{newuser.email}}
                  <transition name="bounce">
                     <input v-show="editable" type="email" id="email" required="required" v-model="newuser.email" 
                        class="form-control input-sm">
                  </transition>
                  <br>

                  <!-- Password input -->
                  <label>Password:</label>
                  {{newuser.password}}
                  <transition name="bounce">
                     <input v-show="editable" type="password" id="password" required="required" v-model="newuser.password" 
                        class="form-control input-sm">
                  </transition>
                  <br>

                  <!-- Role input -->
                  <div>
                     <label for="role">Rol:</label>
                     <span v-if="newuser.role=='admin'" class="label label-primary">Admin</span>
                     <span v-else-if="newuser.role=='editor'" class="label label-info">Editor</span>
                     <span v-if="newuser.role=='user'" class="label label-success">User</span>
                  </div>
                  <div>
                     <select name="role" id="role" v-show="editable" required="required" v-model="newuser.role" class="form-control input-sm">
                        <option value="admin">Administrador</option>
                        <option value="editor">Editor</option>
                        <option selected="selected" value="user">User</option>
                     </select>
                  </div>

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

                  <!-- Church input -->
                  <div v-show="church.name && !editable">
                     <label>Miembro de la iglesia:</label> {{church.name}}
                  </div>
                  <transition name="bounce">
                     <div v-show="editable">
                        <label>Seleccione iglesia:</label> 
                        <div>
                           <select name="church_name" id="church_name" required="required" v-model="newuser.church_id" 
                              class="form-control input-sm">
                              <option value="">Seleccione ..</option>
                              <option v-for="church in churches" :value="church.id">{{church.name}}</option>
                           </select>
                        </div>
                        <br>
                     </div>
                  </transition>
                  <br /><br />

                  <button v-show="editable" type="submit" class="btn btn-success btn-sm">
                     Crear usuario
                  </button>

                  <transition name="bounce">
                     <button class="btn btn-info btn-sm" v-show="!editable" @click.prevent="newUser()">
                        Crear nuevo usuario
                     </button>
                  </transition>

                  <!-- Complete edit button -->
                  <a class="btn btn-primary btn-sm" v-show="!editable" style="float:right;" :href="'/users/'+newuser.id+'/edit'">
                     Editar usuario creado
                  </a>                

               </div><!-- .media-body -->
            </div><!-- .media -->

         </form><!-- .form -->

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
         transform: scale(1.1);
      }
      100% {
         transform: scale(1);
      }
   }
</style>