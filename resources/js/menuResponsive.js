const openNavbar = document.querySelector('.open-btn');
const menuNavbar = document.querySelector('.navbar-dash');
const chevron = document.querySelector('.fa-circle-chevron-right');

openNavbar.addEventListener('click', function () {
    menuNavbar.classList.toggle('move');
    chevron.classList.toggle('rotate-btn');
})