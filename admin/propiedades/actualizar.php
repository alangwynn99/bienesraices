<?php

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

require '../../includes/app.php';
    estaAutenticado();

    //validar la URL por id valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /admin');
    }

    $db = conectarDB();

    //obtener datos de la propiedad
    $propiedad = Propiedad::find($id);

    $vendedores = Vendedor::all();

    $errores = Propiedad::getErrores();

    //Ejecuta el codigo despues de que el usuario ejecute el form
    if($_SERVER["REQUEST_METHOD"] === 'POST') {

        $args['id'] = $id ?? null;
        $args['titulo'] = $_POST['propiedad']['titulo'] ?? null;
        $args['precio'] = $_POST['propiedad']['precio'] ?? null;
        $args['imagen'] = $propiedad->imagen ?? null;
        $args['descripcion'] = $_POST['propiedad']['descripcion'] ?? null;
        $args['habitaciones'] = $_POST['propiedad']['habitaciones'] ?? null;
        $args['wc'] = $_POST['propiedad']['wc'] ?? null;
        $args['estacionamiento'] = $_POST['propiedad']['estacionamiento'] ?? null;
        $args['creado'] = $propiedad->creado ?? null;
        $args['vendedorid'] = $propiedad->vendedorid ?? null;

        $propiedad = (object)$args;

        $propiedad = objectToObject($propiedad, 'App\Propiedad');

        //validacion
        $errores = $propiedad->validar();

        //generar nombre unico de imagen
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        //subida de archivos
        if($_FILES['propiedad']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }

        //revisar que el arreglo de errores este vacio
        if(empty($errores)) {
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                //almacenar la imagen
                $image->save(CARPETAS_IMAGENES . $nombreImagen);
            }

            $propiedad->guardar();
        }
    }

    incluirTemplate(('header'));
?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">

        <?php include '../../includes/templates/formulario_propiedad.php'; ?>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">

    </form>

    </main>

<?php
    incluirTemplate('footer');
?>