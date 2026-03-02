<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?titulo()?>
    </title>
    <?descripcion()?>

    <?php icono(); ?>


    <!-- CSS -->
    <!-- <link rel="stylesheet" href="<?= URL; ?>/assets/css/style.css?v=<?= filemtime(PATH . 'assets/css/style.css'); ?>"> -->
    <link rel="stylesheet" href="<?= asset('assets/css/style.css'); ?>">

<body>
    <header>
        <span class="logo">miCRUD</span>
        <nav>
            <ul>
                <li><a href="<? echo URL?>">Inicio</a></li>
                <li><a href="<? echo URL?>lista.php">Lista</a></li>
                <li><a href="<? echo URL?>crud/listado_crud.php">CRUD</a></li>
                <li><a href="<? echo URL?>reset/iniciar_reset.php">Resetear</a></li>
            </ul>
        </nav>
    </header>