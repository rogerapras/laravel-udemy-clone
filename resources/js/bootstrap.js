/**
 * This bootstrap file is used for both frontend and backend
 */

import _ from 'lodash'
import axios from 'axios'
import Swal from 'sweetalert2';
import $ from 'jquery';
import 'popper.js'; // Required for BS4
import 'bootstrap';
window.$ = window.jQuery = $;
window.Swal = Swal;
window._ = _; // Lodash
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

$(window).scroll(function(){
    if ($(this).scrollTop() > 130) {
        $('.course_details__preview').addClass('fixed');
        $('.clp-component-render').addClass('d-none');
        $('.fullwidth__fixed').removeClass('d-none');
    } else {
        $('.course_details__preview').removeClass('fixed');
        $('.clp-component-render').removeClass('d-none');
        $('.fullwidth__fixed').addClass('d-none');
    }
});

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
