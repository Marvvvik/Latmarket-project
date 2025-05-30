// ------------------------------------------------------------Registracija

function checkUsernameAvailability() {
    const username = $("#register-username").val();

    if (username.length < 3) return;

    console.log(username)

    $.ajax({
        type: "POST",
        url: "/database/user_check.php",
        data: { username: username },
        dataType: "json",
        success: function(response) {
            if (response.status === "exists") {
                $("#register-username").css("border-bottom", "2px solid red");
            } else if (response.status === "available") {
                $("#register-username").css("border-bottom", "2px solid green");
            }
        },
        error: function(xhr) {
            console.error("Kļūda:", xhr.statusText);
        }
    });
}

$("#register-username").on("input", function () {
    checkUsernameAvailability();
});

$(document).on('click', '.closemodal', function() {
    $(this).closest('.linemess').fadeOut(100, function() {
    $(this).remove();
    });
});

$('#registerForm').submit(e => {
    e.preventDefault();

    const username = $('#register-username').val();
    const rpassword1 = $('#register-password1').val();
    const rpassword2 = $('#register-password2').val();

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
                                    <i class="fas fa-close close-Modal" id="mesclose"></i>
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
                                    <i class="fas fa-close close-Modal" id="mesclose"></i>
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
        url: "/database/setting_ielasa.php", 
        type: "POST",
        data: { id: userId },
        dataType: "json",
        success: function(response) {
            if (response.success) {

                setField("#vards", response.vards);
                setField("#uzvards", response.uzvards);
                setField("#epasts", response.epasts);
                setField("#telefons", response.telefons);

  
                $("#userFullName").text(response.full_name);
                $("#userEmail").text(response.epasts); 
                $(".avatar-img").attr("src", response.avatar);

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

$('#editProfileForm').submit(e => {
    e.preventDefault();

    const editPassActive = $('.password-Chanege-Switcher').hasClass('active');
    const liet_id = $('#lietotajaId').val();
    const vards = $('#vards').val();
    const uzvards = $('#uzvards').val();
    const epasts = $('#epasts').val();
    const telefons = $('#telefons').val();
    const password1 = $('#password1-c').val();
    const password2 = $('#password2-c').val();
    const newavatar = $('#newAvatar')[0].files[0];  

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
    
    const editUrl = '/database/edit_profile.php';

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
                                    <i class="fas fa-close close-Modal" id="mesclose"></i>

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
                                    <i class="fas fa-close close-Modal" id="mesclose"></i>

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


$('#review-form').submit(e => {
    e.preventDefault();

    const stars = $('#review-rating').val();
    const vards = $('#review-user-firstname').val();
    const uzvards = $('#review-user-lastname').val();
    const at_text = $('#review-text').val();
    const lietotaja_id = $('#review-user-id').val();
    const avatar = $('#review-user-avatar').val();  

    
    const formData = new FormData();
    formData.append('vards', vards);
    formData.append('uzvards', uzvards);
    formData.append('stars', stars);
    formData.append('at_text', at_text);
    formData.append('lietotaja_id', lietotaja_id);
    formData.append('atsukmes_avatar', avatar); 
    
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
                                    <i class="fas fa-close close-Modal" id="mesclose"></i>

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
                                    <i class="fas fa-close close-Modal" id="mesclose"></i>

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

function atsaukmesIzvade(page = 1) {
    $.ajax({
        type: "POST",
        url: "/database/atsaukmes_izvade.php",
        data: { page: page },
        dataType: "json",
        success: function(response) {
            if ($.trim(response.comments) === "") {
                $("#review-output-container").html("<h2>Nav nevienas atsaukmes!</h2>");
                $(".review__output_buttons").html("");
            } else {
                $("#review-output-container").html(response.comments);
                AtsaukmesRenderPagination(response.totalPages, page);
            }
        },
        error: function(xhr) {
            $("#review-output-container").html("<h1>Kļūda: " + xhr.statusText + "</h1>");
        }
    });
}

function AtsaukmesRenderPagination(totalPages, currentPage) {
    let html = '';
    let maxButtons = 5;
    let start = Math.max(1, currentPage - 2);
    let end = Math.min(totalPages, start + maxButtons - 1);

    if (end - start < maxButtons - 1) { start = Math.max(1, end - maxButtons + 1); }
    for (let i = start; i <= end; i++) { html += `<button class="page-btn ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</button>`; }
    if (totalPages > end) { html += `<span>...</span><button class="page-btn" data-page="${totalPages}">${totalPages}</button>`;}

    $(".review__output_buttons").html(html);
}

$(document).on("click", ".page-btn", function() {
    const page = $(this).data("page");
    atsaukmesIzvade(page);
});

$(document).ready(function() {
    atsaukmesIzvade(1);
});

$(document).on('submit', '.atsakmeDelet', function(e) {
    e.preventDefault();

    const form = $(this);
    const atID = form.find('#atID').val(); 

    const editData = { atID };
    const editUrl = '/database/atsaukmes_delet.php';

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
                                    <i class="fas fa-close close-Modal" id="mesclose"></i>

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
                form.closest('.deletmodal').removeClass('active'); 
                atsaukmesIzvade();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Kļuda pie datu nosūtīšanas:', errorThrown);
            $('.linemess').remove();
            const errorMessage = `<div class="linemess error">
                                    <i class="fas fa-close close-Modal" id="mesclose"></i>

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

$(document).on('click', '[data-target]', function () {
    const targetSelector = $(this).data('target');
    $(targetSelector).addClass('active');
});

$(document).on('click', '#no', function () {
    $(this).closest('.deletmodal').removeClass('active');
});

$(document).on('click', '#closeRep', function () {
    $(this).closest('.repmodal').removeClass('active');
});

// ------------------------------------------------------------Report-Add

$(document).on('submit', '.reportForm', function(e) {
    e.preventDefault();

    const atsakmes_id = $('#atsakmes_id').val();
    const rep_title = $('#rep_title').val();
    const rep_text = $('#rep_text').val();

    const formData = new FormData();
    formData.append('atsakmes_id', atsakmes_id);
    formData.append('rep_title', rep_title);
    formData.append('rep_text', rep_text);

    const addUrl = '/database/report_add.php';
    
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
                                    <i class="fas fa-close close-Modal" id="mesclose"></i>

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
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Kļuda pie datu nosūtīšanas:', errorThrown);
            $('.linemess').remove();
            const errorMessage = `<div class="linemess error">
                                    <i class="fas fa-close close-Modal" id="mesclose"></i>

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

// ------------------------------------------------------------Favorit add un izvade

$(document).on('submit', '.favoriti', function (e) {
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
                                    <i class="fas fa-close close-Modal" id="mesclose"></i>
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
        error: function () {
            $('.linemess').remove();
            const errorMessage = `<div class="linemess error">
                                    <i class="fas fa-close close-Modal" id="mesclose"></i>
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

$(document).on("click", ".favorite-page-btn", function() {
    const page = $(this).data("page");
    favoritIzvade(page);
});

$(document).ready(function() {
    favoritIzvade(1);
});

function favoritIzvade(page = 1) {
    $.ajax({
        type: "POST",
        url: "/database/favorit_izvade.php",
        data: { page: page },
        dataType: 'json',
        success: function(response) {
            if ($.trim(response.favorite) === "") {
                $("#favorites-container").html("<h2>Nav pievienots neviens favorīts!</h2>");
                $(".favorites-buttons").html("");
            } else {
                $("#favorites-container").html(response.favorite);
                FavoriteRenderPagination(response.totalPages, page);
            }
        },
        error: function(xhr) {
            $("#favorites-container").html("<h1>Kļūda: " + xhr.statusText + "</h1>");
        }
    });
}

function FavoriteRenderPagination(totalPages, currentPage) {
    let html = '';
    let maxButtons = 5;
    let start = Math.max(1, currentPage - 2);
    let end = Math.min(totalPages, start + maxButtons - 1);

    if (end - start < maxButtons - 1) { start = Math.max(1, end - maxButtons + 1); }
    for (let i = start; i <= end; i++) { html += `<button class="favorite-page-btn ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</button>`; }
    if (totalPages > end) { html += `<span>...</span><button class="favorite-page-btn" data-page="${totalPages}">${totalPages}</button>`;}

    $(".favorites-buttons").html(html);
}





