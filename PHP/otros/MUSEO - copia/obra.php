<? require 'bloques/config.php'; ?>
<? include 'bloques/header.php'; ?>
    
        <?php
        // Cargamos JSON y lo traducimos a un array PHP
        $archivo = "assets/datos/museo.json";

        $museo= cargarJSON($archivo);
        
        // si existe obra en el GET
        if(isset($_GET['o'])){
                $tituloObra=$_GET['o'];
        }

        // Mostramos recorremos el bucle hasta encontrar la obra seleccionada
        foreach ($museo['obras'] as $obra) {
        if($tituloObra == $obra['titulo']){
            echo '<div class="ficharGrande">';
            echo "<img class='portada' src='{$obra['img']}' alt='{$obra['titulo']}'>";
            echo "<h1>{$obra['titulo']}</h1>";
            echo '<div class="minificha">';
            echo "<p>Autor: {$obra['autor']}</p>";
            echo "<p>Año: {$obra['anio']}</p>";
            echo "<p>Estilo: {$obra['estilo']}</p>";
            echo "<p>Técnica: {$obra['tecnica']}</p>";
            echo '</div>';
            
            echo "<p>{$obra['descripcion']}</p>";
            echo "<img src='{$obra['img']}' alt='{$obra['titulo']}'>";
            echo '</div>';
            break;
                }
        }
        ?>
        
       
<? include 'bloques/footer.php'; ?>
