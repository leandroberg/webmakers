jQuery(document).ready(function(){
    
    /* SLIDESHOW */
    jQuery('#slideshow .slick').slick({
        autoplay:true,
        autoplaySpeed:5000,
        arrows:false,
        fade:true,
        pauseOnHover:false
    });
    
    /* PLACEHOLDER CLEAR */
    function placeholder(){
        jQuery("input,textarea").click(function(){
            text = jQuery(this).attr("placeholder");
            jQuery(this).attr("placeholder", "");
        });
        jQuery("input,textarea").blur(function(){
            if(text!=''){
                jQuery(this).attr("placeholder", text);
                text = "";
            }
        });
    }placeholder();
    
    /* AJAX STATUS */
    function ajaxStatus(status, message){
        jQuery('div.popup').fadeOut();
        jQuery('.ajax-status .fa').removeClass('fa-close fa-check fa-repeat rotating');
        jQuery('.ajax-status p').html('');
        switch(status){
            case 'loading':
                jQuery('.ajax-status .fa').addClass('fa-repeat rotating');
                jQuery('.ajax-status p').html(message);
                jQuery('.ajax-status').fadeIn();
            break;
            case 'sent':
                jQuery('.ajax-status .fa').addClass('fa-check');
                jQuery('.ajax-status p').html(message);
                jQuery('.ajax-status').fadeIn();
            break;
            case 'finish':
                jQuery('.ajax-status').fadeOut();
            break;
            case 'error':
                jQuery('.ajax-status .fa').addClass('fa-close');
                jQuery('.ajax-status p').html(message);
            break;
        }
        jQuery('.ajax-status').bind('click',function(){
            jQuery(this).fadeOut();
        });
    }
    
    /* FORM */
    function ajaxform(){
        $form = jQuery('.ajaxform'); //just set 'ajaxform' class in your form's tag and have fun
        $form.validate();
        $form.submit(function(){
            if($form.valid()){
                jQuery.ajax({
                    type: 'POST',
                    url: templateDirectory + '/includes/submit.php',
                    data: new FormData($form[0]),
                    processData: false,
                    contentType: false,
                    beforeSend: ajaxStatus('loading'),
                    success: function(msg){
                        if(msg==1){
                            ajaxStatus('sent');
                        }else{
                            ajaxStatus('error');
                        }
                        setTimeout(function(){
                            ajaxStatus('finish');
                            $form[0].reset();
                        },7000);
                    }
                });
            }
            return false;
        });
    }ajaxform();
    
    /* CLIENTS - slick */
    jQuery('#clients .slick').slick({
        infinite:false,
        autoplay:false,
        arrows:false,
        adaptiveHeight:true,
        draggable:false
    });
    
    /* CLIENTS - navigation */
    jQuery('#clients nav a').bind('click',function(){
        jQuery('#clients nav a').removeClass('active');
        jQuery(this).addClass('active');
        var slide = jQuery(this).attr('data-slick');
        jQuery('#clients .slick').slick('slickGoTo',slide);
    });
    
});