<? require 'bloques/config.php'; ?>
<? include 'bloques/header.php'; ?>


<?php

$archivo = "assets/datos/expo.json";

       $museo= cargarJSON($archivo);
    


        foreach ($museo['expo'] as $obra) {
            echo "<div class='expo'>";
            echo "<img src='{$obra['img']}' alt='{$obra['titulo']}'>";
                echo "<div class='expo-info'>";
                    echo "<h3>{$obra['titulo']}</h3>";
                    echo "<p>{$obra['descripcion']}</p>";
                    echo "<span>📅 {$obra['fecha']}</span>";
                    echo "<a href='{$obra['link']}'>Más información</a>";
                echo "</div>";
            echo "</div>";
        }

        ?>



</section>


<? include 'bloques/footer.php'; ?>