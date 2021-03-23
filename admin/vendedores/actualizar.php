<?php

require '../../includes/app.php';

use App\Vendedor;

estaAutenticado();

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id) {
    header('Location: /admin');
}

//obtener el arreglo del vendedor
$vendedor = Vendedor::find($id);

//consultar para tener los vendedores
$vendedores = Vendedor::all();

$errores = Vendedor::getErrores();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //asignar los valores
    $args = [];
    $args['id'] = $id;
    $args['nombre'] = $_POST['vendedor']['nombre'];
    $args['apellido'] = $_POST['vendedor']['apellido'];
    $args['telefono'] = $_POST['vendedor']['telefono'];

    //validacion
    $vendedor = (object)$args;

    $vendedor = objectToObject($vendedor, 'App\Vendedor');

    $errores = $vendedor->validar();

    if(empty($errores)) {
        $vendedor->guardar();
    }
}

incluirTemplate('header');

?>

<main class="contenedor seccion">
        <h1>Actualizar Vendedor(a)</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        
        <?php include '../../includes/templates/formulario_vendedores.php' ?>

        <input type="submit" value="Guardar Cambios" class="boton boton-verde">

    </form>

    </main>

<?php
    incluirTemplate('footer');
?>