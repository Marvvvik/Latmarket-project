$(document).ready(function () {
    $("input[type='radio']").change(function() {
        var car_marka = $('input[name="marka"]:checked').val(); 
        var car_benzin_tips = $('input[name="Dzineja"]:checked').val(); 
        var car_atrumkarba = $('input[name="atrumkarba"]:checked').val(); 
        var car_virsbuve = $('input[name="v-tips"]:checked').val(); 
        var car_piedzina = $('input[name="Piedzina"]:checked').val(); 
        var car_tehniska_apskate = $('input[name="Tehniska"]:checked').val(); 
        var car_krasa = $('input[name="Krasa"]:checked').val(); 
        var car_min_cena = $('input[name="car_min_cena"]:checked').val(); 
        var car_max_cena = $('input[name="car_max_cena"]:checked').val(); 
        
        $.ajax({
            type: "POST",
            url: "car-izvade.php", 
            data: { 
                marka: car_marka,
                benzina_tips: car_benzin_tips,
                atrumkarba: car_atrumkarba,
                virsbuve: car_virsbuve,
                piedzina: car_piedzina,
                krasa: car_krasa,
                tehniska_apskate: car_tehniska_apskate,
                min_cena: car_min_cena,
                max_cena: car_max_cena
            },
            success: function(response) {
                $("#cars-container").html(response);
            },
            error: function(xhr, status, error) {
                $("#cars-container").html("Произошла ошибка: " + xhr.responseText);
            }
        });
    });
});
