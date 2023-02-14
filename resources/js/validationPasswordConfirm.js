const passwordOriginal = document.getElementById('password');
const passwordConfirm = document.getElementById('password-confirm');

const messageCompare = document.getElementById('message-password');

console.log(messageCompare);

if (passwordOriginal && passwordConfirm && messageCompare) {
    passwordConfirm.addEventListener('input', function () {
        if (this.value == passwordOriginal.value) {
            messageCompare.innerHTML = "Le password corrispondono";
            messageCompare.style.color = "green";
        } else {
            messageCompare.innerHTML = "Le password non corrispondono";
            messageCompare.style.color = "red";
        }
    })
}