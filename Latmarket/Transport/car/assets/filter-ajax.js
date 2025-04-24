$(document).on('change', "#Car_brends_select", function() {
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

    updateCarList();
});


$(document).on('change', "select, input[type='radio'], input[type='range'], input[type='number']", function() {
    updateCarList();
});

function updateCarList() {
    var car_marka = $('#Car_brends_select').val(); 
    var car_modelis = $('#car_modelis_select').val(); 
    var car_virsbuve = $('#car_virsbuves_select').val(); 
    var car_benzin_tips = $('#car_Dzineja_tips_select').val(); 
    var car_atrumkarba = $('#car_atrumkarba_select').val(); 
    var car_krasa = $('#car_krasa_select').val(); 
    var car_piedzina = $('#car_piedzina_select').val(); 
    var car_tehniska_apskate = $('#car_tehniska_apskate_select').val(); 
    var car_min_cena = $('#car_min_cena_select').val(); 
    var car_max_cena = $('#car_max_cena_select').val(); 
    var car_min_gads = $('#car_min_gads_select').val(); 
    var car_max_gads = $('#car_max_gads_select').val(); 
    var car_min_nobrakums = $('#car_min_nobrakums_select').val(); 
    var car_max_nobrakums = $('#car_max_nobrakums_select').val(); 
    var car_min_jauda = $('#car_min_jauda_select').val(); 
    var car_max_jauda = $('#car_max_jauda_select').val(); 
    var dtp = $('input[name="dtp"]:checked').val();  
    var jauda_m = $('input[name="jauda-m"]:checked').val(); 
    var nobrakums_m = $('input[name="nobrakums-m"]:checked').val();

    var requestData = { 
        marka: car_marka,
        modelis: car_modelis,
        virsbuve: car_virsbuve,
        benzina_tips: car_benzin_tips,
        atrumkarba: car_atrumkarba,
        krasa: car_krasa,
        piedzina: car_piedzina,
        tehniska_apskate: car_tehniska_apskate,
        min_cena: car_min_cena,
        max_cena: car_max_cena,
        min_gads: car_min_gads,
        max_gads: car_max_gads, 
        min_nobrakums: car_min_nobrakums,
        max_nobrakums: car_max_nobrakums,
        min_jauda: car_min_jauda,
        max_jauda: car_max_jauda,
        dtp: dtp,
        jauda_m: jauda_m,
        nobrakums_m: nobrakums_m
    };

    // console.log("Отправляемые данные на сервер:", requestData);

    $.ajax({
        type: "POST",
        url: "car-izvade.php", 
        data: requestData,
        success: function(response) {
            $("#cars-container").html(response);
        },
        error: function(xhr, status, error) {
            $("#cars-container").html("Kļuda: " + xhr.responseText);
        }
    });
}
