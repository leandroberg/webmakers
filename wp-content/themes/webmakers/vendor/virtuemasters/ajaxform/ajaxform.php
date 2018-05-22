<?php

# POSTDATA
$to = $_POST['to'];
$from = $_POST['from'];
$subject = $_POST['subject'];
$reply = $_POST['email'];
$headers = implode ( "\n",array ( "From: $from", "Reply-To: $reply", "Subject: $subject","Return-Path:  $from","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=UTF-8" ) );

# BODY CLEANING
unset($_POST['to']);
unset($_POST['from']);
unset($_POST['subject']);
unset($_POST['success']);
unset($_POST['error']);

# MESSAGE BODY
$message = '';
foreach($_POST as $key => $value):
    $message .= "<strong>".$key.":</strong> ".$value."<br />";
endforeach;

# FILES
if($_FILES):
    foreach($_FILES as $key => $value):
        $message .= "<strong>".$key.":</strong> ".uploadfile($value);
    endforeach;
endif;

# MAIL FUNCTION
if ( mail( $to, $subject, $message, $headers, "-r".$from ) ): // "-r".$from this parameter are locaweb restriction
    echo 1;
else:
    echo 0;
endif;

/**
 * Upload File
 * 
 * @param array $file
 * @return string $file
 */
function uploadfile($file){
    require('../../../../../../wp-config.php');
    $target_dir = ABSPATH . "wp-content/uploads/";
    $extension = explode('.',$file['name']);
    $filename = date('d-m-Y-h-i-s') . '.' . $extension[1];
    $target_file = $target_dir . basename($filename);
    if (!move_uploaded_file($file['tmp_name'], $target_file)) {
        $file = false;
    }else{
        $file = get_bloginfo('home') . '/wp-content/uploads/' . $filename;
    }    
    return $file;
}