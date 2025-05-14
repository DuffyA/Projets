'use strict';

const openModal = document.querySelector('.mobile-open');
const closeModal = document.querySelector('.mobile-close');
const overlay = document.querySelector('.overlay');
const menu = document.querySelector('.mobile-menu');

//Close Menus
if (overlay) {
    overlay.addEventListener('click', function(e) {
        overlay.classList.add('hidden');
    menu.classList.add('hidden');
    connexionMenu.classList.add('hidden')
    });
}


if (closeModal) {
    closeModal.addEventListener('click', function(e) {
        overlay.classList.add('hidden');
        menu.classList.add('hidden');
        connexionMenu.classList.add('hidden')
    });
}

//Modal Menu
if (openModal) {
    openModal.addEventListener('click', function(e) {
        overlay.classList.remove('hidden');
        menu.classList.remove('hidden');
    });
}

