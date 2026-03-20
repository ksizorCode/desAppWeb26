
<nav>
    <ul>
        <li><a href="index.php">Carta</a></li>
        <li><a href="admin.php">Admin</a></li>
    </ul>
</nav>

<?php

    $archivo ='data.json';

    if(file_exists($archivo)){

        $miJSON=file_get_contents($archivo);
        $miArray=json_decode($miJSON,true);

        echo '<ul class="carta">';
        foreach($miArray['carta'] as $plato){
            echo "<li>
                <h2>{$plato['nombre']}</h2>
                <p>{$plato['ingredientes']}</p>
                <span>{$plato['precio']}€</span>
            </li>";
        }
        echo '</ul>';

    }
    else{
        echo "ERROR: No hemos podido cargar los datos";
    }


?>