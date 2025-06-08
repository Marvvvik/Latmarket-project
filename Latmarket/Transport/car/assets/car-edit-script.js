document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll('input[type="checkbox"][id^="feature-"]');

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const label = document.querySelector(`label[for="${checkbox.id}"]`);
            if (label) {
                if (checkbox.checked) {
                    label.classList.add('active');
                } else {
                    label.classList.remove('active');
                }
            }
        });
    });
});


const maxChars = 5000;

function handleInput() {
    const editableDiv = document.getElementById("car-description-Edit");
    const placeholder = document.getElementById("placeholder");
    const counter = document.getElementById("char-count");

    let text = editableDiv.innerText || editableDiv.textContent;
    const trimmedText = text.trim();

    if (trimmedText.length > maxChars) {
        const selection = window.getSelection();
        const range = document.createRange();

        editableDiv.innerText = trimmedText.slice(0, maxChars);

        range.selectNodeContents(editableDiv);
        range.collapse(false);
        selection.removeAllRanges();
        selection.addRange(range);
    }

    const currentLength = trimmedText.length;
    counter.textContent = `${currentLength} / ${maxChars}`;
    counter.style.color = currentLength >= maxChars ? "red" : "black";

    placeholder.style.display = currentLength === 0 ? "block" : "none";
}

document.addEventListener("DOMContentLoaded", handleInput);

function toggleFormat(command) {
    document.execCommand(command);
}

function toggleHeading(tag) {
    const selection = window.getSelection();
    if (!selection.rangeCount) return;

    const range = selection.getRangeAt(0);
    let parent = range.commonAncestorContainer;

    while (parent && parent.nodeType !== 1) {
        parent = parent.parentNode;
    }

    if (parent && parent.tagName && parent.tagName.toLowerCase() === tag.toLowerCase()) {
        document.execCommand('formatBlock', false, 'p');
    } else {
        document.execCommand('formatBlock', false, `<${tag}>`);
    }
}

