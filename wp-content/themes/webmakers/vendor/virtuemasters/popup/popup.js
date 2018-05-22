jQuery(document).ready(function(){
    
    jQuery.get(ajaxobject.themeurl+'/vendor/virtuemasters/popup/popup.php',function(data){
        jQuery('body').append(data);
        return popup();
    });
    
});

function popup(){
    jQuery('a.popup').bind('click',function(){
        ajaxstatus('loading');
        var popupdata = jQuery(this).attr('data-to-send');
        jQuery('div.popup article').load(jQuery(this).attr('href'),{data:popupdata},function(){
            ajaxstatus('finish');
            jQuery('body').css('overflow','hidden');
            jQuery('div.popup').fadeIn();
            jQuery('div.popup .close').bind('click',function(){
                jQuery('body').css('overflow','initial');
                jQuery('div.popup').fadeOut();
            });
            if(typeof ajaxform !== 'undefined' && jQuery.isFunction(ajaxform)){ajaxform()}
            if(typeof sharepopup !== 'undefined' && jQuery.isFunction(sharepopup)){sharepopup()}
        });
        return false;
    });
}