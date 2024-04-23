<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/prybienesraices/build/css/app.css">
</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/prybienesraices/index.php">
                    <img src="/build/img/logo.svg" alt="logo">
                </a>
                <div class="mobile-menu">
                    <img src="/prybienesraices/build/img/barras.svg" alt="Icono Responsivo">
                </div>
                <div class="derecha">
                    <img src="/prybienesraices/build/img/dark-mode.svg" class="dark-mode-boton" alt="modo oscuro">
                    <nav class="navegacion">
                        <a href="/prybienesraices/nosotros.php">Nosotros</a>
                        <a href="/prybienesraices/anuncios.php">Anuncios</a>
                        <a href="/prybienesraices/blog.php">Blogs</a>
                        <a href="/prybienesraices/contacto.php">Contacto</a>
                    </nav>
                </div>

            </div>
            <?php if (isset($inicio)) { ?>
                <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php } ?>
        </div>
        <!--Cierre barra-->
    </header>