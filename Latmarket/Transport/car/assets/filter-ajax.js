$(document).on('change', "input[name='marka']", function() {
    var car_marka = $('input[name="marka"]:checked').val();

    $("input[name='modelis']").prop('checked', false);
    $.ajax({
        url: 'marka-izvade.php',
        type: 'POST',
        data: { marka: car_marka },
        dataType: 'json', 
        success: function (response) {
            let template = "";
            response.forEach(modelis => {
                template += `<label>
                    <input type='radio' name='modelis' value='${modelis.modelis}'>
                    <span>${modelis.modelis}</span>
                </label>`;
            });
            $('#model-list-choice').html(template);
        },
        error: function () {
            alert("Neizdevās ielasīt datus");
        }
    });

    
    updateCarList();
});

$(document).on('change', "input[name='modelis'], input[name='marka'], input[type='radio'], input[type='range'], input[type='number']", function() {
   
    updateCarList();
});

function updateCarList() {
    var car_marka = $('input[name="marka"]:checked').val(); 
    var car_modelis = $('input[name="modelis"]:checked').val(); 
    var car_benzin_tips = $('input[name="Dzineja"]:checked').val(); 
    var car_atrumkarba = $('input[name="atrumkarba"]:checked').val(); 
    var car_virsbuve = $('input[name="v-tips"]:checked').val(); 
    var car_piedzina = $('input[name="Piedzina"]:checked').val(); 
    var car_tehniska_apskate = $('input[name="Tehniska"]:checked').val(); 
    var car_krasa = $('input[name="Krasa"]:checked').val(); 
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
        benzina_tips: car_benzin_tips,
        atrumkarba: car_atrumkarba,
        virsbuve: car_virsbuve,
        piedzina: car_piedzina,
        krasa: car_krasa,
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
