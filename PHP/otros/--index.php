<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html{
            background: tan;
        }
        body{
            max-width:560px;
            padding: 20px;
            margin: 20px auto;
            font-family: sans-serif;
            background: white;
            border-radius: 20px;
        }

        a{
            text-decoration: none;
            color:grey
        }

        h2{
            color:tan;
        }
    </style>
</head>
<body>

<h1>Índice de archivos PHP</h1>
<h2>What we do in the clasroom</h2>

<ul>
    <li><a href="dia3">Dia 3</a></li>
    <li><a href="alumnado/alumnos.php">Bucles de Alumnos</a></li>
</ul>



<?php

$datos=[
    // Nombre ,     Ruta ,              Visible/activo/inactivo
    ['Dia 1',       '/dia1',                    1   ],
    ['Variables',   '/var/mivariable.php',      1   ],
    ['JSON',       '/JSON',                     1   ],
    ['cargarJSON',  '/JSON/cargarJSON.php',     1   ],
    ['GET',         '/GET',                     1   ],
    ['JSON2',       '/JSON/json2/json2.php',         1   ],
    ['Dia 6',       '/dia6',                    1   ],
    ['Cervezas',       '/moises',                    1   ],
    ['Dia 7',       '/dia7',                    0   ]
];

foreach($datos as $valor){
    if($valor[2]){
    echo '<li>Carpeta: <a href="'.$valor[1].'">'.$valor[0].'</a></li>';
    }
}

/*
//Con el bucle for
for($i=0; $i<count($datos); $i++){
    echo '<li><a href="'.$datos[$i][1].'">'.$datos[$i][0].'</a></li>';
}
*/



?>


    
</body>
</html>