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

document.addEventListener('DOMContentLoaded', function () {
    
    const selects = document.querySelectorAll('select');

    selects.forEach(select => {
        const nameOption = select.querySelector('#name');  
        const clearOption = select.querySelector('#clear'); 

        select.addEventListener('change', function () {
            if (clearOption.selected) {
               
                select.value = '';  
                clearOption.selected = false;  
                nameOption.selected = true; 
            }
        });
    });
});

$(document).ready(function() {
    $(".photobtn button").click(function() {
        var carId = $(this).closest('.photobtn').attr('id'); 

        var photosContainer = $(".photos-container[id='" + carId + "']");
        var currentIndex = $(this).index();
        photosContainer.css("transform", "translateX(-" + (currentIndex * 100) + "%)");

        $(".photobtn[id='" + carId + "'] button").removeClass("active");
        $(this).addClass("active");
    });
});
