import $ from 'jquery'; // Importar jQuery
window.$ = window.jQuery = $; // Asignar jQuery al objeto window

import 'bootstrap/dist/css/bootstrap.min.css'; // Importar CSS de Bootstrap
import 'bootstrap'; // Importar JavaScript de Bootstrap
import '../css/app.css'; // Tu archivo CSS

$(document).ready(function() {
    console.log('jQuery está funcionando correctamente!');
});