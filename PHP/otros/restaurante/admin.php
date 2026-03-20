
<nav>
    <ul>
        <li><a href="index.php">Carta</a></li>
        <li><a href="admin.php">Admin</a></li>
    </ul>
</nav>

<form action="admin.php" method="get">
    <input type="text" name="nombrePlato" placeholder="nombre plato" required>
    <textarea type="text" name="ingredientes"  placeholder="ingredientes" required></textarea>
    <input type="number" name="precio"  placeholder="precio" required>

    <input type="submit" value="Guardar Platu">
</form>

<?php
    $archivo ='data.json';
    //cargar JSON y convertirlo en Array PHP
    if(file_exists($archivo)){
        $miJSON=file_get_contents($archivo);
        $miArray=json_decode($miJSON,true);

        
        if(isset($_GET['nombrePlato'])){
            //caputar datos del GET 
            $nombrePlato = $_GET['nombrePlato'];
            $ingredientes = $_GET['ingredientes'];
            $precio =$_GET['precio'];
        
            //meter esos datos en el array miArray
            array_push($miArray['carta'],['nombre'=>$nombrePlato, 'ingredientes'=>$ingredientes,'precio'=>$precio]);
            
            //codificar miArray en formato JSON
            $miJSON = json_encode($miArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            //guardar JSON
            file_put_contents($archivo, $miJSON);      
            
            echo "<div>
                <h2>Plato agregado con exito</h2>
                <h3>$nombrePlato</h3>
                <p>$ingredientes</p>
                <p>$precio</p>
                <a href='index.php'>Ver Carta</a>
            </div>";
        }
    }
    else{
        echo "ERROR: No hemos podido cargar los datos";
    }

?>