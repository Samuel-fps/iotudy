// resources/js/app.js
import 'bootstrap/dist/css/bootstrap.min.css'; // Importar Bootstrap
import 'bootstrap'; // Importar JavaScript de Bootstrap
import '../css/app.css';

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

ClassicEditor
    .create(document.querySelector('#body'))
    .then(editor => {
        window.editor = editor;
    })
    .catch(error => {
        console.error(error);
    });