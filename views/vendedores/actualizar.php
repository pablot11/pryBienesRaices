<main class="contenedor seccion contenido-centrado">
    <h1>Actualizar Vendedor</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <?php
    foreach ($errores as $error) { ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>

    <?php } ?>


    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include 'formulario.php' ?>
        <input type="submit" value="Guardar Cambios" class="boton boton-verde">
    </form>
</main>