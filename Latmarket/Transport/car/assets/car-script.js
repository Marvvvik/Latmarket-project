$(document).ready(function () {
    function initSlider($container) {
        let $slider = $container.hasClass('slide-show-rewiev') ? $container.find('.slider-main') : $container;
        let $slides = $slider.find('img');

        let currentSlide = 0;
        let isAnimating = false;

        $slides.css({ left: '100%', display: 'none' });
        $slides.eq(currentSlide).css({ left: 0, display: 'block' });

        function slideTo(index, direction) {
            if (isAnimating || index === currentSlide) return;
            isAnimating = true;

            let $current = $slides.eq(currentSlide);
            let $next = $slides.eq(index);

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

        $container.find('.slide-btn.left').click(function () {
            let nextIndex = (currentSlide - 1 + $slides.length) % $slides.length;
            slideTo(nextIndex, 'left');
        });

        $container.find('.slide-btn.right').click(function () {
            let nextIndex = (currentSlide + 1) % $slides.length;
            slideTo(nextIndex, 'right');
        });

        let scrollTimeout;
        $container.on('wheel', function (e) {
            if (isAnimating) return;
            e.preventDefault();

            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
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
    }

    $('.slide-show, .slide-show-rewiev').each(function () {
        initSlider($(this));
    });

    const $slideShow = $('.slide-show');
    const $slideShowReview = $('.slide-show-rewiev');
    const $closeSliderButton = $('#closeSlider');

    $slideShow.on('click', 'img', function () {
        $slideShowReview.addClass('active');
        $('body').addClass('no-scroll');
    });

    $closeSliderButton.on('click', function () {
        $slideShowReview.removeClass('active');
        $('body').removeClass('no-scroll');
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const reportButton = document.getElementById('ReportButton');
    const reportModal = document.getElementById('ReportModal');
    const closeReportButton = document.getElementById('closeReport');

    reportButton.addEventListener('click', () => {
        reportModal.classList.add('active');
    });

    closeReportButton.addEventListener('click', () => {
        reportModal.classList.remove('active');
    });
});


$(document).on('submit', '#sludRepForm', function(e) {
    e.preventDefault();

    const $form = $(this); 

    const Sludinajums = $form.find('#Sludinajums').val();
    const rep_title = $form.find('#adv_rep_title').val();
    const rep_text = $form.find('#reportText').val();
    const SludinajumsKategori = $form.find('#SludinajumsKategori').val();

    const formData = new FormData();
    formData.append('Sludinajums', Sludinajums);
    formData.append('rep_title', rep_title);
    formData.append('rep_text', rep_text);
    formData.append('SludinajumsKategori', SludinajumsKategori);

    console.log('Данные FormData перед отправкой:');
    for (const pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }

    const addUrl = '/database/report_sludinajums_add.php';

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

            const messageBox = $(`
                <div class="linemess ${messageType}">
                    <i class="fas fa-close close-Modal" id="mesclose"></i>
                    <div class="mesinfobox">
                        <i class="fas ${iconClass}"></i>
                        <div class="mesinfo">
                            <h2>${titleText}</h2>
                            <p>${messageText}</p>
                        </div>
                    </div>
                    <div class="timeline"></div>
                </div>
            `);

            $('body').append(messageBox);

            setTimeout(() => {
                $('.linemess').fadeOut(300, function () { $(this).remove(); });
            }, 5000);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Kļuda pie datu nosūtīšanas:', errorThrown);
            $('.linemess').remove();

            const errorMessage = $(`
                <div class="linemess error">
                    <i class="fas fa-close close-Modal" id="mesclose"></i>
                    <div class="mesinfobox">
                        <i class="fas fa-close"></i>
                        <div class="mesinfo">
                            <h2>Ne veiksmīgi!</h2>
                            <p>Kļūda sistēmā! Lūdzu, mēģiniet vēlreiz.</p>
                        </div>
                    </div>
                    <div class="timeline"></div>
                </div>
            `);

            $('body').append(errorMessage);
            setTimeout(() => {
                $('.linemess').fadeOut(300, function () { $(this).remove(); });
            }, 5000);
        }
    });
});
