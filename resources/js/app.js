import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
]);

import * as Func from "./functions.js";
window.Func = Func;
window.Var = {
    resized: false
}

let app = document.getElementById("app");
app.addEventListener("click", Func.removeMenusHandler);

Func.drawChart();
