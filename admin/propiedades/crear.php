<?php

    require '../../includes/app.php';

    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;

    estaAutenticado();

    $db = conectarDB();

    $propiedad = new Propiedad;

    //consultar para tener los vendedores
    $vendedores = Vendedor::all();

    $errores = Propiedad::getErrores();

    //Ejecuta el codigo despues de que el usuario ejecute el form
    if($_SERVER["REQUEST_METHOD"] === 'POST') {

        //crea una nueva instancia
        $propiedad = new Propiedad($_POST['propiedad']);

        //crear una carpeta
        $carpetaImagenes = '../../imagenes/';

        //generar un nombre unico
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        //setear la imagen
        // realiza un resize a la imagen con intervation
        if($_FILES['propiedad']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }

        //validar
        $errores = $propiedad->validar();
        
        //revisar que el arreglo de errores este vacio
        if(empty($errores)) {

            //crear la carpeta para subir imagenes
            if(!is_dir(CARPETAS_IMAGENES)) {
                mkdir(CARPETAS_IMAGENES);
            }

            //guarda la img en el servidor
            $image->save(CARPETAS_IMAGENES . $nombreImagen);

            //guarda en la bd
            $resultado = $propiedad->guardar();

            //mensaje de exito u error
            if($resultado or $resultado === null) {
                //redireccionar al usuario
                header('Location: /admin?resultado=1');
            }
        }

    }

    incluirTemplate(('header'));
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach ?>

    <form action="/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">
        
        <?php include '../../includes/templates/formulario_propiedad.php' ?>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">

    </form>

    </main>

<?php
    incluirTemplate('footer');
?>