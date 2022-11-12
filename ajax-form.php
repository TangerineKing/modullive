<?php

if (isset($_POST["name"]) && isset($_POST["mobile"]) ) { 


$name = $_POST['name'];
$mobile = $_POST['mobile']; 
$email = $_POST['email'];
$message = $_POST['message'];


$my_email = 'private-information@oleg.com'; 
$sender_email = '<again-private@oleg.com>'; 
$title = "Ура,нам письмо пришло"; 


$mes = "
 Имя: $name\n
 Телефон: $mobile\n
 Комментарий: $message\n
";


$send = mail ($my_email,$title,$mes,"Content-type:text/plain; charset = utf-8\r\nFrom:$sender_email");

}

?>
