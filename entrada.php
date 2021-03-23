<?php 
$inicio = false;
require 'includes/app.php';
incluirTemplate('header') ?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guia para la decoracion de tu casa</h1>
        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp"> 
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="imagen de la propiedad">
        </picture>

        <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>

        <div class="resumen-propiedad">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur illo corporis in, eos modi odio nostrum numquam eligendi porro, reprehenderit quae dolorem suscipit voluptate, maiores molestias ducimus iusto adipisci facilis assumenda ut velit id officia. Nobis eum est quidem quis, tenetur aliquid obcaecati dolorum ullam quod et recusandae veritatis reprehenderit.</p>
        </div>
    </main>


    <?php incluirTemplate('footer');   ?>
