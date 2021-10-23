jQuery(document).ready(function () {
    var btn = jQuery('.footer-button-scroll');
    jQuery(window).scroll(function() {
        if (jQuery(window).scrollTop() > 300) {
            btn.addClass('show');
        } else {
            btn.removeClass('show');
        }
    });
    btn.on('click', function(e) {
        e.preventDefault();
        jQuery('html, body').animate({scrollTop:0}, '300');
    });
});