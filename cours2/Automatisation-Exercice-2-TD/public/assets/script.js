const modal = document.querySelector('#modal-wrapper');
const modalContent = document.querySelector('#modal-content');
const modalTitle = document.querySelector('#modal-title');

function openModal() {
modal.classList.add('active');
}

function closeModal() {
    modal.classList.remove('active')
    modalContent.innerHTML = ""
}

function loadModalContent(url, title) {
fetch(url)
.then(response => response.text())
.then(data => {
modalContent.innerHTML = data;
modalTitle.innerHTML = title;
openModal()
})
.catch(error => console.log(error))
}

// On gère la fermeture du modal
function init() {

document.querySelector('#close-modal').addEventListener("click", closeModal)
document.addEventListener('keydown', event => {
    if (event.key == 'Escape') closeModal();

})

const officesList = document.querySelector('.offices-list');
if (officesList) {
    document.querySelector('.offices-list').addEventListener('click', (event) => {
        if (event.target.classList.contains('office-edit')) {
            loadModalContent(`/office/${event.target.dataset.officeId}/edit`, 'Édition du bureau');
        }
    });
}
}


document.addEventListener('DOMContentLoaded', init)
