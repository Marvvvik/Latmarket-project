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
        logBtn.classList.add('active');
        registerBtn.classList.remove('active');
        localStorage.setItem('active', 'login');
    } else if (button.id === 'regBtn') {
        regForm.classList.add('active');
        logForm.classList.remove('active');
        registerBtn.classList.add('active');
        logBtn.classList.remove('active');
        localStorage.setItem('active', 'register');
    }
}


window.addEventListener('load', function() {
    const activeState = localStorage.getItem('active');

    if (activeState === 'login') {
        logForm.classList.add('active');
        regForm.classList.remove('active');
        logBtn.classList.add('active');
        registerBtn.classList.remove('active');
    } else if (activeState === 'register') {
        regForm.classList.add('active');
        logForm.classList.remove('active');
        registerBtn.classList.add('active');
        logBtn.classList.remove('active');
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('lpassword');
    const toggleBtn = document.querySelector('.lookpassL img');

    toggleBtn.addEventListener('click', function () {
        const isPassword = passwordInput.type === 'password';

        passwordInput.type = isPassword ? 'text' : 'password';
        toggleBtn.src = isPassword ? '/image/icons/hide.png' : '/image/icons/view.png';
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const passwordInput1 = document.getElementById('rpassword1');
    const passwordInput2 = document.getElementById('rpassword2');
    const toggleBtnR = document.querySelector('.lookpassR img');

    toggleBtnR.addEventListener('click', function () {
        const isPassword1 = passwordInput1.type === 'password';
        const isPassword2 = passwordInput2.type === 'password';


        passwordInput1.type = isPassword1 ? 'text' : 'password';
        passwordInput2.type = isPassword2 ? 'text' : 'password';
        toggleBtnR.src = isPassword1 ? '/image/icons/hide.png' : '/image/icons/view.png';
    });
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

        if (hasLowerCase && hasSpecialChar && hasUpperCase && hasNumber && lengthValid && password1.value === password2.value && password1.value !== "" && password2.value !== "") {
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

// --------------------------------------------------------------------------Prof-menu-open

document.addEventListener("DOMContentLoaded", function () {
    const buttons = {
        iestbtn: "settings-menu",
        favbtn: "favoriti-menu",
        sludbtn: "slud-menu",
        sarbtn: "sar-menu"
    };

    const profelimenu = document.querySelector(".profelimenu");

    if (!profelimenu) {
        return; 
    }

    Object.keys(buttons).forEach(btnId => {
        const button = document.getElementById(btnId);
        const menu = document.getElementById(buttons[btnId]);


        if (button && menu) {
            button.addEventListener("click", function () {
                profelimenu.classList.remove("active");
                Object.values(buttons).forEach(menuId => {
                    const menuElement = document.getElementById(menuId);
                    if (menuElement) {
                        menuElement.classList.remove("active");
                    }
                });

                profelimenu.classList.add("active");
                menu.classList.add("active");
            });
        }
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const settingsBtn = document.getElementById('Iestatijumi');
    const favoritiBtn = document.getElementById('Favoriti');
    const sludinajumiBtn = document.getElementById('Sludinajumi');
    const sarakstiBtn = document.getElementById('Saraksti');
  
    const settingsMenu = document.getElementById('settings-menu');
    const favoritiMenu = document.getElementById('favoriti-menu');
    const sludMenu = document.getElementById('slud-menu');
    const sarMenu = document.getElementById('sar-menu');
  
    function setActiveMenu(activeButton, activeMenu) {
      settingsMenu.classList.remove('active');
      favoritiMenu.classList.remove('active');
      sludMenu.classList.remove('active');
      sarMenu.classList.remove('active');
  

      activeMenu.classList.add('active');
    }
  
    settingsBtn.addEventListener('click', function() {
      setActiveMenu(this, settingsMenu);
    });
  
    favoritiBtn.addEventListener('click', function() {
      setActiveMenu(this, favoritiMenu);
    });
  
    sludinajumiBtn.addEventListener('click', function() {
      setActiveMenu(this, sludMenu);
    });
  
    sarakstiBtn.addEventListener('click', function() {
      setActiveMenu(this, sarMenu);
    });
  });


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

// --------------------------------------------------------------------------Avatar-change

document.addEventListener("DOMContentLoaded", function () {
    const fileInput = document.getElementById("newavatar");
    const imgPreview = document.getElementById("avatar-preview");
    const closePreview = document.querySelector(".close-prew");
    const deleteButton = document.querySelector(".avatar-del");

    fileInput.addEventListener("change", function () {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function (e) {
                imgPreview.src = e.target.result;
                if (closePreview) {
                    closePreview.classList.add("active");
                }
            };
            
            reader.readAsDataURL(this.files[0]);
        }
    });

    if (deleteButton) {
        deleteButton.addEventListener("click", function () {
            imgPreview.src = "";
            fileInput.value = "";
            if (closePreview) {
                closePreview.classList.remove("active");
            }
        });
    }
});






