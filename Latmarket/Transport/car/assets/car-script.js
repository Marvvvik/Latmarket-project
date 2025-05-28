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
