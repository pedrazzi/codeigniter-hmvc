<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('email')) {

    function email($d) {
        $from = $d['from'];
        $to = $d['to'];
        $CI = & get_instance();
        $CI->load->library('email/PHPMailer');
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->IsHTML(true);
        $mail->From = $from['e'];
        $mail->FromName = $from['n'];
        $mail->AddAddress($to['e'], $to['n']);
        $mail->Subject = $d['sub'];
        $mail->Body = $d['msg'];
        $mail->WordWrap = 50;
        if(!$mail->send()) {
            return $mail->ErrorInfo;
        }    
    }

}

if (!function_exists('check_mail')) {
    function check_mail($mail){
          $hosts = array(
            '@hotmail.com',
            '@live.com',
            '@gmail.com',
            '@outlook.com',
            '@globo.com',
            '@yahoo.com',
            '@icloud.com',
            '@yahoo.com.br',
            '@uol.com.br',
            '@ig.com.br',
            '@terra.com.br',
            '@bol.com.br',
            '@oi.com.br',
            '@telefonica.com'
        );
        $status = false;
        foreach ($hosts as $r) {
            if (strpos($mail, $r) > 0) { 
              $status = true; 
            }
        }
        return $status;
    }
}