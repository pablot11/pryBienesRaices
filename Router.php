<?php

namespace MVC;

use Controllers\PropiedadController;

class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];
    //Funcion que recibe la url que pone el usuario y esta url tendra una funcion asociada a ella

    public function get($url, $fn)
    {
        //la variable fn contiene un array con 2 llaves, el namespace de la clase y la funcion de la clase que queremos usar
        //Decimos que en el objeto memoria la propiedad array rutasGet va a tener como llave la url que pasamos como parametro
        //y que como valor de esa llave va a tener el array(no asociativo) que esta en fn 
        $this->rutasGET[$url] = $fn;
    }
    public function post($url, $fn)
    {
        //la variable fn contiene un array con 2 llaves, el namespace de la clase y la funcion de la clase que queremos usar
        //Decimos que en el objeto memoria la propiedad array rutasPost va a tener como llave la url que pasamos como parametro
        //y que como valor de esa llave va a tener el array(no asociativo) que esta en fn 
        $this->rutasPOST[$url] = $fn;
    }


    public function comprobarRutas()
    {
        session_start();
        $auth = $_SESSION['login'] ?? null;
        //Arreglo de rutas protegidas
        $rutas_protegidas = [
            '/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar',
            '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'
        ];


        //Tomamos la ruta de la url actual que puso el user
        $currentUrl = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
        //Verificamos por que metodo lo pidio al recurso o si es POST
        $metodo =  $_SERVER['REQUEST_METHOD'];
        if ($metodo === 'GET') {
            //Asignamos a la variable fn un array que este dentro de el array asociativo donde la llave sea igual a urlActual
            $fn = $this->rutasGET[$currentUrl] ?? null;
        } else {
            //Asignamos a la variable fn el array que coincida con el valor de la variable urlActual
            $fn = $this->rutasPOST[$currentUrl] ?? null;
        }

        //Proteer las rutas

        if (in_array($currentUrl, $rutas_protegidas) && !$auth) {
            header('Location: /');
        }
        //Si no esta nulo el array
        if ($fn) {
            //Nos permite llamar una funcion cuando no sabemos como se llama la funcion
            //En este caso como primer parametro le pasamos fn que es el array con 2 posiciones la primera con el namespace de la clase(o controlador)
            //y la 2da posicion con la funcion de esa misma clase
            //Esta funcion va a instanciar un objeto de la clase controlador que este en fn
            // Esto significa que estás pasando el objeto actual como argumento a la función que estás llamando dinámicamente.
            call_user_func($fn, $this);
        } else {
            echo "Pagina no encontrada";
        }
    }
    //Muestra una vista para renderizar el html
    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            //$$key es una variable de variable, esto quiere decir que $$key apunta al valor de $key en el arreglo asociativo de $datos
            //Practicante la expresión $$key se utiliza para crear una nueva variable con el nombre almacenado en $key
            //La variable de variable se puede usar en el scope de la funcion
            $$key = $value;
        }
        //Es una estructura que almacena en memoria, todo el codigo que se genere a partir de este momento se guarda(Se activa buffer salida)
        ob_start();
        //El objeto en memoria almacena todo lo que contenga la view que incluimos
        include __DIR__ . "/views/" . $view . ".php";
        //Almacenamos lo que la estructura en memoria almaceno y lo asignamos a la variable contenido, limpiando la estrucutra que quedo en memoria
        $contenido = ob_get_clean();
        include __DIR__ . "/views/layout.php";
    }
}
