<?php

$alumnos = [
    ['nombre'=>'Luis',          'ciudad'=>'Gijón'],
    ['nombre'=>'Himi',          'ciudad'=>'Gijón'],
    ['nombre'=>'Cesar',         'ciudad'=>'Cudillero'],
    ['nombre'=>'Sergio Dos',    'ciudad'=>'Gijón'],
    ['nombre'=>'Jorge',         'ciudad'=>'Gijón'],
    ['nombre'=>'Roman',         'ciudad'=>'Buenos Aires'],
    ['nombre'=>'Sergio 1',      'ciudad'=>'Oviedo'],
    ['nombre'=>'David',         'ciudad'=>'Gijón'],
    ['nombre'=>'Nadine',        'ciudad'=>'Reims'],
    ['nombre'=>'Jose Manuel',   'ciudad'=>'Gijón'],
    ['nombre'=>'Adalid',        'ciudad'=>'La Habana'],
    ['nombre'=>'Oscar',         'ciudad'=>'Gijón']
];

/*

// BUCLE FOR -  -  -  -  -  -  
    for($i=0; $i<count($alumnos); $i++){
        echo "
        <li>
            <h2>{$alumnos[$i]['nombre']}</h2>
            <p>{$alumnos[$i]['ciudad']}</p>
        </li>";
    }

// OTRAS FORMAS DE CONCATENAR
// con puntos
    for ($i = 0; $i < count($alumnos); $i++) {
        echo "<li>" . 
                "<h2>" . $alumnos[$i]['nombre'] . "</h2>" . 
                "<p>" . $alumnos[$i]['ciudad'] . "</p>" . 
        "</li>";
    }


// almacenando en una variable HTML
    for($i=0; $i<count($alumnos); $i++){
    $html = <<<HTML
    <div class="card">
        <h2>{$alumno['nombre']}</h2>
        <p>Ciudad: {$alumno['ciudad']}</p>
    </div>
    HTML;

    echo $html;
    }

*/

foreach($alumnos as $elemento){
    echo "
    <li>
        <h2>{$elemento['nombre']}</h2>
        <p>{$elemento['ciudad']}</p>
    </li>";
}




?>