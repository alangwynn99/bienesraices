<?php 
require 'includes/app.php';
$inicio = false;
incluirTemplate('header') ?>

    <main class="contenedor seccion">
        <section class="section contenedor">
            <h2>Casas y Depas en Venta</h2>
            <?php 
                $limite = 10;
                include 'includes/templates/anuncios.php';
            ?>
        </section>
    </main>

    <?php incluirTemplate('footer');   ?>