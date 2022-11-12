<?php
define('BEZ_MAIL_TO','Office <olegetm@mail.ru>');

//Адрес почты от кого отправляем
define('mail.f0678609.xsph.ru','module-house <module@f0678609.xsph.ru>');

/**Отпрaвляем сообщение на почту
* @param string  $to - Кому
* @param string  $from - От кого
* @param string  $title - Заголовок письма
* @param string  $message - Тело письма
*/
function sendMail($to, $from, $title, $message)
{
    //Формируем заголовок письма
    $subject = $title;
    $subject = '=?utf-8?b?'. base64_encode($subject) .'?=';

    /*Формируем заголовки для почтового сервера,
    Говорим серверу что используем HTML*/
    $headers = "Content-type: text/html; charset=\"utf-8\"\r\n";
    $headers .= "From: ". $from ."\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Date: ". date('D, d M Y h:i:s O') ."\r\n";

    //Отправляем данные на ящик
    if(!mail($to, $subject, $message, $headers))
        return 'Ошибка отправки письма!';
    else
        return true;
}

//Если отправили форму, проверяем данные
if(isset($_POST['email']))
{
    //Определяем переменные
    $resp = array();

    //Утюжим переменные
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $resp['err'][] = 'Не верный Email';
    }
    $text = $_POST ['name'];
    //Шаблон проверки мобильного телефона
    $pattern = '/(8|7|\+7)?9\d{9}/';

    //Проверяем мобильный телефон
    if(!preg_match($pattern, $_POST['mobile'])){
        $resp['err'][] = 'Не верный мобильный телефон';
    }

    //Формируем заголовок письма
    $title = 'Ура, нам письмо пришло!';

    //Формируем HTML верстку письма для отправки
    $msg  = 'Мобильный телефон <strong>'. $_POST['mobile'].'</strong><br />';
    $msg .= 'E-mail отправителя <strong>'. $_POST['email'].'</strong><br />';
    $msg .= nl2br($_POST['text']);

    //Проверяем ошибки
    if(!empty($resp['err']))
    {
        //Выводим ошибки
        $resp['status'] = 0;
        echo json_encode($resp);
    }
    else
    {
        //Вызываем функцию отправки письма
        if(sendMail(BEZ_MAIL_TO, BEZ_MAIL_AUTOR, $title, $msg, $mail))
        {
            //Отправляем сообщение пользователю
            $resp['ok'] = 'Письмо отправленно...';
            $resp['status'] = 1;
            echo json_encode($resp);
        }
    }
}
    ?>