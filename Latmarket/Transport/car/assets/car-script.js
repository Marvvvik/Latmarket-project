document.querySelectorAll('.filter-box').forEach(filterBox => {
    const rangeInput = filterBox.querySelectorAll('.range-input input');
    const priceInput = filterBox.querySelectorAll('.price-input input');
    const progress = filterBox.querySelector('.range-slider .progress');

    let priceGap = parseInt(filterBox.dataset.gap) || 500; // Считываем gap для текущего фильтра

    priceInput.forEach(input => {
        input.addEventListener('input', e => {
            let minVal = parseInt(priceInput[0].value),
                maxVal = parseInt(priceInput[1].value);
            
            let minRange = parseInt(rangeInput[0].min);
            let maxRange = parseInt(rangeInput[1].max);

            if (maxVal - minVal >= priceGap && maxVal <= maxRange && minVal >= minRange) {
                if (e.target.classList.contains("input-min")) {
                    rangeInput[0].value = minVal;
                    progress.style.left = ((minVal - minRange) / (maxRange - minRange)) * 100 + "%";
                } else {
                    rangeInput[1].value = maxVal;
                    progress.style.right = 100 - ((maxVal - minRange) / (maxRange - minRange)) * 100 + "%";
                }
            }
        });
    });

    rangeInput.forEach(input => {
        input.addEventListener('input', e => {
            let minVal = parseInt(rangeInput[0].value),
                maxVal = parseInt(rangeInput[1].value);
            
            let minRange = parseInt(rangeInput[0].min);
            let maxRange = parseInt(rangeInput[1].max);

            if (maxVal - minVal < priceGap) {
                if (e.target.classList.contains("range-min")) {
                    rangeInput[0].value = maxVal - priceGap;
                } else {
                    rangeInput[1].value = minVal + priceGap;
                }
            } else {
                priceInput[0].value = minVal;
                priceInput[1].value = maxVal;
                progress.style.left = ((minVal - minRange) / (maxRange - minRange)) * 100 + "%";
                progress.style.right = 100 - ((maxVal - minRange) / (maxRange - minRange)) * 100 + "%";
            }
        });
    });
});


$(document).ready(function () {
    $("input[name='marka']").on("change", function () {
        if ($("input[name='marka']:checked").length > 0) {
            $("#model-select").removeClass("deactive");
        }
    });
});