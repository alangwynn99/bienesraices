<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETAS_IMAGENES', __DIR__ . '/../imagenes/');

function incluirTemplate($nombre, $inicio = false) {
    include TEMPLATES_URL . "/${nombre}.php"; 
}

//crear funcion de autenticacion que retorna un bool
function estaAutenticado () {
    session_start();

    if(!$_SESSION['login']) {
        header('Location: /');
    }
}

function debugear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;

}

function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function objectToObject($instance, $className) {
    return unserialize(sprintf(
        'O:%d:"%s"%s',
        strlen($className),
        $className,
        strstr(strstr(serialize($instance), '"'), ':')
    ));
}

//validar tipo de contenido
function validarContenido($tipo) {
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos);
}

//mostrar alertas

function mostrarAlerta($codigo) {
    $mensaje = '';

    switch($codigo) {
        case 1: 
            $mensaje = 'Creado correctamente';
            break;
        case 2: 
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3: 
            $mensaje = 'Eliminado Correctamente';
            break;
        default:
            $mensaje = false;      
    }
    return $mensaje;
}