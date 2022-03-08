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