<?php
define('BEZ_MAIL_TO','Office <private-information@oleg.com>');
define('private','information <@oleg.com>');

function sendMail($to, $from, $title, $message)
{
    $subject = $title;
    $subject = '=?utf-8?b?'. base64_encode($subject) .'?=';

  
    $headers = "Content-type: text/html; charset=\"utf-8\"\r\n";
    $headers .= "From: ". $from ."\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Date: ". date('D, d M Y h:i:s O') ."\r\n";

    if(!mail($to, $subject, $message, $headers))
        return 'Ошибка отправки письма!';
    else
        return true;
}

if(isset($_POST['email']))
{

    $resp = array();

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $resp['err'][] = 'Не верный Email';
    }
    $text = $_POST ['name'];
    $pattern = '/(8|7|\+7)?9\d{9}/';

    if(!preg_match($pattern, $_POST['mobile'])){
        $resp['err'][] = 'Не верный мобильный телефон';
    }
    $title = 'Ура, нам письмо пришло!';

    $msg  = 'Мобильный телефон <strong>'. $_POST['mobile'].'</strong><br />';
    $msg .= 'E-mail отправителя <strong>'. $_POST['email'].'</strong><br />';
    $msg .= nl2br($_POST['text']);

    if(!empty($resp['err']))
    {

        $resp['status'] = 0;
        echo json_encode($resp);
    }
    else
    {
  
        if(sendMail(BEZ_MAIL_TO, BEZ_MAIL_AUTOR, $title, $msg, $mail))
        {
            $resp['ok'] = 'Письмо отправленно...';
            $resp['status'] = 1;
            echo json_encode($resp);
        }
    }
}
    ?>
