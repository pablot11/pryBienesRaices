<main class="contenedor seccion contenido-centrado">
    <h1>Administrador de Bienes Raices</h1>
    <?php
    if ($resultado) {
        $mensaje = mostrarNotificacion(intval($resultado));
        if ($mensaje) { ?>
            <p class="alerta exito"><?php echo validar($mensaje) ?></p>
        <?php } ?>
    <?php } ?>


    <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
    <a href="/vendedores/crear" class="boton boton-amarillo">Nuevo(a) Vendedor</a>
    <h2>Propiedades</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($propiedades as $propiedad) {


                echo '  
                <tr>
                        <td>' . $propiedad->id . '</td>
                        <td>' . $propiedad->titulo . '</td>
                        <td><img src="/imagenes/' . $propiedad->imagen . '" alt="" class="imagen-tabla"></td>
                        <td>$' . $propiedad->precio . '</td>
                        <td>
                            <form method="POST" class="w-100" action="/propiedades/eliminar">
                                <input type="hidden" name="id" value="' . $propiedad->id . '">
                                <input type="hidden" name="tipo" value="propiedad">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">                        
                            </form>
                             <a href="/propiedades/actualizar?id=' . $propiedad->id . '" class="boton-amarillo-block">Actualizar</a>
                        </td>
                </tr>
                ';
            }
            ?>
        </tbody>
    </table>
    <h2>Vendedores</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($vendedores as $vendedor) {


                echo '  
                <tr>
                        <td>' . $vendedor->id . '</td>
                        <td>' . $vendedor->nombre . " " . $vendedor->apellido . ' </td>
                        <td>' . $vendedor->telefono . '</td>
                        <td>
                            <form method="POST" class="w-100" action="/vendedores/eliminar">
                                <input type="hidden" name="id" value="' . $vendedor->id . '">
                                <input type="hidden" name="tipo" value="vendedor">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">                        
                            </form>
                             <a href="vendedores/actualizar?id=' . $vendedor->id . '" class="boton-amarillo-block">Actualizar</a>
                        </td>
                </tr>
                ';
            }
            ?>
        </tbody>
    </table>
</main>