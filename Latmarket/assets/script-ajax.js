$('#registerForm').submit(e => {
    e.preventDefault();

    const username = $('#username').val();
    const rpassword1 = $('#rpassword1').val();
    const rpassword2 = $('#rpassword2').val();

    $('.regmes').html('');

    if (!username || !rpassword1 || !rpassword2) {
        $('.regmes').html('<div class="notif-slide-red">Visi lauki nav aizpilditi!</div>');
        return;
    }

    const postData = { username, rpassword1, rpassword2 };
    const url = 'database/register.php';

    $.ajax({
        type: 'POST',
        url: url,
        data: postData,
        dataType: 'json',
        success: response => {
            console.log('Ответ от сервера:', response);
    
            if (response.success) {
              
                $('.linemess').remove(); 

                const successMessage = `<div class="linemess">
    
                                            <i class="fas fa-close closemodal" id="mesclose"data-target="#Log-reg-modal"></i>

                                            <p>${response.message}</p>

                                            <div class="timeline"></div>

                                        </div>`;
                $('body').append(successMessage);
    
                setTimeout(() => {
                    $('.linemess').fadeOut(300, () => $(this).remove());
                }, 5000);
    
            } else {
                const errorMessage = `${response.error}`;
                $('.regmes').html(errorMessage);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Ошибка при отправке данных:', errorThrown);
            const errorMessage = `<div class="notif-slide-red">Kļūda sistēmā! Lūdzu, mēģiniet vēlreiz.</div>`;
            $('.regmes').html(errorMessage);
        }
    });
});

// ------------------------------------------------------------Datu ielase Settingos 

$(document).ready(function() {
    var userId = $("#lietotajaId").val();

    $.ajax({
        url: "database/setting-ielasa.php", 
        type: "POST",
        data: { id: userId },
        dataType: "json",
        success: function(response) {
            if (response.success) {
                setField("#vards", response.vards);
                setField("#uzvards", response.uzvards);
                setField("#epasts", response.epasts);
                setField("#telefons", response.telefons);
            } else {
                alert("Kluda datu ielase.");
            }
        },
        error: function() {
            alert("Ошибка запроса к серверу.");
        }
    });

    function setField(selector, value) {
        if (value === "Unknown") {
            $(selector).attr("placeholder", "Unknown").val("");
        } else {
            $(selector).val(value);
        }
    }
});


// ------------------------------------------------------------Datu edit Settingos 



$('#editForm').submit(e => {
    e.preventDefault();

    const liet_id = $('#lietotajaId').val();
    const vards = $('#vards').val();
    const uzvards = $('#uzvards').val();
    const epasts = $('#epasts').val();
    const telefons = $('#telefons').val();

    const editData = { liet_id, vards, uzvards, epasts, telefons};
    const editUrl = 'database/edit-profile.php';

    $.ajax({
        type: 'POST',
        url: editUrl,
        data: editData,
        dataType: 'json',
        success: response => {
            console.log('Ответ от сервера:', response);
    
            if (response.success) {
              
                $('.linemess').remove(); 

                const successMessage = `<div class="linemess">
    
                                            <i class="fas fa-close closemodal" id="mesclose"data-target="#Log-reg-modal"></i>

                                            <p>${response.message}</p>

                                            <div class="timeline"></div>

                                        </div>`;
                $('body').append(successMessage);
    
                setTimeout(() => {
                    $('.linemess').fadeOut(300, () => $(this).remove());
                }, 5000);
    
            } else {
                const errorMessage = `${response.error}`;
                $('.regmes').html(errorMessage);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Ошибка при отправке данных:', errorThrown);
            const errorMessage = `<div class="notif-slide-red">Kļūda sistēmā! Lūdzu, mēģiniet vēlreiz.</div>`;
            $('.regmes').html(errorMessage);
        }
    });
});