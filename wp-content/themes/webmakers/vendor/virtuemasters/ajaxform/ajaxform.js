jQuery(document).ready(function(){

    ajaxform();

});

/* AJAX FORM */
function ajaxform(){
    formvalidate();
    placeholder();
    $form = jQuery('.ajaxform'); //just set 'ajaxform' class in your form's tag and have fun
    $form.submit(function(){
        $this = jQuery(this);
        if($this.valid()){
            jQuery.ajax({
                type: 'POST',
                url: ajaxobject.themeurl+'/vendor/virtuemasters/ajaxform/ajaxform.php',
                data: new FormData($this[0]),
                processData: false,
                contentType: false,
                beforeSend: ajaxstatus('loading'),
                success: function(msg){
                    if(msg==1){
                        ajaxstatus('sent',jQuery('input[name=success]',$this).val());
                    }else{
                        ajaxstatus('error',jQuery('input[name=error]',$this).val());
                    }
                    setTimeout(function(){
                        ajaxstatus('finish');
                        $this[0].reset();
                    },7000);
                }
            });
        }
        return false;
    });
}

/* FORM VALIDATE */
function formvalidate(){
    jQuery('.validate').each(function(){
        jQuery(this).validate();
    });
}

/* PLACEHOLDER */
function placeholder(){
    var text;
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
}