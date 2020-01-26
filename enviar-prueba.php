<?php

$correo = 'jairolaguna@gmail.com';
$mensaje ='probando... otra vez';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server with Gmail
    
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'jairolaguna@gmail.com';                // SMTP username
    $mail->Password   = 'jlaguna28';                            // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($correo, 'Carrito');
    $mail->addAddress($correo);                 // Add a recipient
    
    // Content
    $mail->isHTML(true);                                        // Set email format to HTML
    $mail->Subject = 'Correo de Restaurante';
    $mail->Body    = $mensaje;
    $mail->charSet = 'UTF-8';

    $mail->send();
    echo '<script>
        alert("El mensaje se envio correctamente");
        window.history.go(-1);
        </script>';
    } 
catch (Exception $e) 
    {
        echo "<br>El mensaje no se pudo enviar: {$mail->ErrorInfo}
        <br>Verifique su antivirus, puede estarlo bloqueando";
    }