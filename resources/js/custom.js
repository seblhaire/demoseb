$(document).ready(function(){
    if ($( window ).width() > 767){
        jQuery(window).scroll(function () {
            if ($(this).scrollTop() > 45) {
              jQuery('#back-to-top').fadeIn();
            } else {
               jQuery('#back-to-top').fadeOut();
            }
        });
    }else{
        jQuery(window).scroll(function () {
            if ($(this).scrollTop() > 45) {
                jQuery('#back-to-top').fadeIn();
            } else {
                jQuery('#back-to-top').fadeOut();
            }
        });
    }
       // scroll body to 0px on click
    jQuery('#back-to-top').click(function () {
        jQuery('#back-to-top').tooltip('hide');
        jQuery('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });
});
