<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header>
        <a href="<?=get_home_url() ?>"><? wp_title()?></a>
        <nav>      <ul>        <li><a href="#">Apartado</a></li>       </ul>  </nav>
    </header>
    <main>
        <h1>Aquí va tu contenido</h1>
        <p>Tu "mierda" ahora estará bien envuelta en HTML.</p>
    </main>

    <?php wp_footer(); ?>
</body>
</html>
