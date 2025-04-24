// ------------------------------------------------------------Registracija

$(document).on('click', '.closemodal', function() {
    $(this).closest('.linemess').fadeOut(100, function() {
    $(this).remove();
    });
});

$('#registerForm').submit(e => {
    e.preventDefault();

    const username = $('#username').val();
    const rpassword1 = $('#rpassword1').val();
    const rpassword2 = $('#rpassword2').val();

    const postData = { username, rpassword1, rpassword2 };
    const url = '/database/register.php';

    $.ajax({
        type: 'POST',
        url: url,
        data: postData,
        dataType: 'json',
        success: response => {
            $('.linemess').remove();

            const messageType = response.success ? "success" : "error";
            const messageText = response.success ? response.message : response.error;
            const iconClass = response.success ? "fa-check" : "fa-close";
            const titleText = response.success ? "Veiksmīgi!" : "Ne veiksmīgi!";

            const messageBox = `<div class="linemess ${messageType}">
                                    <i class="fas fa-close closemodal" id="mesclose"></i>
                                    <div class="mesinfobox">
                                        <i class="fas ${iconClass}"></i>
                                        <div class="mesinfo">
                                            <h2>${titleText}</h2>
                                            <p>${messageText}</p>
                                        </div>
                                    </div>
                                    <div class="timeline"></div>
                                </div>`;
            $('body').append(messageBox);

            setTimeout(() => {
                $('.linemess').fadeOut(300, function () { $(this).remove(); });
            }, 5000);

            if (!response.success) {
                $('.regmes').html(response.error);
            } else {
                $('.regmes').empty(); 
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Kļūda pie datu nmosutišanas:', errorThrown);
            $('.linemess').remove();
            const errorMessage = `<div class="linemess error">
                                    <i class="fas fa-close closemodal" id="mesclose"></i>
                                    <div class="mesinfobox">
                                        <i class="fas fa-close"></i>
                                        <div class="mesinfo">
                                            <h2>Ne veiksmīgi!</h2>
                                            <p>Kļūda sistēmā! Lūdzu, mēģiniet vēlreiz.</p>
                                        </div>
                                    </div>
                                    <div class="timeline"></div>
                                </div>`;
            $('body').append(errorMessage);
            setTimeout(() => {
                $('.linemess').fadeOut(300, function () { $(this).remove(); });
            }, 5000);
            $('.regmes').html(`<div class="notif-slide-red">Kļūda sistēmā! Lūdzu, mēģiniet vēlreiz.</div>`); // Keep the original error message in .regmes as well
        }
    });
});

// ------------------------------------------------------------Datu ielase Settingos 

$(document).ready(function() {

datuIzvade();

});

function datuIzvade() {
    var userId = $("#lietotajaId").val();

    $.ajax({
        url: "/database/setting-ielasa.php", 
        type: "POST",
        data: { id: userId },
        dataType: "json",
        success: function(response) {
            if (response.success) {

                setField("#vards", response.vards);
                setField("#uzvards", response.uzvards);
                setField("#epasts", response.epasts);
                setField("#telefons", response.telefons);

  
                $(".name-i p").text(response.full_name);
                $(".email-i p").text(response.epasts); 
                $(".avatarImg").attr("src", response.avatar);

            } 
        },
        error: function() {
            console.log("Kļuda pieprasijumā pie servera.");
        }
    });

    function setField(selector, value) {
        if (value === "Unknown") {
            $(selector).attr("placeholder", "Unknown").val("");
        } else {
            $(selector).val(value);
        }
    }
};

// ------------------------------------------------------------Datu edit Settingos 

$('#editForm').submit(e => {
    e.preventDefault();

    const editPassActive = $('.passwordC').hasClass('active');
    const liet_id = $('#lietotajaId').val();
    const vards = $('#vards').val();
    const uzvards = $('#uzvards').val();
    const epasts = $('#epasts').val();
    const telefons = $('#telefons').val();
    const password1 = $('#password1-c').val();
    const password2 = $('#password2-c').val();
    const newavatar = $('#newavatar')[0].files[0];  

    const formData = new FormData();
    formData.append('liet_id', liet_id);
    formData.append('vards', vards);
    formData.append('uzvards', uzvards);
    formData.append('epasts', epasts);
    formData.append('telefons', telefons);
    formData.append('password1', password1);
    formData.append('password2', password2);
    formData.append('editPassActive', editPassActive);
    formData.append('newavatar', newavatar); 
    

    const editUrl = '/database/edit-profile.php';

    $.ajax({
        type: 'POST',
        url: editUrl,
        data: formData,
        dataType: 'json',
        processData: false,  
        contentType: false, 
        success: response => {
            const messageType = response.success ? "success" : "error";
            const messageText = response.success ? response.message : response.error;
            const iconClass = response.success ? "fa-check" : "fa-close";
            const titleText = response.success ? "Veiksmīgi!" : "Ne veiksmīgi!";

            $('.linemess').remove();

            const messageBox = `<div class="linemess ${messageType}">
                                    <i class="fas fa-close closemodal" id="mesclose"></i>

                                    <div class="mesinfobox">
                                        <i class="fas ${iconClass}"></i>

                                        <div class="mesinfo">
                                            <h2>${titleText}</h2>
                                            <p>${messageText}</p>
                                        </div>
                                    </div>
                                    <div class="timeline"></div>
                                </div>`;

            $('body').append(messageBox);

            setTimeout(() => {
                $('.linemess').fadeOut(300, function () { $(this).remove(); });
            }, 5000);

            if (response.success) {
                datuIzvade();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Kļuda pie datu nosūtīšanas:', errorThrown);
            $('.linemess').remove();
            const errorMessage = `<div class="linemess error">
                                    <i class="fas fa-close closemodal" id="mesclose"></i>

                                    <div class="mesinfobox">
                                        <i class="fas fa-close"></i>

                                        <div class="mesinfo">
                                            <h2>Ne veiksmīgi!</h2>
                                            <p>Kļūda sistēmā! Lūdzu, mēģiniet vēlreiz.</p>
                                        </div>
                                    </div>
                                    <div class="timeline"></div>
                                </div>`;
            $('body').append(errorMessage);
            setTimeout(() => {
                $('.linemess').fadeOut(300, function () { $(this).remove(); });
            }, 5000);
        }
    });
});



// ------------------------------------------------------------Atsaukmes add un izvade un delet



$('#atsakmes-form').submit(e => {
    e.preventDefault();

    const vards = $('#atsaukmes-vards').val();
    const uzvards = $('#atsaukmes-uzvards').val();
    const stars = $('#rating-value').val();
    const at_text = $('#atsaukmes-text').val();
    const lietotaja_id = $('#atsaukmes-lit-id').val();
    const avatar = $('#atsaukmes-avatar').val();  

    
    const formData = new FormData();
    formData.append('vards', vards);
    formData.append('uzvards', uzvards);
    formData.append('stars', stars);
    formData.append('at_text', at_text);
    formData.append('lietotaja_id', lietotaja_id);
    formData.append('atsukmes_avatar', avatar); 


    const addUrl = '/database/atsaukmes-add.php';
    
    console.log(formData)

    $.ajax({
        type: 'POST',
        url: addUrl,
        data: formData,
        dataType: 'json',
        processData: false,  
        contentType: false, 
        success: response => {
            const messageType = response.success ? "success" : "error";
            const messageText = response.success ? response.message : response.error;
            const iconClass = response.success ? "fa-check" : "fa-close";
            const titleText = response.success ? "Veiksmīgi!" : "Ne veiksmīgi!";

            $('.linemess').remove();

            const messageBox = `<div class="linemess ${messageType}">
                                    <i class="fas fa-close closemodal" id="mesclose"></i>

                                    <div class="mesinfobox">
                                        <i class="fas ${iconClass}"></i>

                                        <div class="mesinfo">
                                            <h2>${titleText}</h2>
                                            <p>${messageText}</p>
                                        </div>
                                    </div>
                                    <div class="timeline"></div>
                                </div>`;

            $('body').append(messageBox);

            setTimeout(() => {
                $('.linemess').fadeOut(300, function () { $(this).remove(); });
            }, 5000);

            if (response.success) {
                atsaukmesIzvade();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Kļuda pie datu nosūtīšanas:', errorThrown);
            $('.linemess').remove();
            const errorMessage = `<div class="linemess error">
                                    <i class="fas fa-close closemodal" id="mesclose"></i>

                                    <div class="mesinfobox">
                                        <i class="fas fa-close"></i>

                                        <div class="mesinfo">
                                            <h2>Ne veiksmīgi!</h2>
                                            <p>Kļūda sistēmā! Lūdzu, mēģiniet vēlreiz.</p>
                                        </div>
                                    </div>
                                    <div class="timeline"></div>
                                </div>`;
            $('body').append(errorMessage);
            setTimeout(() => {
                $('.linemess').fadeOut(300, function () { $(this).remove(); });
            }, 5000);
        }
    });
});

$(document).ready(function() {

    atsaukmesIzvade();

})

function atsaukmesIzvade() {
    $.ajax({
        type: "POST",
        url: "/database/atsaukmes-izvade.php",
        success: function(response) {
            if ($.trim(response) === "") {
                $("#atsaukmes-container").html("<h2>Neviens sludinajums nav pievienots favoritos!</h2>");
            } else {
                $("#atsaukmes-container").html(response);
            }
        },
        error: function(xhr, status, error) {
            $("#atsaukmes-container").html("<h1>Kļūda: " + xhr + "</h1>");  
        }
    });
}


window.addEventListener('load', function () {
$('#atsakmeDelet').submit(e => {
    e.preventDefault();

    const atID = $('#atID').val();

    const editData = {atID};
    const editUrl = '/database/atsaukmes-delet.php';

    // console.log(editData)

    $.ajax({
        type: 'POST',
        url: editUrl,
        data: editData,
        dataType: 'json',
        success: response => {
            const messageType = response.success ? "success" : "error";
            const messageText = response.success ? response.message : response.error;
            const iconClass = response.success ? "fa-check" : "fa-close";
            const titleText = response.success ? "Veiksmīgi!" : "Ne veiksmīgi!";

            $('.linemess').remove();

            const messageBox = `<div class="linemess ${messageType}">
                                    <i class="fas fa-close closemodal" id="mesclose"></i>

                                    <div class="mesinfobox">
                                        <i class="fas ${iconClass}"></i>

                                        <div class="mesinfo">
                                            <h2>${titleText}</h2>
                                            <p>${messageText}</p>
                                        </div>
                                    </div>
                                    <div class="timeline"></div>
                                </div>`;

            $('body').append(messageBox);

            setTimeout(() => {
                $('.linemess').fadeOut(300, function () { $(this).remove(); });
            }, 5000);

            if (response.success) {
                atsaukmesIzvade();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Kļuda pie datu nosūtīšanas:', errorThrown);
            $('.linemess').remove();
            const errorMessage = `<div class="linemess error">
                                    <i class="fas fa-close closemodal" id="mesclose"></i>

                                    <div class="mesinfobox">
                                        <i class="fas fa-close"></i>

                                        <div class="mesinfo">
                                            <h2>Ne veiksmīgi!</h2>
                                            <p>Kļūda sistēmā! Lūdzu, mēģiniet vēlreiz.</p>
                                        </div>
                                    </div>
                                    <div class="timeline"></div>
                                </div>`;
            $('body').append(errorMessage);
            setTimeout(() => {
                $('.linemess').fadeOut(300, function () { $(this).remove(); });
            }, 5000);
        }
    });
});
});

// ------------------------------------------------------------Favorit add un izvade

$('.favoriti').submit(function (e) {
    e.preventDefault();

    const form = $(this);
    const tb_name = form.find('.tb_name').val();
    const item_id = form.find('.item_id').val();

    const editData = { tb_name, item_id };
    const editUrl = '/database/favorite_add.php';

    $.ajax({
        type: 'POST',
        url: editUrl,
        data: editData,
        dataType: 'json',
        success: response => {
            const messageType = response.success ? "success" : "error";
            const messageText = response.success ? response.message : response.error;
            const iconClass = response.success ? "fa-check" : "fa-close";
            const titleText = response.success ? "Veiksmīgi!" : "Ne veiksmīgi!";

            $('.linemess').remove();

            const messageBox = `<div class="linemess ${messageType}">
                                    <i class="fas fa-close closemodal" id="mesclose"></i>
                                    <div class="mesinfobox">
                                        <i class="fas ${iconClass}"></i>
                                        <div class="mesinfo">
                                            <h2>${titleText}</h2>
                                            <p>${messageText}</p>
                                        </div>
                                    </div>
                                    <div class="timeline"></div>
                                </div>`;

            $('body').append(messageBox);

            setTimeout(() => {
                $('.linemess').fadeOut(300, function () { $(this).remove(); });
            }, 5000);

            if (response.success) {
               
                const starIcon = response.star_icon;
                form.find('.favBtn i').attr('class', starIcon);

                favoritIzvade();  
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Ошибка при отправке данных:', errorThrown);
            $('.linemess').remove();
            const errorMessage = `<div class="linemess error">
                                    <i class="fas fa-close closemodal" id="mesclose"></i>
                                    <div class="mesinfobox">
                                        <i class="fas fa-close"></i>
                                        <div class="mesinfo">
                                            <h2>Ne veiksmīgi!</h2>
                                            <p>Кļūda sistēmā! Lūdzu, mēģiniet vēlreiz.</p>
                                        </div>
                                    </div>
                                    <div class="timeline"></div>
                                </div>`;
            $('body').append(errorMessage);
            setTimeout(() => {
                $('.linemess').fadeOut(300, function () { $(this).remove(); });
            }, 5000);
        }
    });
});

$(document).ready(function() {

    favoritIzvade();

})

function favoritIzvade() {
    $.ajax({
        type: "POST",
        url: "/database/favorit_izvade.php",
        success: function(response) {
            if ($.trim(response) === "") {
                $("#fav-container").html("<h2>Neviens sludinajums nav pievienots favoritos!</h2>");
            } else {
                $("#fav-container").html(response);
            }
        },
        error: function(xhr, status, error) {
            $("#fav-container").html("<h1>Kļūda: " + xhr + "</h1>");  
        }
    });
}



