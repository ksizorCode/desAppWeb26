<? require 'bloques/config.php'; ?>
<? include 'bloques/header.php'; ?>
    
<h1>Bienvenidos al Museo Dicampus</h1>

<p>Sumérgete en un viaje a través del tiempo y el arte en el Museo Dicampus, que alberga una vasta colección de obras maestras.
 Descubre exposiciones fascinantes, participa en actividades culturales. ¡Explora y aprende con nosotros!</p>

        <?php

        $archivo = "assets/datos/museo.json";

        $museo= cargarJSON($archivo);
        

      


        echo '<ul class="obras">';
        foreach ($museo['obras'] as $obra) {
            echo "<li>";
            echo "<a href='obra.php?o={$obra['titulo']}'>";
            echo "<img src='{$obra['img']}' alt='{$obra['titulo']}'>";
            echo "<h2>{$obra['titulo']}</h2>";
            echo "<p class='autor'>{$obra['autor']}</p>";
            echo "</a>";
            echo "</li>";
        }
        echo '</ul>';
        ?>
        
        <section>
<ul class="horarios">Horarios</ul>

        </section>
<? include 'bloques/footer.php'; ?>
