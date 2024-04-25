 <main class="contenedor seccion contenido-centrado">
     <h1>Iniciar Sesión</h1>

     <?php foreach ($errores as $error) : ?>
         <div class="alerta error">
             <?php echo $error; ?>
         </div>
     <?php endforeach; ?>

     <form method="POST" class="formulario" action="/login">
         <fieldset>
             <legend>Email y Password</legend>

             <label for="email">E-mail</label>
             <input type="email" name="admin[email]" placeholder="Tu Email" id="email" value="correo@correo.com">

             <label for="password">Password</label>
             <input type="password" name="admin[password]" placeholder="Tu Password" id="password" value="123123">
         </fieldset>

         <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
     </form>
 </main>