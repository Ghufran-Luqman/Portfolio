const email = document.getElementById('email');
const password = document.getElementById('password');
const submit = document.getElementById('submit');
const errorMsg = document.getElementById('jsErrorMsg');
let emailValid = true;
let passwordValid = true;

submit.addEventListener('click', function(e) {
    let valid = true

    if (email.value.length==0) {
        emailValid = false;
        valid = false;
        email.classList.add('notFilledOut');
    }
    if (password.value.length==0) {
        passwordValid = false;
        valid = false;
        password.classList.add('notFilledOut');
    }

    if (!(valid)) {
        e.preventDefault();
        errorMsg.textContent = "Please fill in all fields."
    }
})

email.addEventListener('input', function() {
    if (!(emailValid)) {
        email.classList.remove('notFilledOut');
        errorMsg.textContent="";
    }
})

password.addEventListener('input', function() {
    if (!(passwordValid)) {
        password.classList.remove('notFilledOut');
        errorMsg.textContent="";
    }
})
