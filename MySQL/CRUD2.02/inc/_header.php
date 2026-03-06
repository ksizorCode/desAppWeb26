<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?titulo()?></title>
    <?descripcion()?>
    <?icono()?>


    <!-- CSS -->
    <!-- <link rel="stylesheet" href="<?= URL; ?>/assets/css/style.css" Versión finalizada-->
    <!-- <link rel="stylesheet" href="<?= URL; ?>/assets/css/style.css?v=<?=date('U'); ?>"> Versión en desarrollo 1 -->
    <!-- <link rel="stylesheet" href="<?= URL; ?>/assets/css/style.css?v=<?= filemtime(PATH . 'assets/css/style.css'); ?>"> Desarrollo 2 -->
    <link rel="stylesheet" href="<?= asset('assets/css/style.css'); ?>">

<body>
    <header>
        <a class="logo" href="<?=URL?>">miCRUD</a>
        <nav>
            <ul class="menu">
                <li><a href="<? echo URL?>">Inicio</a></li>
                <li><a href="<? echo URL?>lista.php">Lista</a></li>
                <li><a href="<? echo URL?>crud/listado_crud.php">CRUD</a></li>
                <li><a href="<? echo URL?>reset/iniciar_reset.php">Resetear</a></li>
            </ul>
        </nav>
    </header>
    <main>