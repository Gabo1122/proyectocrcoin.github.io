<?php

$multicheck = array();
$_subject = trim($_POST['subject']);;
$name = trim($_POST['fname']);
$email = trim($_POST['email']);
$phone = (isset($_POST['phone']))?trim($_POST['phone']):'';
$_message = trim($_POST['message']);


if ($name == "") {
    $msg['err'] = "\n No lo puedes dejar vacio!";
    $msg['field'] = "fname";
    $msg['code'] = FALSE;
} else if ($email == "") {
    $msg['err'] = "\n No lo puedes dejar vacio!";
    $msg['field'] = "Email";
    $msg['field'] = "email";
    $msg['code'] = FALSE;
} else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $msg['err'] = "\n Pon una dirección correcta!";
    $msg['field'] = "email";
    $msg['code'] = FALSE;
} else if ($phone == "") {
    if(isset($_POST['phone'])){
        $msg['err'] = "\n No lo puedes dejar vacio!";
        $msg['field'] = "phone";
        $msg['code'] = FALSE;
    }
} else if (!preg_match("/^[0-9\\-\\+]{4,17}$/", trim($phone))) {
    $msg['err'] = "\n Pon un número válido!";
    $msg['field'] = "phone";
    $msg['code'] = FALSE;
} else if ($_subject == "") {
    $msg['err'] = "\n No lo puedes dejar vacio!";
    $msg['field'] = "subject";
    $msg['code'] = FALSE;
} else if ($_message == "") {
    $msg['err'] = "\n No lo puedes dejar vacio!";
    $msg['field'] = "message";
    $msg['code'] = FALSE;
} else {
    $to = 'info@crcoinico.com';
    $subject = 'Mensaje de la pagina';
    $message = '<html><head></head><body>';
    if(isset($_subject) && !empty($_subject)){
        $message .= '<p>Subject: ' . $_subject . '</p>';
    }
    $message .= '<p>Name: ' . $name . '</p>';
    $message .= '<p>Email: ' . $email . '</p>';
    $message .= '<p>Phone: ' . $phone . '</p>';
    $message .= '<p>Message: ' . $_message . '</p>';
    $message .= '</body></html>';
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From:  CR Coin website <info@crcoinico.com>' . "\r\n";
    $headers .= 'cc: user@example.com' . "\r\n";
    $headers .= 'bcc: text@example.com' . "\r\n";
    mail($to, $subject, $message, $headers, '-f test@example.com');

    $msg['success'] = "\n Se ha enviado!.";
    $msg['code'] = TRUE;

 

}
echo json_encode($msg);