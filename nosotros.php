<?php 
    $inicio = false;
    require 'includes/app.php';
    incluirTemplate('header'); 
?>

    <main class="contenedor seccion">
        <h1>Conoce Sobre Nosotros</h1>
        <div class="contenedor-nosotros">
            <img src="/src/img/nosotros.jpg" alt="imagen de nosotros">
            <div class="texto-nosotros">
                <blockquote>
                    25 Años de experiencia
                </blockquote>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem voluptas molestias, quasi dignissimos ea error vero doloribus, dicta velit quam, consequatur minima. Cumque aspernatur facere illum assumenda, enim explicabo reiciendis. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum quaerat atque quos est libero accusantium sed veniam temporibus, aspernatur fuga! Sapiente, dolorum. Voluptatem, accusantium pariatur! Animi cumque nesciunt quis labore! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nisi ipsum natus rerum at quae accusamus autem veritatis deserunt molestiae earum ipsa animi, voluptatem id eligendi. A explicabo perspiciatis repellendus provident! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, eius ut? Neque, eos! Aut, expedita nulla? Provident a quis sunt voluptate est, quae voluptatum minus eos nobis suscipit praesentium fuga!</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Mas Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam sequi eum ea! Eveniet in corrupti modi blanditiis est. Libero maxime nostrum iure adipisci ex saepe, sunt aspernatur vero nisi voluptatum.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam sequi eum ea! Eveniet in corrupti modi blanditiis est. Libero maxime nostrum iure adipisci ex saepe, sunt aspernatur vero nisi voluptatum.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="icono tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam sequi eum ea! Eveniet in corrupti modi blanditiis est. Libero maxime nostrum iure adipisci ex saepe, sunt aspernatur vero nisi voluptatum.</p>
            </div>
        </div>
    </section>

    <?php incluirTemplate('footer');   ?>
