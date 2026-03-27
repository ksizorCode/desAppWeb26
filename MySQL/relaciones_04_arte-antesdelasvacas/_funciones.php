<?

//-- config.php
const SERV = "localhost";
const USER = "root";
const PASS = "root";
const DBNM = "arte";


// -- function.php

function conn(){
    $conn = new mysqli(SERV, USER, PASS, DBNM);

    //forzar UTF-8
    $conn->set_charset("utf8mb4");

    // Revisar conexión
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}


function consulta($sql){
    // realizar conexión
    $conn= conn();

    // Ejecutar consulta
    $result = $conn->query($sql);

    // Arran donde almacenaremos los datos
    $data=[];

    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[]=$row;
        }
    }
    else {
    echo "0 results";
    }

    $conn->close();
    return $data;
}










?>




<header>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="buscar.php">Buscar</a></li>
            <li><a href="paginacion.php">Paginacion</a></li>
        </ul>
    </nav>
</header>
