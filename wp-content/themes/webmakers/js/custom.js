jQuery(document).ready(function(){
    
    /* SLIDESHOW */
    jQuery("#slideshow .slick").slick({
        autoplay:true,
        autoplaySpeed:5000,
        arrows:false,
        fade:true,
        pauseOnHover:false
    });
    
    /* CLIENTS - slick */
    jQuery("#clients .slick").slick({
        infinite:false,
        autoplay:false,
        arrows:false,
        adaptiveHeight:true,
        draggable:false
    });
    
    /* CLIENTS - navigation */
    jQuery("#clients nav a").bind("click",function(){
        jQuery("#clients nav a").removeClass("active");
        jQuery(this).addClass("active");
        var slide = jQuery(this).attr("data-slick");
        jQuery("#clients .slick").slick("slickGoTo",slide);
    });
    
});