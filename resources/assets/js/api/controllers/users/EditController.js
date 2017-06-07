// Imports requeribles
import { _ , range } from 'lodash';
import { Vue2Filters } from 'vue2-filters';
// Components requeribles
let UsersEdit = require('../../../components/users/Edit.vue');
let UsersCreate = require('../../../components/users/Create.vue');
//let Toast = require('../../../components/toasts/Toasts.vue');


// Start app
let Edit = new Vue({
   el: '#Edit',
   data(){
      return {
         users:{},
         churches:{},
         user:'',
         user_church:'',
         user_church_member:'',
      }
   },
   computed: { },
   watch:{ },
   components:{
      //declare component from with a require
      'users-edit':UsersEdit,
      'users-create':UsersCreate,
      //'toast': Toast
   },
   created(){
      //on created
      let user_id = $('#user').val();
      this.fetchUser(user_id);
   },
   ready:function(){ },
   filters: { },
   methods: {
      fetchUser: function (user_id) {
         this.$http.get('/users/all/'+user_id+'/edit').then(response => {
            // get body json data
            this.user = response.body.user;
            this.user_church = response.body.user_church;
            this.churches = response.body.churches;
            this.user_church_member = this.user_church.name;
            //console.log(response);
         }, response => {
            console.log(response);
            // error callback
         });
      },
   },
});