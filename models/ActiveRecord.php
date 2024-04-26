<?php

namespace Model;

class ActiveRecord
{
    //Base de datos
    protected static $db;
    protected static $columnasDb = [];
    protected static $tabla = '';
    //Array para verificar errores
    protected static $errores = [];



    //Definir la conexion BD
    public static function setDb($dataBase)
    {
        self::$db = $dataBase;
    }
    public function guardar()
    {
        if (!is_null($this->id)) {
            $this->actualizar();
        } else {
            $this->crear();
        }
    }
    public function crear()
    {
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        $query = "INSERT INTO " . static::$tabla . "( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
        $resultado = self::$db->query($query);

        //Mensaje de exito o error
        if ($resultado) {
            header('Location: /admin?resultado=1');
        }
    }
    public function actualizar()
    {
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .=  join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= "LIMIT 1 ";
        $resultado = self::$db->query($query);
        if ($resultado) {
            header('Location: /admin?resultado=2');
        }
    }
    public function eliminar()
    {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        if ($resultado) {
            $this->borrarImagen();
            header('Location: /admin?resultado=3');
        }
    }
    public function atributos()
    {
        //Almacena en el array las columnas que tiene el objeto en memoria comparando con columnasDb y los valores que tiene el objeto 
        $atributos = [];
        foreach (static::$columnasDb as $columna) {
            //El if continue ignora el atributo id
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }
    //Sanitizar los datos
    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }
    //Funcion para asignar el nombre unico de la imagen al atributo imagen
    public function setImagen($imagen)
    {
        //Eliminar la imagen previa
        if (!is_null($this->id)) {
            //Comprobar si existe el archivo
            $this->borrarImagen();
        }
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }
    //Eliminar imagen del servidor
    public function borrarImagen()
    {
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }
    //Validación
    public static function getErrores()
    {
        return static::$errores;
    }
    public function validar()
    {
        static::$errores = [];
        //Validación del formulario
        return static::$errores;
    }
    //Lista todas las propiedades
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    //Obtiene determinado numeros de registros
    public static function getPropiedades($cantidad)
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    //Funcion para buscar una propiedad por su id
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";
        $resultados = self::consultarSQL($query);
        $resultado = array_shift($resultados);
        return $resultado;
    }
    public static function consultarSQL($query)
    {
        $resultado = self::$db->query($query);
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }
        $resultado->free();
        return $array;
    }
    protected static function crearObjeto($registro)
    {
        $objeto = new static();
        foreach ($registro as $key => $value) {
            //Verifica si una propiedad existe
            if (property_exists($objeto, $key)) {
                //$key es una variable de variable y recorre todas las propiedades del objeto
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }
    //Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                if ($key != 'id') {

                    $this->$key = $value;
                }
            }
        }
    }
}
