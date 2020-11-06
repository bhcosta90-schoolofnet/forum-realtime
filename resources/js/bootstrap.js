window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    // require('bootstrap');
    require('materialize-css/dist/js/materialize.js')
    require('./parallax-header.js')

} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

import swal from 'sweetalert2'

const successCallback = (response) => {
    return response;
}

const errorCallback = (error) => {
    switch(error.response.status){
        case 422:
            swal.fire({
                title: "Erro",
                text: "Dados enviados estão incorretos.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'OK!',
                cancelButtonText: 'Não!'
            }).then(result => {
                if(result.value) {
                    window.location = '/login';
                }
            });
            break;
        case 401:
            swal.fire({
                title: "Autenticação",
                text: "Para acessar esse recurso, você precisa estar autenticado, Você será redirecionado",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'OK!',
                cancelButtonText: 'Não!'
            }).then(result => {
                if(result.value) {
                    window.location = '/login';
                }
            });
        break;
        default:
            swal.fire({
                title: "Erro",
                text: "Algo deu errado e não pude resolver.",
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'OK!',
                cancelButtonText: 'Não!'
            }).then(result => {
                if(result.value) {
                    window.location = '/login';
                }
            });
    }

    return Promise.reject(error)
}

window.axios.interceptors.response.use(successCallback, errorCallback);

window.Vue = require('vue');
Vue.component('loader-component', require('./common/PreLoader.vue').default);

const commonApp = new Vue({
    el: '#loader'
});
