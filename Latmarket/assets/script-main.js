// --------------------------------------------------------------------------Login-Register-Modal

document.addEventListener("DOMContentLoaded", function () {
    const openButton = document.getElementById("OpenLogReg");
    const logModal = document.querySelector(".logmodal");
    const closeButton = document.querySelector(".close-ml");

    if (openButton) {
        openButton.addEventListener("click", function () {
            logModal.classList.add("active");
        });
    }

    if (closeButton) {
        closeButton.addEventListener("click", function () {
            logModal.classList.remove("active");
        });
    }
});

const loginBtn = document.getElementById('logBtn');
const registerBtn = document.getElementById('regBtn');
const box = document.querySelector('.cube');
const title = document.querySelector('.modname');
const logForm = document.querySelector('.login-form');
const regForm = document.querySelector('.reg-form');

if (loginBtn) {
    loginBtn.addEventListener('click', () => toggleActive(loginBtn));
}

if (registerBtn) {
    registerBtn.addEventListener('click', () => toggleActive(registerBtn));
}

function toggleActive(button) {
    if (button.id === 'logBtn') {
        logForm.classList.add('active');
        regForm.classList.remove('active');
        box.style.left = '0rem';
        box.style.width = '10.5rem';
        title.textContent = 'Autorizeties';
        localStorage.setItem('active', 'login');
    } else if (button.id === 'regBtn') {
        regForm.classList.add('active');
        logForm.classList.remove('active');
        box.style.left = '12rem';
        box.style.width = '10.5rem';
        title.textContent = 'Reģistreties';
        localStorage.setItem('active', 'register');
    }
}


window.addEventListener('load', function() {
    const activeState = localStorage.getItem('active');

    if (activeState === 'login') {
        logForm.classList.add('active');
        regForm.classList.remove('active');
        box.style.left = '0rem';
        box.style.width = '10.5rem';
        title.textContent = 'Autorizeties';
    } else if (activeState === 'register') {
        regForm.classList.add('active');
        logForm.classList.remove('active');
        box.style.left = '12rem';
        box.style.width = '10.5rem';
        title.textContent = 'Reģistreties';
    }
});

// --------------------------------------------------------------------------Paroles-kriteriju-izvade

loginBtn.addEventListener('click', () => toggleActive(loginBtn));
registerBtn.addEventListener('click', () => toggleActive(registerBtn));


document.getElementById('rpassword1').addEventListener('focus', function() {
    document.querySelector('.configpass').style.display = 'block';
});

document.getElementById('rpassword1').addEventListener('blur', function() {
    if (!this.value) {
        document.querySelector('.configpass').style.display = 'none';
    }
});

// --------------------------------------------------------------------------Password-Check


document.addEventListener("DOMContentLoaded", function () {
    const password1 = document.getElementById("rpassword1");
    const password2 = document.getElementById("rpassword2");
    const registerBtn = document.getElementById("registerBtn");

    function validatePasswords() {
        const password = password1.value;
        
        
        const hasLowerCase = /[a-z]/.test(password);
        const hasUpperCase = /[A-Z]/.test(password);
        const hasNumber = /\d/.test(password);
        const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
        const lengthValid = password.length >= 8 && password.length <= 20;

        
        updateValidation('mBurts', hasLowerCase);
        updateValidation('lBurts', hasUpperCase);
        updateValidation('cipars', hasNumber);
        updateValidation('sSimbols', hasSpecialChar);
        updateValidation('Garums', lengthValid);

        if (hasLowerCase && hasUpperCase && hasNumber && lengthValid && password1.value !== "") {

            password1.style.borderColor = "green";

        }else{

            password1.style.borderColor = "red";

        }

        if(password1.value === password2.value && password2.value !== ""){

            password2.style.borderColor = "green";

        }else{

            password2.style.borderColor = "red";

        }

        if (hasLowerCase && hasUpperCase && hasNumber && lengthValid && password1.value === password2.value && password1.value !== "" && password2.value !== "") {
            registerBtn.disabled = false; 
        } else {
            registerBtn.disabled = true; 
        }

    }

    function updateValidation(id, isValid) {
        const element = document.getElementById(id);
        if (isValid) {
            element.classList.add('valid');
            element.classList.remove('invalid');
        } else {
            element.classList.add('invalid');
            element.classList.remove('valid');
        }
    }


    password1.addEventListener("input", validatePasswords);
    password2.addEventListener("input", validatePasswords);
});



document.addEventListener("DOMContentLoaded", function () {
    const username = document.getElementById("lusername");
    const password = document.getElementById("lpassword");
    const loginBtn = document.getElementById("loginbtn");

    function checkLogin() {

        if (username.value !== "" && password.value !== "") {
            loginBtn.disabled = false; 
        } else {
            loginBtn.disabled = true;  
        }

    }

    username.addEventListener("input", checkLogin);
    password.addEventListener("input", checkLogin);
});

// --------------------------------------------------------------------------Modal-Open


let modalbtn = document.querySelectorAll('[data-target]')
let closeModal = document.querySelectorAll('.closemodal')


modalbtn.forEach(function(btn){

    btn.addEventListener('click', function(){

        document.querySelector(btn.dataset.target).classList.toggle('active')

    })

})


closeModal.forEach(function(btn){

    btn.addEventListener('click', function(){

        document.querySelector(btn.dataset.target).classList.remove('active')

    })

})

// --------------------------------------------------------------------------Mes-Modal-close


document.addEventListener('click', function(event) {
    let closeMessage = document.getElementById('mesclose'); 
    
    if (closeMessage && event.target === closeMessage) {
        let messageBlock = document.querySelector('linemess');
        if (messageBlock) {
            messageBlock.style.display = "none";
        }
    }
});
