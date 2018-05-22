jQuery(document).ready(function(){

    jQuery.get(ajaxobject.themeurl+'/vendor/virtuemasters/ajaxstatus/ajaxstatus.php',function(data){
        jQuery('body').append(data);
    });

});

function ajaxstatus(status, message){
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