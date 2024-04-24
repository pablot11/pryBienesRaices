<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{
    //AL incluir la clase Router, con el parametro de tipo Router mantenemos referencia al mismo objeto en memoria
    public static function index(Router $router)
    {
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        // Si la variable GET resultado no esta definida, se le asigna null
        $resultado = $_GET['resultado'] ?? null;
        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }
    public static function crear(Router $router)
    {
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();


        $errores = Propiedad::getErrores();
        //Verificar que sea POST para ver si creo una propiedad el usuario
        //Caso contrario el usuario solo hizo GET para obtener el layout de crear
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $propiedad = new Propiedad($_POST['propiedad']);

            //Generar nombre unico imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            /* SETEAR LA IMAGEN */
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                //Realiza un resize a la imagen con la libreria intervention
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                //llamaos setImagen() para solo mandar el nombre de la imagen, no el archivo
                $propiedad->setImagen($nombreImagen);
            }

            //Validar los campos del formulario
            $errores = $propiedad->validar();
            //Revisar que no hayan errores en el arreglo
            if (empty($errores)) {
                //Crea la carpeta en caso de no existir
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                //Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
                //Guarda todos los datos en la BD
                $propiedad->guardar();
            }
        }
        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }
    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        debbug($propiedad->titulo);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Asignar los atributos
            //En el atributo name de los inputs asignamos un array llamado propiedad
            //METODO 1
            $args = $_POST['propiedad'];
            $propiedad->sincronizar($args);
            //METODO 2
            /*
            $propiedad->sincronizar($_POST);
            */
            $errores = $propiedad->validar();
            //Generar nombre unico imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            /* SETEAR LA IMAGEN */
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                //Realiza un resize a la imagen con la libreria intervention
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                //llamaos setImagen() para solo mandar el nombre de la imagen, no el archivo
                $propiedad->setImagen($nombreImagen);
            }

            //Revisar que no hayan errores en el arreglo
            if (empty($errores)) {
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    //Almacenar la imagen en el servidor
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
            }
            $propiedad->guardar();
        }

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }
    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id) {
                $tipo = $_POST['tipo'];
                if (validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}
