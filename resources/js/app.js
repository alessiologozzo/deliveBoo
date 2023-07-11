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



// document.addEventListener('DOMContentLoaded', function () {
//     document.getElementById('main-loader').style.display = 'none';
// });

// window.addEventListener('load', function () {
//     document.getElementById('loader').style.cssText = 'display: none !important;';
//     document.getElementById('main-loader').style.display = 'block';
// });



const deleteSubmitButtons = document.querySelectorAll('.delete-button');
console.log(deleteSubmitButtons)

document.addEventListener('DOMContentLoaded', () => {
    const deleteSubmitButtons = document.querySelectorAll('.delete-button');

    deleteSubmitButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            event.preventDefault();

            const dataTitle = button.getAttribute('data-item-title');
            console.log(dataTitle)

            const modal = document.getElementById('deleteModal');

            if (modal) { // Controlla se l'elemento "deleteModal" è presente
                const bootstrapModal = new bootstrap.Modal(modal);
                bootstrapModal.show();

                const modalItemTitle = modal.querySelector('#modal-item-title');
                modalItemTitle.textContent = dataTitle;

                const buttonDelete = modal.querySelector('button.btn-primary');

                buttonDelete.addEventListener('click', () => {
                    button.parentElement.submit();
                });
            }
        });
    });
});

