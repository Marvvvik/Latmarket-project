// --------------------------------------------------------------------------Login-Register-Modal

document.addEventListener("DOMContentLoaded", function () {
    const openButton = document.getElementById("openLoginModal");
    const logModal = document.querySelector(".auth-modal");
    const closeButton = document.getElementById("closeAuth");

    function openModal() {
        if (logModal) {
            logModal.classList.add("active");
            localStorage.setItem("authModalOpen", "true"); 
        }
    }

    function closeModal() {
        if (logModal) {
            logModal.classList.remove("active");
            localStorage.removeItem("authModalOpen"); 
        }
    }

    if (logModal) {
        if (localStorage.getItem("authModalOpen") === "true") {
            openModal();
        }
    }

    if (openButton && logModal) {
        openButton.addEventListener("click", openModal);
    }

    if (closeButton && logModal) {
        closeButton.addEventListener("click", closeModal);
    }

    const loginBtn = document.getElementById('login-tab-button');
    const registerBtn = document.getElementById('register-tab-button');
    const logForm = document.querySelector('.login-form-container');
    const regForm = document.querySelector('.register-form-container');

    if (loginBtn && registerBtn && logForm && regForm) {
        loginBtn.addEventListener('click', () => toggleActive(loginBtn));
        registerBtn.addEventListener('click', () => toggleActive(registerBtn));
        const activeState = localStorage.getItem('active');

        if (activeState === 'login') {
            logForm.classList.add('active');
            regForm.classList.remove('active');
            loginBtn.classList.add('active');
            registerBtn.classList.remove('active');
        } else if (activeState === 'register') {
            regForm.classList.add('active');
            logForm.classList.remove('active');
            registerBtn.classList.add('active');
            loginBtn.classList.remove('active');
        } else {
            logForm.classList.add('active');
            loginBtn.classList.add('active');
        }


        function toggleActive(button) {
            if (button.id === 'login-tab-button') {
                logForm.classList.add('active');
                regForm.classList.remove('active');
                loginBtn.classList.add('active');
                registerBtn.classList.remove('active');
                localStorage.setItem('active', 'login');
            } else if (button.id === 'register-tab-button') {
                regForm.classList.add('active');
                logForm.classList.remove('active');
                registerBtn.classList.add('active');
                loginBtn.classList.remove('active');
                localStorage.setItem('active', 'register');
            }
        }
    }

// ---------------------------------------------------------Toggle password in login
const passwordInput = document.getElementById('login-password');
const toggleBtn = document.getElementById('passworVisibilityLogin');

if (passwordInput && toggleBtn) {
    toggleBtn.addEventListener('click', function () {
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        toggleBtn.src = isPassword ? '/image/icons/hide.png' : '/image/icons/view.png';
    });
}

// ---------------------------------------------------------Toggle password in register
const passwordInput1 = document.getElementById('register-password1');
const passwordInput2 = document.getElementById('register-password2');
const toggleBtnR = document.getElementById('passwordVisibilityRegister');

if (passwordInput1 && passwordInput2 && toggleBtnR) {
    toggleBtnR.addEventListener('click', function () {
        const isPassword1 = passwordInput1.type === 'password';
        const isPassword2 = passwordInput2.type === 'password';
        passwordInput1.type = isPassword1 ? 'text' : 'password';
        passwordInput2.type = isPassword2 ? 'text' : 'password';
        toggleBtnR.src = isPassword1 ? '/image/icons/hide.png' : '/image/icons/view.png';
    });
}

// -----------------------------------------------------------------Paroles-kriteriju-izvade
    if (passwordInput1) {
        passwordInput1.addEventListener('focus', function () {
            const configpass = document.querySelector('.password-requirements');
            if (configpass) {
                configpass.style.display = 'block';
            }
        });

        passwordInput1.addEventListener('blur', function () {
            const configpass = document.querySelector('.password-requirements');
            if (configpass && !this.value) {
                configpass.style.display = 'none';
            }
        });
    }

// ----------------------Password-Check
    const registerButton = document.getElementById("register-submit-button");

    if (passwordInput1 && passwordInput2 && registerButton) {
        function validatePasswords() {
            const password = passwordInput1.value;
            const hasLowerCase = /[a-z]/.test(password);
            const hasUpperCase = /[A-Z]/.test(password);
            const hasNumber = /\d/.test(password);
            const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
            const lengthValid = password.length >= 8 && password.length <= 20;

            updateValidation('uppercase-requirement', hasUpperCase);
            updateValidation('lowercase-requirement', hasLowerCase);
            updateValidation('specialchar-requirement', hasSpecialChar);
            updateValidation('digit-requirement', hasNumber);
            updateValidation('length-requirement', lengthValid);

            passwordInput1.style.borderColor = (hasLowerCase && hasUpperCase && hasNumber && lengthValid && passwordInput1.value !== "") ? "green" : "red";
            passwordInput2.style.borderColor = (passwordInput1.value === passwordInput2.value && passwordInput2.value !== "") ? "green" : "red";

            registerButton.disabled = !(hasLowerCase && hasSpecialChar && hasUpperCase && hasNumber && lengthValid && passwordInput1.value === passwordInput2.value && passwordInput1.value !== "" && passwordInput2.value !== "");
        }

        function updateValidation(id, isValid) {
            const element = document.getElementById(id);
            if (element) {
                element.classList.toggle('valid', isValid);
                element.classList.toggle('invalid', !isValid);
            }
        }

        passwordInput1.addEventListener("input", validatePasswords);
        passwordInput2.addEventListener("input", validatePasswords);
    }

// ----------------------------------------Login form validation

    const username = document.getElementById("login-username");
    const loginPassword = document.getElementById("login-password");
    const loginButton = document.getElementById("login-submit-button");

    if (username && loginPassword && loginButton) {
        function checkLogin() {
            loginButton.disabled = !(username.value !== "" && loginPassword.value !== "");
        }

        username.addEventListener("input", checkLogin);
        loginPassword.addEventListener("input", checkLogin);
    }
});

