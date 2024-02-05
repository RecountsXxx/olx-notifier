<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require '../vendor/autoload.php';


function send_subscribe_email($email,$current_price,$url,$name){
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = '	ssl://smtp.ukr.net';
        $mail->Username = 'bohdankomp228@ukr.net';
        $mail->Password = 'slEuQV7PtCPVR8We';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 465;

        $mail->setFrom('bohdankomp228@ukr.net', 'OLX Serivce');
        $mail->addAddress($email);

        $mail->isHTML(true);

        $mail->Body = '<h3>Товар: ' . $name . '</h3> <br>' . '<h3>Текущая цена: ' . $current_price . '</h3><br>' . '<h3>Ссылка на объявление: ' . $url . '</h3><br>';

        if (!$mail->send()) {
            echo 'Помилка відправлення листа: ' . $mail->ErrorInfo;
        } else {
            echo 'Лист відправлено успішно!';
        }
    } catch (Exception $e) {
        echo 'Помилка: ' . $e->getMessage();
    }
}

