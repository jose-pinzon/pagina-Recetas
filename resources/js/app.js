/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
 import 'sweetalert2/dist/sweetalert2.min.css'
 import Vuesweetalert2 from 'vue-sweetalert2';
 import 'owl.carousel';

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
 Vue.use(Vuesweetalert2);
 Vue.config.ignoredElements = ['trix-editor']
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('moment', require('./components/moment.vue').default);
Vue.component('eliminar-receta', require('./components/EliminarReceta.vue').default);
Vue.component('component-like',require('./components/ComponentLike.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});



// funciones de carousel

jQuery(document).ready(function(){
    jQuery('.owl-carousel').owlCarousel({
        margin:10,/* separacion */
        loop:true,/* para que el carousel sea infinito */
        autoplay:true,/* para que se mueva automaticamente */
        autoplayHoverPause:true, /* para que se deje de mover cuando esta el cursor encima */

        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            },
            1500:{
                items:4
            }
        }
    });
})
