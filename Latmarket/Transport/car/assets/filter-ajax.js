$(document).on('change', "#Car_brends_select", function () {
    var car_marka = $(this).val(); 

    $.ajax({
        url: 'marka-izvade.php',
        type: 'POST',
        data: { marka: car_marka },
        dataType: 'json', 
        success: function (response) {
            let template = `<option value='' id='name' hidden>Modelis</option>
                            <option value='' id='clear'>-</option>`;

            response.forEach(modelis => {
                template += `<option value='${modelis.modelis}'>${modelis.modelis}</option>`;
            });

            $('#car_modelis_select').html(template);
        },
        error: function () {
            alert("Neizdevās ielasīt datus");
        }
    });

    FilterCarList();
});

$(document).ready(function () {
    const select = $("#car_modelis_select");

    const observer = new MutationObserver(function () {
        if (select.find("option").length > 2) {
            select.removeAttr("disabled");  
        } else {
            select.attr("disabled", "disabled");
        }
    });

    observer.observe(select[0], {
        childList: true  
    });
});

$(document).on('change', 'select', function () {
    const clearOption = this.querySelector('#clear');
    const nameOption = this.querySelector('#name');

    if (clearOption && clearOption.selected) {
        this.value = '';
        clearOption.selected = false;
        if (nameOption) nameOption.selected = true;

        $(this).trigger('change');
    }
});

$(document).ready(function () {
    FilterCarList(1);
});

$(document).on('change', "select, input[type='radio'], input[type='range'], input[type='number']", function () {
    FilterCarList();
});

function FilterCarList(page = 1) {
    $("#carsContainer").html("<div class='loader'>Notiek ielāde...</div>");

    var requestData = { 
        marka: $('#Car_brends_select').val(),
        modelis: $('#car_modelis_select').val(),
        virsbuve: $('#car_virsbuves_select').val(),
        benzina_tips: $('#car_Dzineja_tips_select').val(),
        atrumkarba: $('#car_atrumkarba_select').val(),
        krasa: $('#car_krasa_select').val(),
        piedzina: $('#car_piedzina_select').val(),
        tehniska_apskate: $('#car_tehniska_apskate_select').val(),
        min_cena: $('#car_min_cena_select').val(),
        max_cena: $('#car_max_cena_select').val(),
        min_gads: $('#car_min_gads_select').val(),
        max_gads: $('#car_max_gads_select').val(),
        min_nobrakums: $('#car_min_nobrakums_select').val(),
        max_nobrakums: $('#car_max_nobrakums_select').val(),
        min_jauda: $('#car_min_jauda_select').val(),
        max_jauda: $('#car_max_jauda_select').val(),
        dtp: $('input[name="dtp"]:checked').val(),
        jauda_m: $('input[name="jauda-m"]:checked').val(),
        nobrakums_m: $('input[name="nobrakums-m"]:checked').val(),
        page: page
    };

    $.ajax({
        type: "POST",
        url: "car-izvade.php",
        data: requestData,
        dataType: "json",
        success: function(response) {
            if ($.trim(response.cars) === "") {
                $("#carsContainer").html("<h2>Nav nevienas aktuālas atsaukmes!</h2>");
                $(".offer-buttons").html("");
            } else {
                $("#carsContainer").html(response.cars);
                carRenderPagination(response.totalPages, page);
            }
        },
        error: function(xhr) {
            $("#review-output-container").html("<h1>Kļūda: " + xhr.statusText + "</h1>");
        }
    });
}

function carRenderPagination(totalPages, currentPage) {
    let html = '';
    let maxButtons = 5;
    let start = Math.max(1, currentPage - 2);
    let end = Math.min(totalPages, start + maxButtons - 1);

    if (end - start < maxButtons - 1) { start = Math.max(1, end - maxButtons + 1); }
    for (let i = start; i <= end; i++) { html += `<button class="cars-page-btn ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</button>`; }
    if (totalPages > end) { html += `<span>...</span><button class="cars-page-btn" data-page="${totalPages}">${totalPages}</button>`; }

    $(".offer-buttons").html(html);
}

$(document).on("click", ".cars-page-btn", function() {
    const page = $(this).data("page");
    FilterCarList(page);
});

$(document).on("click", ".photobtn button", function() {
    var carId = $(this).closest('.photobtn').attr('id'); 

    var photosContainer = $(".photos-container[id='" + carId + "']");
    var currentIndex = $(this).index();
    photosContainer.css("transform", "translateX(-" + (currentIndex * 100) + "%)");

    $(".photobtn[id='" + carId + "'] button").removeClass("active");
    $(this).addClass("active");
});
