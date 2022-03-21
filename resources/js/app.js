const $ = window.$ = window.jQuery = require('jquery');
window.Popper = require('popper.js');


$(document).ready( function () {
    if(window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href); // Force no form resubmission.
    }
});

// Initialize tippy.js
const tippy = require('tippy.js');

tippy.default('[data-tippy-content]', {
    theme: 'material',
    plugins: [tippy.animateFill],
    interactive: true,
    allowHTML: true
});

const aos = require('aos');
aos.init({
    once: true
});

// CKEditor 5 Implimenetations
import ClassicEditor from '@ckeditor/ckeditor5-build-classic/build/ckeditor';

// ref: https://tobiasahlin.com/blog/move-from-jquery-to-vanilla-javascript/#document-ready

var ready = (callback) => {
  if (document.readyState != "loading") callback();
  else document.addEventListener("DOMContentLoaded", callback);
}

ready(() => { 
    ClassicEditor
        .create(document.querySelector('textarea:not([no-editor])'),{})
        .catch(error => {
            console.log(`error`, error)
        });
});

window.toastr = require('toastr');

window.Axios = require('axios');
window.Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.Axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}