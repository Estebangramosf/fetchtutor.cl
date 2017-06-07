<script>
	export default {
		methods: {
			test1:function(){
				alert('test1');
			},
			test2:function(){
				alert('test2');
			},
	      //<tag @change="onChange"></tag>
		   onChange: function (ev) {
		      this.$emit('checked', this.curso.value, ev.target.checked);
		      //para emitir un evento se llama al metodo $emit, que recibe varios parametros, el primer parámetro es el nombre del evento que queremos emitir, el segundo le envia cual es el valor de lo que se checkeo (envia valor y nombre como objeto o se puede pasar directamente el valor), y el tercer parametro es mediante el evento (ev) que le pasa el estado del checkeo, true o false, luego el padre del elemento debe quedar a la escucha, en este caso se hizo el metodo "selectCurso()"
		   },
			_isInArray: function (value, array) {
				return array.indexOf(value) > -1;
			},		   
		},
		filters: {
		   uppercase: function (str) {
		      return str.toUpperCase();
		   },
		   lowercase: function (str) {
		      return str.toLowerCase();
		   },
		   capitalize: function (str) {
		      return str.charAt(0).toUpperCase() + str.slice(1);
		   },
			ucwords: function (value){
				return value.split(' ').map(function (word) {
					return word.charAt(0).toUpperCase() + word.slice(1);
				}).join(' ');
			},	
			reverse: function (str) {
				return str.split('').reverse().join('');
			},
			findById: function (items, id){
				for (var i in items) {
					if (items[i].id==id) {
						return items[i];
					}
				}
				return null;
			},
			validateEmail: function (email){
				  return /^(([^<>()[]\.,;:\s@\"]+(.[^<>()[]\.,;:\s@\"]+)*)|(\".+\"))@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}])|(([a-zA-Z-0-9]+.)+[a-zA-Z]{2,}))$/.test(email);
			},

		},
	}	
</script>