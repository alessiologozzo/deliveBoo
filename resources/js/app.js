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


document.getElementById('dish-form').addEventListener('submit', function(event) {
    event.preventDefault();

    let errorsClient = [];
    
    let image = document.getElementById('image');
    let name = document.getElementById('name');
    let price = document.getElementById('price');
    let category = document.getElementById('category');
    let description = document.getElementById('description');
    let visible = document.getElementById('visible');
    let containerErrors = document.getElementById('errors-lato-client');
    containerErrors.className = 'alert alert-danger'

    let ul = document.getElementsByClassName('ul-error')[0]
    ul.innerHTML = ''
        
    
    if (image.value == '') {
        errorsClient.push('Il campo immagine è obbligatorio');
        image.classList.add("is-invalid")
    }

    if (name.value == '') {
        errorsClient.push('Il nome del piatto è obbligatorio');
        name.classList.add("is-invalid")
    }

    if (price.value < 0 || price.value == 0 || price.value > 80 || price.value == '') {
        errorsClient.push('Il prezzo non corrisponde ai requisiti');
        price.classList.add("is-invalid")
    }

    if (category.value == '') {
        errorsClient.push('Il campo categoria è obbligatorio');
        category.classList.add("is-invalid")
    }

    if (description.value == '') {
        errorsClient.push('Il campo descrizione è obbligatorio');
        description.classList.add("is-invalid")
    }

    if (visible.value == '') {
        errorsClient.push('Il campo value è obbligatorio');
        visible.classList.add("is-invalid")
    }

    
    if (errorsClient.length == 0) {
        this.submit();
    } else{
        errorsClient.forEach(function(error){
            let li = document.createElement('li');
            li.classList.add('list-group-item')
            li.innerText += '-' + error
            ul.appendChild(li)
        })
    }
});

