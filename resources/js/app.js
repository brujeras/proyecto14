require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

/**CKEDITOR 5 */
import ClassicEditor from '@ckeditor/ckeditor5-build-classic/build/ckeditor';
var ready = (callback) => {
    if (document.readyState != "loading") callback();
    else document.addEventListener("DOMContentLoaded", callback);
}

ready(() => {
    ClassicEditor
        .create(document.querySelector('#ckeditor'))
        .catch(error => {
            console.log(`error`, error)
        });
});
/**DROPZONE */
import  Dropzone  from "dropzone/src/dropzone";
window.Dropzone = Dropzone;

/** SweetAlert2 */
import Swal from 'sweetalert2/src/sweetalert2';
window.Swal = Swal;
/** glider.js */
import gli from 'glider-js';
window.gli = gli;


/** jquery */
import jquery from 'jquery/src/jquery'
window.jQuery = jquery;
/** flexslider */
import flexslider from 'flexslider';

var flatpickr = require("flatpickr");


