<?php
$to = 'kronnopio@gmail.com';
$subject = '¡Hola desde XAMPP!';
$message = '<html><body>';
$message .= '<h1>¡Hola!</h1>';
$message .= '<p>Este es un correo electrónico de prueba desde XAMPP.</p>';
$message .= '</body></html>';

// Generar Message-ID único
$message_id = "<" . uniqid() . "@reverdito.com.ar>";

$headers = "From: sysmoto@reverdito.com.ar\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=utf-8\r\n";
$headers .= "Message-ID: " . $message_id . "\r\n"; // Agregar Message-ID al encabezado


if (mail($to, $subject, $message, $headers)) {
   echo "SUCCESS";
} else {
   echo "ERROR";
}
?>


