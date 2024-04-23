<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginController
{
    public static function login(Router $router)
    {
        $errores = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Admin($_POST['admin']);
            $errores = $auth->validar();
            if (empty($errores)) {
                //Verificar si el usuario existe
                $resultado = $auth->existeUsuario();
                if (!$resultado) {
                    //Verificar si el usuario existe nos da el error
                    $errores = Admin::getErrores();
                } else {
                    //Verificar si la contraseña existe
                    $autenticado = $auth->comprobarPassword($resultado);

                    if ($autenticado) {
                        $auth->autenticar();
                    } else {
                        $errores = Admin::getErrores();
                    }
                }


                //verifcar email
            }
        }
        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }
    public static function logout(Router $router)
    {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
}
