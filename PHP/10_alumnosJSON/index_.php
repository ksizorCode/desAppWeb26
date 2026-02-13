<h1>Alumnos</h1>

<a href="formulario.php">Formulario</a>

<?
function printR2($array){
        echo '<pre><code>';
        print_r($array);
        echo '</pre></code>';
    }


//------

//01 carga del JSON
$json = file_get_contents('alumnos.json');

//02 convertir JSON a array PHP (asociativo)
$alumnos = json_decode($json, true);  

//03 comprobamos con print_r
printR2($alumnos);

//04 Añadimos alumno
   array_push($alumnos['alumnos'], ['nombre'=>'Adalid','anio'=>1994]); // añadimos a Adalid
   array_push($alumnos['alumnos'], ['nombre'=>'Oscar','anio'=>1991]); // añadimos a Adalid
   array_push($alumnos['alumnos'], ['nombre'=>'David','anio'=>2003]); // añadimos a Adalid
   array_push($alumnos['alumnos'], ['nombre'=>'Sergio','anio'=>1960]); // añadimos a Adalid

    echo "hemos añadido a Ada y Oscar";
    printR2($alumnos);

//05 Convertir array PHP a JSON
    $newjson= json_encode($alumnos,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

//06 Sobreescribir JSON
    file_put_contents('alumnos2.json',$newjson);





?>
