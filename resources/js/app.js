import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
]);

import * as Func from "./functions.js";
window.Func = Func;
window.Var = {
    resized: false,
    modalFormIndex: null
}

let app = document.getElementById("app");
app.addEventListener("click", Func.removeMenusHandler);
app.addEventListener("click", Func.removeConfirmElementHandler);

Func.drawChart();



document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('main-loader').style.display = 'none';
});

window.addEventListener('load', function () {
    document.getElementById('loader').style.cssText = 'display: none !important;';
    document.getElementById('main-loader').style.display = 'block';
});
