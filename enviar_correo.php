<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // CONFIGURACIÓN:  el correo de la óptica
    $destinatario = "ayuda@opticasdeluxe.com  "; 
    $asunto = "Nueva Consulta - Lentes Luxury Web";

    // Recogemos y saneamos los datos del formulario
    $nombre   = strip_tags(trim($_POST['nombre']));
    $apellido = strip_tags(trim($_POST['apellido']));
    $email    = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $telefono = strip_tags(trim($_POST['telefono']));
    $mensaje  = strip_tags(trim($_POST['mensaje']));

    // Construcción del cuerpo del mensaje
    $cuerpo = "Has recibido un nuevo mensaje desde el sitio web de Lentes Luxury:\n\n";
    $cuerpo .= "Nombre Completo: $nombre $apellido\n";
    $cuerpo .= "Correo: $email\n";
    $cuerpo .= "Teléfono: $telefono\n";
    $cuerpo .= "Mensaje:\n$mensaje\n";

    // Encabezados para el correo
    $headers = "From: Lentes Luxury Web <noreply@lentesluxury.com>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Intento de envío
    if (mail($destinatario, $asunto, $cuerpo, $headers)) {
        // Redirección si funciona
        echo "<script>
                alert('¡Gracias! Tu mensaje ha sido enviado con éxito.');
                window.location.href='index.html';
              </script>";
    } else {
        // Error si el servidor no puede enviar
        echo "<script>
                alert('Hubo un error al enviar el mensaje. Por favor intenta de nuevo.');
                window.history.back();
              </script>";
    }
} else {
    // Si alguien intenta entrar al archivo directamente, lo mandamos al inicio
    header("Location: index.html");
}
?>