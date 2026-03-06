<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <?php
    wp_head();
    // Indicamos WP que terminamo el el Head por si ha de meter algun contenido extra (por ejemplo para plugins o componentes - inspecciona la web para ver como aquí se ha añadido contenido) ?>
</head>

<body <?php body_class(); ?>>
    <header>
        <a href="<?= get_home_url() ?>"><? wp_title() ?><h1><?php bloginfo( 'name' ); ?></h1></a>
        <p><?php bloginfo( 'description' ); ?></p>
    </header>
    <main>