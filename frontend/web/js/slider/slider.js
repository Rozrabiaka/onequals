jQuery(document).ready(function () {
    var swiper = new Swiper(".swiper-container", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
    heightSlider();
    swiper.on('slideChangeTransitionStart', function () {
        heightSlider();
    });

    function heightSlider() {
        const height = jQuery('.swiper-blog').offset().top - jQuery('.swiper-slide-active').offset().top - jQuery('.swiper-slide-active').outerHeight();
        const heightBlock = jQuery('.swiper-slide-active').height();
        jQuery('.swiper-blog').css('top', heightBlock + 150);
        console.log(heightBlock);

        //jQuery('.swiper-block').css('padding-bottom', 410);
    }
});