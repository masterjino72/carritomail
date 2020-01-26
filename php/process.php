<?php 

$correo = $_POST["email"];

$body = "Correo: " .$correo;
session_start();

include "conection.php";
if(!empty($_POST)){
$q1 = $con->query("insert into cart(client_email,created_at) value(\"$_POST[email]\",NOW())");
if($q1){
$cart_id = $con->insert_id;
foreach($_SESSION["cart"] as $c){
$q1 = $con->query("insert into cart_product(product_id,q,cart_id) value($c[product_id],$c[q],$cart_id)");
}
unset($_SESSION["cart"]);
}
}




$mensaje = "Pedido #: " . $cart_id . " // Correo: " . $correo;

print $mensaje;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

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
    $mail->addAddress('jairolaguna@gmail.com');                 // Add a recipient
    
    // Content
    $mail->isHTML(true);                                        // Set email format to HTML
    $mail->Subject = 'Correo de Carrito';
    $mail->Body    = $mensaje;
    $mail->charSet = 'UTF-8';

    $mail->send();
    print "<script>alert('Pedido enviado y procesado exitosamente');window.location='../products.php';</script>";
    } 
catch (Exception $e) 
    {
        echo "<br>Su pedido no se pudo enviar: <br>{$mail->ErrorInfo} <br> Verifique su Antivirus, puede estar bloqueando el envio.";
    }


    
?>


