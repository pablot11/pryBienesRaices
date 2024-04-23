 <fieldset>
     <legend>Información General</legend>
     <label for="titulo">Titulo:</label>
     <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titular Propiedad" value=<?php echo validar($propiedad->titulo) ?>>

     <label for="precio">Precio:</label>
     <input type="number" id="precio" name="propiedad[precio]" placeholder="Titular Precio" value=<?php echo validar($propiedad->precio) ?>>

     <label for="imagen">Imagen:</label>
     <input type="file" id="imagen" name="propiedad[imagen]" accept=" image/jpeg, image/png">

     <?php if ($propiedad->imagen) {
            echo '<img src="/imagenes/' . $propiedad->imagen . '" class="imagen-small"';
        }
        ?>
     <label for="descripcion">Descripción:</label>
     <textarea id="descripcion" name="propiedad[descripcion]"><?php echo validar($propiedad->descripcion) ?></textarea>
 </fieldset>
 <fieldset>
     <legend>Información Propiedad</legend>

     <label for="habitaciones">Habitaciones:</label>
     <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej: 3" min="1" max="9" value=<?php echo validar($propiedad->habitaciones) ?>>

     <label for="wc">Baños:</label>
     <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej: 3" min="1" max="9" value=<?php echo validar($propiedad->wc) ?>>

     <label for="estacionamiento">Estacionamientos:</label>
     <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej: 3" min="1" max="9" value=<?php echo validar($propiedad->estacionamiento) ?>>

 </fieldset>
 <fieldset>
     <legend>Vendedor</legend>
     <label for="vendedor">Vendedor</label>
     <select name="propiedad[vendedorId]" id="vendedor">
         <option selected value="">--Seleccione--</option>
         <?php
            foreach ($vendedores as $vendedor) { ?>
             <option <?php echo $propiedad->vendedorId === $vendedor->id ? 'selected' : ''; ?> value="<?php echo validar($vendedor->id) ?>"><?php echo validar($vendedor->nombre) . " " . validar($vendedor->apellido) ?>
             </option>
         <?php } ?>
     </select>
 </fieldset>