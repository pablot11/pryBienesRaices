<main class="contenedor seccion">
    <h1>Contacto</h1>
    <?php
    if ($mensaje) { ?>
        <p class="alerta exito"> <?php echo $mensaje ?></p>;
    <?php } ?>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto">
    </picture>
    <h2>Llene el formulario de contacto</h2>
    <form action="/contacto" method="POST" class="formulario">
        <fieldset>
            <legend>Información Personal</legend>
            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu Nombre" name="contacto[nombre]" id="nombre" required>

            <label for="mensaje">Mensaje:</label>
            <textarea name="contacto[mensaje]" id="mensaje" required></textarea>
        </fieldset>
        <fieldset>
            <legend>Información sobre la propiedad</legend>
            <label for="opciones">Vende o Compra:</label>
            <select name="contacto[tipo]" id="opciones" required>
                <option value="" disabled selected>--Seleccione</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>
            <label for="presupuesto">Precio o Presupuesto</label>
            <input type="number" placeholder="Tu Precio o Presupusto" name="contacto[precio]" id="presupuesto" required>
        </fieldset>
        <fieldset>
            <legend>Contacto</legend>
            <p>Como desea ser contactado</p>
            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input type="radio" name="contacto[contacto]" id="contactar-telefono" value="telefono" required>
                <label for="contactar-email">E-mail</label>
                <input type="radio" name="contacto[contacto]" id="contactar-email" value="email" required>
            </div>
            <div id="contacto">

            </div>

        </fieldset>
        <input class="boton-verde" type="submit" name="enviar" id="enviar">
    </form>
</main>