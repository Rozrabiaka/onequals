jQuery(document).ready(function () {
    var swiper = new Swiper(".swiper-container", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    jQuery('.swiper-button-next').click(function(){
        const distance = jQuery('.swiper-blog').offsetTop - jQuery('.swiper-slide-active').offsetTop - jQuery('.swiper-slide-active').offsetHeight;

        console.log(distance);
        const height = jQuery('.swiper-blog').offset().top - jQuery('.swiper-slide-active').offset().top - jQuery('.swiper-slide-active').outerHeight();
        console.log(height);
    });
});