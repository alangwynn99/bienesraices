<?php

require '../../includes/app.php';

use App\Vendedor;

estaAutenticado();

$vendedor = new Vendedor();

//consultar para tener los vendedores
$vendedores = Vendedor::all();

$errores = Vendedor::getErrores();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //crear nueva instancia
    $vendedor = new Vendedor($_POST['vendedor']);

    //validar campos vacios
    $errores = $vendedor->validar();

    if(empty($errores)) {
        $resultado = $vendedor->guardar();

        if($resultado or $resultado === null) {
            //redireccionar al usuario
            header('Location: /admin?resultado=1');
        }
    }
}

incluirTemplate('header');

?>

<main class="contenedor seccion">
        <h1>Registrar Vendedor(a)</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach ?>

    <form action="/admin/vendedores/crear.php" class="formulario" method="POST" enctype="multipart/form-data">
        
        <?php include '../../includes/templates/formulario_vendedores.php' ?>

        <input type="submit" value="Registrar Vendedor" class="boton boton-verde">

    </form>

    </main>

<?php
    incluirTemplate('footer');
?>