// --------------------------------------------------------------------------Profile-menu

const profileImageHeader = document.querySelector('.profile-image-header');
const profileMenu = document.getElementById('profileMenu');

if (profileImageHeader && profileMenu) {
    profileImageHeader.addEventListener('click', function(event) {
        profileMenu.classList.toggle('active');
        event.stopPropagation();
    });

    document.addEventListener('click', function(event) {
        if (!profileImageHeader.contains(event.target) && !profileMenu.contains(event.target)) {
            profileMenu.classList.remove('active');
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    // -------------------------- Section Buttons Toggle
    const buttons = {
        settingsBtn: "settingsSection",
        favoritesBtn: "favoritesSection",
        offerBtn: "offerSection",
    };

    const profelimenu = document.querySelector(".modal");

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

    const closeProfileModal = document.getElementById('closeProfileMdoal');
    if (closeProfileModal) {
        closeProfileModal.addEventListener('click', function () {
            if (profelimenu) {
                profelimenu.classList.remove('active');
            }
        });
    }

    // -------------------------- Menu Section
    const settingsBtn = document.getElementById('settingsSectionBtn');
    const favoritiBtn = document.getElementById('favoritesSectionBtn');
    const sludinajumiBtn = document.getElementById('offersSectionBtn');
  
    const settingsMenu = document.getElementById('settingsSection');
    const favoritiMenu = document.getElementById('favoritesSection');
    const sludMenu = document.getElementById('offerSection');
  
    function setActiveMenu(activeButton, activeMenu) {
        settingsMenu.classList.remove('active');
        favoritiMenu.classList.remove('active');
        sludMenu.classList.remove('active');
  
        activeMenu.classList.add('active');
    }

    if (settingsBtn && settingsMenu) {
        settingsBtn.addEventListener('click', function() {
            setActiveMenu(this, settingsMenu);
        });
    }
  
    if (favoritiBtn && favoritiMenu) {
        favoritiBtn.addEventListener('click', function() {
            setActiveMenu(this, favoritiMenu);
        });
    }
  
    if (sludinajumiBtn && sludMenu) {
        sludinajumiBtn.addEventListener('click', function() {
            setActiveMenu(this, sludMenu);
        });
    }

    // -------------------------- Avatar Change
    const fileInput = document.getElementById("newAvatar");
    const imgPreview = document.getElementById("avatarPreview");
    const title = document.getElementById("avatarTitle");
    const closePreview = document.querySelector(".close-Preview");
    const deleteButton = document.querySelector(".avatar-Delet");

    if (fileInput && imgPreview) {
        fileInput.addEventListener("change", function () {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function (e) {
                    imgPreview.src = e.target.result;
                    if (closePreview) {
                        closePreview.classList.add("active");
                        title.classList.remove("active");
                    }
                };
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    if (deleteButton && imgPreview) {
        deleteButton.addEventListener("click", function () {
            imgPreview.src = "";
            fileInput.value = "";
            if (closePreview) {
                closePreview.classList.remove("active");
                title.classList.add("active");
            }
        });
    }

});

document.addEventListener('DOMContentLoaded', () => {
    const onEditPass = document.getElementById('onPasswordChange');
    const closeEditPass = document.getElementById('ClosePasswordEdit');

    onEditPass.addEventListener('click', () => {
        onEditPass.classList.add('active');
    });

    closeEditPass.addEventListener('click', () => {
        onEditPass.classList.remove('active');
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

// --------------------------------------------------------------------------payment-close

document.getElementById('closePayment').addEventListener('click', function() {
    const paymentContainer = document.querySelector('.payment-container');
    if (paymentContainer) {
        paymentContainer.remove();
    }
});







