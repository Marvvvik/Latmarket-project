//---------------------------------------------------------------------------Izvade filtracija 

$(document).on('change', "#filter-brand", function () {
    var car_marka = $(this).val(); 

    $.ajax({
        url: 'database/model-izvade.php',
        type: 'POST',
        data: { marka: car_marka },
        dataType: 'json', 
        success: function (response) {
            let template = `<option value='' id='name' hidden>Modelis</option>
                            <option value='' id='clear'>-</option>`;

            response.forEach(modelis => {
                template += `<option value='${modelis.modelis}'>${modelis.modelis}</option>`;
            });

            $('#filter-model').html(template);
        },
        error: function () {
            console.log("Neizdevās ielasīt datus");
        }
    });

    FilterCarList();
});

$(document).ready(function () {
    const select = $("#filter-model");

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

//---------------------------------------------------------------------------Izvade filtracija 


$(document).ready(function () {
    FilterCarList(1);
});

$(document).on('change', "select, input[type='radio'], input[type='range'], input[type='number']", function () {
    FilterCarList();
});

function FilterCarList(page = 1) {
    $("#carsContainer").html("<div class='loader-container'><span class='loader'></span><div class='loader-text'>Notiek ielāde...</div></div>");

    var requestData = { 
        marka: $('#filter-brand').val(),
        modelis: $('#filter-model').val(),
        virsbuve: $('#filter-body').val(),
        benzina_tips: $('#filter-engine').val(),
        atrumkarba: $('#filter-gearbox').val(),
        krasa: $('#filter-color').val(),
        piedzina: $('#filter-drive').val(),
        tehniska_apskate: $('#filter-tech').val(),
        asc_filter: $('#filter-asc').val(),
        min_cena: $('#filter-Price-Min').val(),
        max_cena: $('#filter-Price-Max').val(),
        min_gads: $('#filter-Gads-Min').val(),
        max_gads: $('#filter-Gads-Max').val(),
        min_nobrakums: $('#filter-Nob-Min').val(),
        max_nobrakums: $('#filter-Nob-Max').val(),
        min_jauda: $('#car_min_jauda_select').val(),
        max_jauda: $('#car_max_jauda_select').val(),
        dtp: $('input[name="dtp"]:checked').val(),
        jauda_m: $('input[name="jauda-m"]:checked').val(),
        nobrakums_m: $('input[name="nobrakums-m"]:checked').val(),
        page: page
    };

    console.log("Отправляемые данные:", requestData);

    $.ajax({
        type: "POST",
        url: "database/car-izvade.php",
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

