<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body{
            background: red;
            text-align: center;
            color:white;
            font-family: sans-serif;
            text-shadow:3px 4px 8px black;
            font-size:55px;
            animation: anim1 1s infinite alternate;
        }


    </style>
</head>
<body>




<?php
    //Si no hemos insertado nombre:
    if(!isset($_GET['nombre'])){
        echo "<h2>Inserte un nombre para felizitar a alguien.</h2>
        <form action='index.php' method='get'>
            <input type='text' name='nombre'>
            <input type='submit'>
        </form>";
   
    }
    //Si ya hemos insertado nombre:
    else{
        echo "<h1>Feliz Año: ".$_GET['nombre']."</h1>";
        echo "<a href='index.php'>Escribir otro nombre</a>";
    }
   

  
    
  
?>

</body>
</html>