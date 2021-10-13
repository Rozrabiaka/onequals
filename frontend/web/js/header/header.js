jQuery(document).ready(function () {
    jQuery('.header-nav').click(function(){
        jQuery('.modalMenu').show();
        jQuery("body").css({"overflow":"hidden"});
    })


    jQuery('.close-model-menu').click(function(){
        jQuery('.modalMenu').hide();
        jQuery("body").css({"overflow":"visible"});
    })
});