<fieldset>
    <legend>Información General</legend>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre Vendedor" value=<?php echo validar($vendedor->nombre) ?>>
    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido Vendedor" value=<?php echo validar($vendedor->apellido) ?>>
</fieldset>
<fieldset>
    <legend>Información Extra</legend>
    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="vendedor[telefono]" placeholder="Telefono Vendedor" value=<?php echo validar($vendedor->telefono) ?>>
</fieldset>