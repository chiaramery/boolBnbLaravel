const openMap = document.querySelector('.open');
const map = document.querySelector('.map-s');

openMap.addEventListener('click', function () {
    map.classList.toggle('open-map');


    if (openMap.innerHTML === "Close Map") {
        openMap.innerHTML = "Open Map";

    } else {
        openMap.innerHTML = "Close Map";
    }


})