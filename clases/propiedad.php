<?php

namespace App;

class Propiedad extends ActiveRecord {
    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorid'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorid;

    public function __construct($args= []) {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorid = $args['vendedorid'] ?? '';
    }

    public function validar() {
        if(!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }

        if(!$this->precio) {
            self::$errores[] = "Debes añadir un precio";
        }

        if(!$this->descripcion) {
            self::$errores[] = "Debes añadir una descripcion";
        }

        if(!$this->habitaciones) {
            self::$errores[] = "Debes añadir la cantidad de habitaciones";
        }

        if(!$this->wc) {
            self::$errores[] = "Debes añadir la cantidad de wc";
        }

        if(!$this->estacionamiento) {
            self::$errores[] = "Debes añadir la cantidad de estacionamientos";
        }

        if(!$this->vendedorid) {
            self::$errores[] = "Elige un vendedor";
        }

        if(!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria";
        }

        return self::$errores;
    }
}