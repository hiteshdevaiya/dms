<?php

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


function _set_admin_board($board = "2"){
    Cookie::queue("admin_board", $board, (60*24));
}

function _get_admin_board(){
    return Cookie::get('admin_board');
}

function send_email($toData, $subject = "", $message = "", $attachments = array())
{
    $fromData = $fromdata = array(
        'host' => env('MAIL_HOST'),
        'port' => env('MAIL_PORT'),
        'username' => env('MAIL_USERNAME'),
        'password' => env('MAIL_PASSWORD'),
        'from_email' => env('MAIL_FROM_ADDRESS'),
        'from_name' => env('MAIL_FROM_NAME'),
    );

    $mail = new PHPMailer(true);

    try {
        // Specify the SMTP settings.
        $mail->isSMTP();
        $mail->setFrom($fromData['from_email'], $fromData['from_name']);
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $fromdata['host'];                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $fromdata['username'];                    //SMTP username
        $mail->Password   = $fromdata['password'];                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = $fromdata['port'];    

        $mail->addAddress($toData);

        // Specify the content of the message.
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->send();

        return $mail;
    } catch (Exception $e) {
          //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";exit;
    }
}