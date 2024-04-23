<?php
if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/index">
                    <img src="/build/img/logo.svg" alt="logo">
                </a>
                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="Icono Responsivo">
                </div>
                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" class="dark-mode-boton" alt="modo oscuro">
                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/anuncios">Anuncios</a>
                        <a href="/blog">Blogs</a>
                        <a href="/contacto">Contacto</a>
                        <?php if ($auth) : ?>
                            <a href="cerrar-sesion.php">Cerrar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>

            </div>
            <?php if (isset($inicio)) { ?>
                <h1>Venta de Casas y Departamentos de Lujo</h1>
            <?php } ?>
        </div>
        <!--Cierre barra-->
    </header>