<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?titulo()?> | <?appTitulo()?></title>
    <?description()?>
    
    <!-- <link rel="stylesheet" href="assets/css/style.css?v=<?echo date('U')?>"> -->
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo filemtime('assets/css/style.css'); ?>">
</head>
<body>
<header>
    <?menu()?>
</header>
<main>
    <h1><?titulo()?></h1>