<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<?php
/*----MEDIDA DE SEGURIDAD----*/
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("location: index.html");
}

/*----ARCHIVOS REQUERIDOS----*/
require_once 'PhpMailer/PHPMailer.php';
require_once 'PhpMailer/Exception.php';
require_once 'PhpMailer/SMTP.php';

/*----OBTENER DATOS DE FORMULARIO----*/
$nombre= $_POST['name'];
$email=$_POST['mail'];
$mensaje=$_POST['mensaje'];
$archivo=$_FILES['archivo'];

if (empty(trim($nombre))) {
    $nombre='Anónimo';
}

/*----CUERPO DEL MENSAJE----*/
$body= <<<HTML
    <h1>Contacto desde Portfolio</h1>
    <p>De: $nombre / $email</p>
    <h2>Mensaje:</h2>
    $mensaje
HTML;

/*----CREAR NUEVO PHPMAILER----*/
$mailer=new \PHPMailer\PHPMailer\PHPMailer;

try {
    /*----CONFIGURACIÓN----*/
    $mailer->isSMTP();
    $mailer->Host='localhost'; 
    $mailer->SMTPSecure=false;
    $mailer->Port=25;
    $mailer->SMTPAuth=false;
    /*$mailer->Host='smtp.gmail.com';
    $mailer->user='';
    $mailer->password='';
    $mailer->Port=465;
    $mailer->SMTPAuth=''ssl;*/
    

    /*----CONFIGURACIÓN DEL MAIL----*/
    $mailer->setFrom($email, "$nombre"); 
    $mailer->addAddress('daniel.dev0085@gmail.com'); 
    $mailer->Subject='Asunto: Portfolio'; 
    $mailer->msgHTML($body); 
    $mailer->AltBody=strip_tags($body); 
    $mailer->CharSet='UTF-8'; 

    if ($archivo['size']>0) { 
        $mailer->addAttachment( $archivo['tmp_name'], $archivo['name']);
    }

    if ($mailer->send()) {
        echo 'Mensaje enviado';
    } else {
        echo 'Error en el envío del correo: ' . $mailer->ErrorInfo;
    }
 
} catch (\Exception $e) {
        echo 'Error en el envío del correo: {$e->ErrorInfo}';
}

header('refresh:2, url=../index.html');
?>
