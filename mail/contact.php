<?php
// Verifica si se han recibido todos los campos necesarios y si el correo electrónico es válido
if (empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  http_response_code(400); // Cambiado a 400 para indicar un error de solicitud incorrecta
  exit();
}

// Sanitiza y obtiene los datos del formulario
$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));


$to = "bv6530781@gmail.com"; // Cambia esto por tu dirección de correo electrónico
$subject = "$m_subject: $name";
$body = "Ha recibido un nuevo mensaje del formulario de su sitio web.\n\n";
$body .= "Detalles:\n\nNombre: $name\n";
$body .= "Email: $email\n";
$body .= "Asunto: $m_subject\n";
$body .= "Mensaje:\n$message\n";
$headers = "From: $email\r\n"; // Encabezado del remitente
$headers .= "Reply-To: $email\r\n"; // Encabezado de respuesta

// Envía el correo electrónico y verifica si se envió correctamente
if (mail($to, $subject, $body, $headers)) {
  http_response_code(200); // Indica éxito
  echo "¡Gracias! Tu mensaje ha sido enviado.";
} else {
  http_response_code(500); // Indica error interno del servidor
  echo "Oops! Algo salió mal y no pudimos enviar tu mensaje.";
}
?
