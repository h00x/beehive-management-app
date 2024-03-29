/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import * as VueGoogleMaps from 'vue2-google-maps';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyA_EPtNQeXKa8cJL5hrZV-teKCShpQX-Ls',
        libraries: 'places',
    },
    installComponents: true
});

Vue.component('dropdown', require('./components/Dropdown').default);
Vue.component('flash-message', require('./components/FlashMessage').default);
Vue.component('modal', require('./components/Modal').default);
Vue.component('google-map', VueGoogleMaps.Map);
Vue.component('google-map-marker', VueGoogleMaps.Marker);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',

});
