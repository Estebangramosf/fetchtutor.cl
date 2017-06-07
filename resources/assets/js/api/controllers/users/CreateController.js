// Imports requeribles
import { _ , range } from 'lodash';
import { Vue2Filters } from 'vue2-filters';

// Components requeribles
let UsersCreate = require('../../../components/users/Create.vue');

// Start app
let Create = new Vue({
   el: '#Create',
   data(){
      return {
         churches:{},
         users:"{}",
         user:'',               
         newuser:{
            name:'',
            email:'',
            role:'',
            church_id:'',
            password:'',
         },
      }
   },
   computed: { },
   components:{
      //declare component from with a require
      'users-create':UsersCreate,
   },
   created(){
      //on created
   },
   ready:function(){ },
   filters: { },
   methods: {

   },
});
