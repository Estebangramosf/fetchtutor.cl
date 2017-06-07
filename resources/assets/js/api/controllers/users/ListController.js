//import Vue from '../../../../node_modules/vue';
//import VueResource from '../../../../node_modules/vue-resource';

//window.Vue = require('vue');
//window.VueResource = require('vue-resource');

//import App from './app';

//Vue.use(VueResource);

//import Users from '../../../components/users/Users.js'
/*
var Vue = require('./node_modules/vue/dist/vue.js');
var VueResource = require('./node_modules/vue/dist/vue-resource.js');
Vue.use(VueResource);
*/
//var Vue = require('../../../../node_modules/vue/dist/vue.js');
//var VueResource = require('../../../../node_modules/vue/dist/vue-resource.js');
//Vue.use(VueResource);
/*
var Vue = require('./node_modules/dist/vue.js');
var VueResource = require('./node_modules/dist/vue-resource.js');
Vue.use(VueResource);*/
//window.Vue = require('vue');
//require('vue-resource');
/*
Vue.http.options.root = '/root';
Vue.http.headers.common['Authorization'] = 'Basic YXBpOnBhc3N3b3Jk';
Vue.http.options.emulateJSON = true;
Vue.http.options.emulateHTTP = true;
Vue.http.headers.common['X-CSRF-TOKEN'] = $('#_token').attr('value');//Laravel.csrfToken;
*/
//var Vue = require('vue');
//Vue.use(VueResource);
//Vue.use(require('vue-resource'));
//import paginator from '../../../components/paginators/paginator.vue';
//import * as Vue from 'vue';
//import VueResource from 'vue-resource';

// Imports requeribles
import VueResource from 'vue-resource';
import { _ , range } from 'lodash';
import { Vue2Filters } from 'vue2-filters';
// Components requeribles
let UsersList = require('../../../components/users/List.vue');
let Paginators = require('../../../components/paginators/Paginators.vue');
//Vue.config.devtools = true;
//Vue.config.debug = true;
//Vue.use(Paginators);
//Vue.use(VueResource);

// Start app
let Index = new Vue({
  el: '#Index',
  data(){
    return {
      someData:'',
      users:"{}",
      user:'',
      filterTerm: '',
      userOrder:'asc',

      pagination:{},
    }
  },
  computed: { },    
  components:{
    //declare component from with a require
    'paginators':Paginators,
    'users-list':UsersList,
  },
  created(){
    //on created fetch users
    this.fetchUsers();
  },
  ready:function(){ },
  filters: { },
  methods: {


    // public method for navigate on paginator
    navigate (page) {      
      this.$http.get('/users/all?page='+page).then(response => {
        // get body json data
        this.users = response.body.data;
        this.pagination = response.data;
      }, response => {
        // error callback
      });      
    },

    // change order variable direction
    changeUserOrder: function(){      
      this.userOrder == 'asc' ? this.userOrder='desc':this.userOrder='asc';      
      this.orderUsers();
    },

    // function to order users in the list
    orderUsers: function () {
      this.users = _.orderBy(this.users, 'name', this.userOrder);
      //this.users = this.shuffle(_.orderBy(this.users, 'name', this.userOrder));
      //console.log(this.users.length);
    },

    /* for transition group flip */
    shuffle: function (items) {
      return _.shuffle(items)
    },

    //function to get users json from controller
    fetchUsers: function () {
      this.$http.get('/users/all').then(response => {
        // get body json data
        this.users = response.body.data;
        this.pagination = response.data;
        this.shuffle(this.users);
      }, response => {
        console.log(response);
        // error callback
      });
    },

  }
});
