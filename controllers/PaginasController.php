<?php


namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::getPropiedades(3);
        $inicio = true;
        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }
    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros');
    }
    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::all();
        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad(Router $router)
    {
        $id = validarORedireccionar('/propiedades');
        $propiedad = Propiedad::find($id);
        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router)
    {
        $router->render('paginas/blog');
    }
    public static function entrada(Router $router)
    {
        $router->render('paginas/entrada');
    }
    public static function contacto(Router $router)
    {
        $mensaje = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mensaje = null;
            $respuestas = $_POST['contacto'];
            //Creamos instancia de phpmailer
            $mail = new PHPMailer();
            //Configurar el protocolo smtp para el envio de mails
            $mail->isSMTP();
            //Indicamos el server host 
            $mail->Host = $_ENV['EMAIL_HOST'];
            //Indicamos que nos vamos a auntenticar por usuario y password
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];
            //Indicamos que vayan por un tunel seguro los mails para que no los intercepten, no se encriptan
            $mail->SMTPSecure = 'tls';
            $mail->Port = $_ENV['EMAIL_PORT'];

            //Configuramos el contenido del mail
            $mail->setFrom('admin@bienesraices.com', 'bienes');
            $mail->addAddress('admin@bienesraices.com');
            $mail->Subject = 'Tienes un Nuevo Mensaje';

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'utf-8';

            //definir el contenido
            $contenido = '<html>';
            $contenido .= '<p> Tienes un nuevo mensaje </p>';
            $contenido .= '<p> Nombre: ' . $respuestas['nombre'] . '</p>';
            $contenido .= '<p> Email: ' . $respuestas['email'] . '</p>';
            if ($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p>Eligió ser contactado por teléfono </p>';
                $contenido .= '<p> Teléfono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p> Fecha Contacto:' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p> Hora:' . $respuestas['hora'] . '</p>';
            } else {
                $contenido .= '<p>Eligió ser contactado por email </p>';
                $contenido .= '<p> Email: ' . $respuestas['email'] . '</p>';
            }
            $contenido .= '<p> Vende o Compra: ' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p> Precio o Presupusto: $ ' . $respuestas['precio'] . '</p>';
            $contenido .= '<p> Prefiere ser contactado por:' . $respuestas['contacto'] . '</p>';

            $contenido .= '</html>';
            //Contenido dle mail
            $mail->Body = $contenido;
            $mail->AltBody = 'Mail sobre bienes raices';
            //Enviar el email
            if ($mail->send()) {
                $mensaje = "Mensaje enviado correctamente";
            } else {
                $mensaje = "El mensaje no se pudo enviar";
            }
        }
        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}
