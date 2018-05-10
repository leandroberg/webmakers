<?php

/* * * * * * * * * * * * * * * * * * * * * *
*                                           *
*    VIRTUEMASTERS - desenvolvimento web    *
*    contato@virtuemasters.com.br           *
*    virtuemasters.com.br                   *
*                                           *
* * * * * * * * * * * * * * * * * * * * * * */

# MESSAGE HEADER
$to = $_POST['to'];
$from = $_POST['from'];
$subject = $_POST['subject'];
$email = $_POST['email'];
$headers = implode ( "\n",array ( "From: $from", "Reply-To: $email", "Subject: $subject","Return-Path:  $from","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=UTF-8" ) );

# BODY CLEANING
unset($_POST['to']);
unset($_POST['from']);
unset($_POST['subject']);

# MESSAGE BODY
$message = "<p>";
foreach($_POST as $key => $value):
	$message .= "<strong>".$key.":</strong> ".$value."<br />";
endforeach;
$message .= "</p>";

# MAIL FUNCTION
/*if(captcha()){*/
    if ( mail ( $to, $subject, $message, $headers, "-r".$from ) ): // "-r".$from this parameter are locaweb restriction
        echo 1;
    else:
        echo 0;
    endif;
/*}else{
    echo '<span style="color:red;">Captcha is not checked!</span>';
}*/

/* Google reCaptcha API verification */
function captcha(){
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => array(
            secret => '6Ld-QCgTAAAAANqh6ig-SQxMzZR4CH9Ek5pkcaIu',
            response => $_POST['g-recaptcha-response']
        )
    ));
    $resp = curl_exec($curl);
    $resp = json_decode($resp);
    curl_close($curl);
    if($resp->success){
        return true;        
    }else{
        return false;
    }
}
		
?>