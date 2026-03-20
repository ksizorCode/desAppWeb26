<?php
    $color = $_GET['color'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    <?php
    echo "body{
            background:$color;
            }
        ";
    ?>
    </style>
  
</head>
<body>
    
<h1>Cambiar el color de Fondo</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur sed fuga eum voluptatibus, maxime nemo dolorum in ipsam debitis molestiae atque ducimus magnam autem laudantium magni nesciunt consequuntur illo ratione?</p>

    <form action="cambiarColorFondo.php" method="get">
        <label>Seleccionar color:    
            <input type="color" name="color">
        </label>
        <input type="submit" value="Cambiar Color">
    </form>

</body>
</html>