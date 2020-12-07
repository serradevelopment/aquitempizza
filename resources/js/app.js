/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vuex from 'vuex';

 require('./bootstrap');
 window.Vue = require('vue');
 window.moment = require('moment');
 Vue.use(require('vue-cookies'))
 Vue.use(Vuex);

 Vue.$cookies.config('3m')
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('tops', require('./components/Tops.vue').default);
Vue.component('cart', require('./components/Cart.vue').default);
Vue.component('product-list', require('./components/ProductList.vue').default);
Vue.component('btn-call-cart', require('./components/ButtonCallCart.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 const store = new Vuex.Store({
 	state: {
 		cart:{
 			products: [],
 			total: 0
 		}
 	},
    getters:{
 	    getTotal:(state ) => {
 	        return state.cart.total;
        }
    },
    mutations: {
        addToCart: (state, product) => {
            state.cart.products.push(product);
            var total = 0;
            for (var i = state.cart.products.length - 1; i >= 0; i--) {
                total += state.cart.products[i].value;

                for(var j = state.cart.products[i].additionals.length -1;j >= 0; j--){
                    total += state.cart.products[i].additionals[j].price;
                }
            }
            state.cart.total = total;
        },
        removeFromCart:(state,product) => {
            var index = state.cart.products.indexOf(product);

            if (index > -1) {

                state.cart.total = (state.cart.total - product.value);
                state.cart.products.splice(index, 1);
            }
        },
        updateTotal:(state,total)=>{
            state.cart.total = total;
        }
    }
 });

 const app = new Vue({
 	el: '#app',
 	store
 });
