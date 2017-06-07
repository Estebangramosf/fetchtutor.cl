<!-- Exportable component -->
<script>
/*
	import VueRouter from 'vue-router';
	Vue.use(VueRouter);

const Foo = { template: '<div>foo</div>' };
const Bar = { template: '<div>bar</div>' };
const routes = [
  { path: '/foo', component: Foo },
  { path: '/bar', component: Bar }
];
const router = new VueRouter({
  routes // short for routes: routes
});
const app = new Vue({
  router
}).$mount('#UserController');	
		
	var router = new VueRouter({
		history: false
	});

	router.map({
	  '/users/:user.id': {
	    component: {
	      template: 'User ID is {{$route.params.user.id}}'     
	    }
	  }
	});
	var App = Vue.extend();
	router.start(App, '#UserController');	

	const UserController = new Vue({
	  router
	}).$mount('#UserController');

*/	
	let helper = require('../helpers/DailyHelper.vue');
	export default {
		props:['user'],
		name:'users-list',
		data () {			
			return {
				editable:false,
			}
		},
		ready () {			
		},
		created(){ },		
		filters:{},
		methods: {		
	      editUser: function () {
	      	//console.log(this.editable);
	      	return this.editable = !this.editable;
	      },
	      saveUser: function () {
	      	this.editUser(); // To change edit status
	      	Vue.http.headers.common['X-CSRF-TOKEN'] = $('#_token').val();
	      	//Se realiza reemplazo manual en edicion rapida ya que no es amigable hacer el v-model con los campos

	      	//Vue.http.options.emulateJSON = true;
	      	//Vue.http.options.emulateHTTP = true;
	      	//this.$http.post('/users).then(response => {
		      this.$http.put('/users/'+this.user.id, {user:this.user}).then(response => {
					// get body json data
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

		

<!-- Component template -->
<template>
	<transition name="fade">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<div class="list-group">
				<div class="list-group-item">

					<form @submit.prevent="saveUser()">

						<div class="media">

							<div class="media-left">
								<a href="#">
									<img
										class="media-object"
										src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWMxMmFmZDY5MyB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1YzEyYWZkNjkzIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMy4wNDY4NzUiIHk9IjM2LjUiPjY0eDY0PC90ZXh0PjwvZz48L2c+PC9zdmc+"
										alt="...">
								</a>
							</div>

							<div class="media-body">

								<!-- Field name -->
								<label>Nombre:</label>
								{{user.name}}
								<transition name="bounce">
									<input v-show="editable" v-model="user.name" required="required" type="text" id="name" :value="user.name" class="form-control input-sm">
								</transition>
								<br>

								<!-- Field email -->
								<label>Correo:</label>
								{{user.email}}
								<transition name="bounce">
									<input v-show="editable" v-model="user.email" required="required" type="email" id="email" :value="user.email" class="form-control input-sm">
								</transition>
								<br>

								<!-- Field role -->
								<div>
									<label for="role">Rol:</label>
									<span v-if="user.role=='admin'" class="label label-primary">Admin</span>
									<span v-else-if="user.role=='editor'" class="label label-info">Editor</span>
									<span v-if="user.role=='user'" class="label label-success">User</span>
								</div>
								<transition name="bounce">
									<select v-show="editable" required="required" v-model="user.role" name="role" id="role" :value="user.role" class="form-control input-sm">
										<option value="admin">Administrador</option>
										<option value="editor">Editor</option>
										<option value="user">User</option>
									</select>
								</transition>

							</div><!-- .media-body -->
						</div><!-- media -->

						<!-- Save button -->
						<transition name="bounce">
							<button v-show="editable" type="submit" class="btn btn-success btn-sm">
								Guardar
							</button>
						</transition>

						<!-- Complete edit button -->
						<a class="btn btn-primary btn-sm" style="float:right;" :href="'/users/'+user.id+'/edit'">
							Edición completa
						</a>

					</form><!-- form editUser() -->

					<!-- Fast edition button -->
					<transition name="bounce">
						<button v-show="!editable" @click.prevent="editUser()" class="btn btn-primary btn-sm">
							Edición Rápida
						</button>
					</transition>

				</div><!-- .list-group-item -->
			</div><!-- .list-group -->
		</div><!-- .col-* -->
	</transition>
</template><!-- User list template -->

<!--  Style template-->
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

	.flip-list-move {
		transition: transform 1s;
	}

	.wrap {
	  height: 80vh;
	  display: flex;
	  overflow-y: scroll;
	}
	.wrap-long-vertical {
	  height: 100vh;
	  display: flex;
	  overflow-y: scroll;
	}
</style>