<?php
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', '.funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');
function incluirTemplate(string $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/{$nombre}.php";
}
function debbug($variable)
{
    echo "<pre>";
    var_dump($variable);
    echo "</&pre>";
    exit;
}
// Escapa / Sanitizar el HTML
function validar($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

//Validar que solo en el tipo sea 'vendedor' o 'propiedad' para eliminar un registro
function validarTipoContenido($tipo)
{
    $tipos = ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos);
}

//Muestra los mensajes de creado, actualizado o eliminado
function mostrarNotificacion($codigo)
{
    $mensaje = '';
    switch ($codigo) {
        case 1:
            $mensaje = 'Creado correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado correctamente';
            break;
        default:
            $mensaje = false;
    }
    return $mensaje;
}
function validarORedireccionar($url)
{
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if (!$id) {
        header("Location: ${url}");
    }
    return $id;
}
