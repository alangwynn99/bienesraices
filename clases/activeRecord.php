<?php

namespace App;

class ActiveRecord {
    
    //base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    //errores
    protected static $errores = [];

    public static function setdb($database) {
        self::$db = $database;
    }

    public function guardar() {
        if(isset($this->id)) {
            //actualizar
            $this->actualizar();
        } else {
            //crear 
            $this->crear();
        }
    }
    
    public function actualizar() {
        //sanitizar los datos
        $atributos = $this->sanitizarDatos();
        
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        $query = "UPDATE " . static::$tabla . " SET "; 
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);

        if($resultado) {
            //redireccionar al usuario
            header('Location: /admin?resultado=2');
        }
    }

    public function eliminar() {
        //Eliminar la propiedad
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado) {
            $this->borrarImagen();
            header('location: /admin?resultado=3');
        }
    }

    public function crear() {
        //sanitizar los datos
        $atributos = $this->sanitizarDatos();

        //insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ')";

        $resultado = self::$db->query($query);

        return $resultado;

    }

    //identificar y unir los atributos de la bd
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarDatos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    //subida de archivos
    public function setImagen($imagen) {
        //elimina la imagen previa si existe
        if(isset($this->id)) {
            $this->borrarImagen();
        }

        //asignar al atributo de imagen el nombre de la imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    //elimina el archivo imagen
    public function borrarImagen() {
        $existe = file_exists(CARPETAS_IMAGENES . $this->imagen);
        if($existe) {
            //elimina el archivo anterior por el nuevo
            unlink(CARPETAS_IMAGENES . $this->imagen);
        }
    }

    public static function getErrores() {
        return static::$errores;
    }

    public function validar() {
        
        static::$errores = [];

        return static::$errores;
        
    }

    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //obtener registros por un determinado numero
    public static function get($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //busca un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";

        $resultado = self::consultarSQL($query);

        //retorna la primera posicion del arreglo
        return (array_shift($resultado));
    }

    public static function consultarSQL($query) {
        //consultar bd
        $resultado = self::$db->query($query);
        
        //iterar resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        //liberar la memoria
        $resultado->free();

        //retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro) {
        //nueva propiedad (clase padre)
        $objeto = new static;

        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;

    }

    //sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = []) {
        foreach($args as $key => $value) {
            //verificacion de si un atributo existe
            if(property_exists($this, $key) && is_null($value)) {
                $this->$key = $value;
            }
        }
    }

}