<main class="contenedor seccion contenido-centrado">
    <h1>Registrar Propiedades</h1>
    <?php
    foreach ($errores as $error) { ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>

    <?php } ?>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php';    ?>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>

</main>