<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">Cines Gijón</div>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="admin.php">Admin</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Administrar películas</h1>

        <form action="admin.php" method="post">

            <label for="tit">Título:</label>
                <input type="text" id="tit" name="titulo" placeholder="Título de la película" required>
         
            <label for="dir">Director:</label>
                <input type="text" id="dir" name="director" placeholder="Nombre del director" required>
           
            <label for="car">Cartel:</label>
                <input type="text" id="car" name="cartel" placeholder="URL de la imagen" required>
        
            <input type="submit" value="Guardar Película">
   
        </form>

    <?php
    
    //1. Obtener los datos del POST o GET
    //Si hay datos haz lo siguiente:
    if(isset($_POST['titulo']) && !empty($_POST['titulo']) && isset($_POST['director']) && !empty($_POST['director']) ){
       
        echo "<p>Titulo: ".$_POST['titulo']."</p>";
        echo "<p>Director: ".$_POST['director']."</p>";
        echo "<p>URL Cartel: ".$_POST['cartel']."</p>";
        
        
        $rutaArchivo ='cartelera.json';
        if(file_exists($rutaArchivo)){
            $datosArchivoJSON = file_get_contents($rutaArchivo);
            $listaArray =  json_decode($datosArchivoJSON,true);
            
            
            //2. añadir los datos del GET/POST al final del array listaArray
            array_push($listaArray['pelisCartelera'],["titulo"=>$_POST['titulo'],"director"=>$_POST['director'],"cartel"=>$_POST['cartel']]);
            
            //3. codificar el array listaArray en formato JSON
            $jsonFinal=json_encode($listaArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            //4. guardar el JSON con los nuevos datos
            file_put_contents($rutaArchivo,$jsonFinal);
            
            echo '<pre>';
            print_r($listaArray);
            echo '</pre>';
            
        }
        else{
            echo "No hemos podido cargar $rutaArchivo 😥";
        }
    }
        






    ?>

    </main>
    <footer></footer>    


</body>
</html>