$(document).ready(function() {
    let carModels = {};

    $.ajax({
        url: '/Transport/car/assets/brands_models.json',
        dataType: 'text',
        success: function(data) {
            try {
                carModels = JSON.parse(data);

                const $marka = $('#markaSelectEdit');
                const $model = $('#modelSelectEdit');

                $marka.on('change', function() {
                    const selectedMarka = $(this).val();

                    if (!selectedMarka || !carModels[selectedMarka]) {
                        $model.prop('disabled', true).empty();
                        $model.append('<option value="" disabled selected hidden>Izvēlieties marku vispirms</option>');
                        return;
                    }

                    $model.prop('disabled', false).empty();
                    $model.empty();

                    carModels[selectedMarka].forEach(function(model) {
                        $model.append(`<option value="${model}">${model}</option>`);
                    });

                    $model.append('<option value="Cits modelis">Cits modelis</option>');
                });
            } catch (e) {
                console.error('Ошибка при парсинге JSON:', e);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Ошибка загрузки файла brands_models.json:', textStatus, errorThrown);
        }
    });
});

//---------------------------------------------------------------------------car edit 

$('#editCar').submit(e => {
    e.preventDefault();

    const marka = $('#markaSelectEdit').val();
    const modelis = $('#modelSelectEdit').val();
    const gads = $('#gadsInputEdit').val();
    const virsBuve = $('#virsSelectEdit').val();
    const tilpums = $('#tilInputEdit').val();
    const jauda = $('#jauInputEdit').val();
    const atrumkarba = $('#atrumSelectEdit').val();
    const degviela = $('#degSelectEdit').val();
    const piedzina = $('#piedzSelectEdit').val();
    const nobraukums = $('#nobInputEdit').val();
    const krasa = $('#krasSelectEdit').val();
    const apskate = $('#apskateInputEdit').val();
    const Car = $('#CarInputEdint').val();

    const carDescription = $('#car-description-Edit').html();

    const selectedFeatures = [];
    const checkboxes = $('input[type="checkbox"]:checked');

    checkboxes.each(function() {
        selectedFeatures.push($(this).val());
    });

    const pilseta = $('#pilsetaSelectEdit').val();
    const vin = $('#winInput').val();
    const cena = $('#cenaInput').val();

    const formData = new FormData();
    formData.append('marka', marka);
    formData.append('modelis', modelis);
    formData.append('gads', gads);
    formData.append('virsBuve', virsBuve);
    formData.append('tilpums', tilpums);
    formData.append('jauda', jauda);
    formData.append('atrumkarba', atrumkarba);
    formData.append('degviela', degviela);
    formData.append('piedzina', piedzina);
    formData.append('nobraukums', nobraukums);
    formData.append('krasa', krasa);
    formData.append('apskate', apskate);
    formData.append('Car', Car);

    formData.append('apraksts', carDescription);

    formData.append('komplektacijas', JSON.stringify(selectedFeatures));

    formData.append('pilseta', pilseta);
    formData.append('vin', vin);
    formData.append('cena', cena);

    const photos = $('#car-photos')[0].files;
    for (let i = 0; i < photos.length; i++) {
        formData.append('photos[]', photos[i]);
    }

    console.log('Данные FormData перед отправкой:');
    for (const pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }

    const addUrl = 'database/car_edit_db.php';

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


$(document).ready(function () {
    let currentSlide = 0;
    let isAnimating = false;
    const $sliderContainer = $('.car-slider'); 

    function setupSlideStyles($container) {
        const $slides = $container.find('.slide-item img.preview');

        $slides.css({ left: '100%', display: 'none' });

        if ($slides.length > 0) {
            $slides.eq(0).css({ left: 0, display: 'block' });
            currentSlide = 0; 
        } else {
            currentSlide = 0; 
        }
        isAnimating = false; 
    }

    function slideTo(index, direction) {
        const $slides = $sliderContainer.find('.slide-item img.preview'); 
        if (isAnimating || index === currentSlide || $slides.length <= 1) return; 

        isAnimating = true;

        const $current = $slides.eq(currentSlide);
        const $next = $slides.eq(index);

        $next.css({
            display: 'block',
            left: (direction === 'left' ? '-100%' : '100%')
        });

        $current.animate({ left: (direction === 'left' ? '100%' : '-100%') }, 400);
        $next.animate({ left: '0%' }, 400, function () {
            $current.css('display', 'none');
            currentSlide = index;
            isAnimating = false;
        });
    }

    setupSlideStyles($sliderContainer);

    $sliderContainer.on('click', '.slider-left', function () {
        const $slides = $sliderContainer.find('.slide-item img.preview');
        if ($slides.length === 0) return;
        const nextIndex = (currentSlide - 1 + $slides.length) % $slides.length;
        slideTo(nextIndex, 'left');
    });

    $sliderContainer.on('click', '.slider-right', function () {
        const $slides = $sliderContainer.find('.slide-item img.preview');
        if ($slides.length === 0) return; 
        const nextIndex = (currentSlide + 1) % $slides.length;
        slideTo(nextIndex, 'right');
    });

    let scrollTimeout;
    $sliderContainer.on('wheel', function (e) {
        if (isAnimating) return;
        e.preventDefault();

        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
            const $slides = $sliderContainer.find('.slide-item img.preview');
            if ($slides.length === 0) return; 
            let nextIndex;
            if (e.originalEvent.deltaY < 0) { 
                nextIndex = (currentSlide - 1 + $slides.length) % $slides.length;
                slideTo(nextIndex, 'left');
            } else if (e.originalEvent.deltaY > 0) {
                nextIndex = (currentSlide + 1) % $slides.length;
                slideTo(nextIndex, 'right');
            }
        }, 50);
    });

    $('#car-photos').on('change', function (e) {
        const files = e.target.files;

        if (files.length > 25) {
            alert('Var izvēlēties ne vairāk par 25 foto!'); 
            $(this).val(''); 
            return;
        }

        $sliderContainer.find('.slide-item').remove();

        let filesProcessed = 0; 

        if (files.length === 0) {
            setupSlideStyles($sliderContainer);
            return;
        }

        $.each(files, function (i, file) {
            if (!file.type.startsWith('image/')) {
                filesProcessed++;
                if (filesProcessed === files.length) {
                    setTimeout(() => setupSlideStyles($sliderContainer), 50);
                }
                return;
            }

            const reader = new FileReader();
            reader.onload = function (event) {
                const $imgWrapper = $('<div>', { class: 'slide-item' });
                const $img = $('<img>', {
                    src: event.target.result,
                    class: 'preview'
                });
                const $removeBtn = $('<button>', {
                    type: 'button',
                    class: 'remove-btn',
                    title: 'Dzēst foto',
                    html: '<i class="fas fa-trash-alt"></i>'
                });

                $removeBtn.on('click', function () {
                    $(this).closest('.slide-item').remove(); 
                    setupSlideStyles($sliderContainer);
                });

                $imgWrapper.append($img).append($removeBtn);
                $sliderContainer.append($imgWrapper);

                filesProcessed++;
                if (filesProcessed === files.length) {
                    setTimeout(() => setupSlideStyles($sliderContainer), 50);
                }
            };
            reader.readAsDataURL(file);
        });
    });

    $sliderContainer.on('click', '.remove-btn', function () {
        $(this).closest('.slide-item').remove();
        setupSlideStyles($sliderContainer);
    });
});
