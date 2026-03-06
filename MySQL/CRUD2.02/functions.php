<?php
//Cargar Config
    require_once 'config.php';

//Funciones
    function me_header(){
        include_once 'inc/_header.php';
    }
    function me_footer(){
        include_once 'inc/_footer.php';
    }


function datos_apartado(string $d): ?string {
    global $datos;

    // Devuelve el valor si existe, sino null
    return $datos[$d] ?? null;
}

function titulo(): void {

    $titulo = datos_apartado('titulo');

    if (!empty($titulo)) {
        echo $titulo.' | '.TITL_APP;
    }
    else{
        echo TITL_APP;
    }
}


function descripcion(): void {

    $descripcion = datos_apartado('descripcion');

    if (empty($descripcion)) {
        $descripcion = DESC_APP;
        }
    echo '<meta name="description" content="' . htmlspecialchars($descripcion, ENT_QUOTES, 'UTF-8') . '">';
}


/**
 * Muestra el favicon si existe
 */
function icono(): void {
    $nombreIcono = datos_apartado('icono');
    if (empty($nombreIcono)) {
        $nombreIcono = ICON_APP;
    }
    // Construimos rutas
    $rutaRelativa = 'assets/icons/' . $nombreIcono;
    $rutaFisica   = PATH . $rutaRelativa;

    if (!file_exists($rutaFisica)) {
        return;
    }

    echo '<link rel="icon" href="' 
        . htmlspecialchars(URL . $rutaRelativa, ENT_QUOTES, 'UTF-8') 
        . '">';
}


/**
 * Genera URL de asset con versión automática basada en fecha de modificación
 *
 * @param string $file Ruta relativa desde la raíz del proyecto
 * @return string URL versionada
 */
function asset(string $file): string {

    $fullPath = PATH . $file;

    if (file_exists($fullPath)) {
        $version = filemtime($fullPath); // timestamp real del archivo
    } else {
        $version = time(); // fallback si no existe
    }

    return URL . $file . '?v=' . $version;
}

// ----- Consulta a Base de datos 


/**
 * Crea y devuelve una conexión a la base de datos
 */

function conectar() {
    $conn = new mysqli(SERV, USER, PASS, DBNM);
    if ($conn->connect_error) { die("Error: " . $conn->connect_error);}
    // ESTA LÍNEA ES VITAL PARA LOS EMOJIS
    $conn->set_charset("utf8mb4"); 
    return $conn;
}

/**
 * Ejecuta una consulta SQL y cierra la conexión automáticamente
 * @param string $sql La consulta a ejecutar
 * @return mixed Retorna el resultado (objeto mysqli_result) o true/false
 */
function consulta($sql) {
    $conn = conectar();
    $resultado = $conn->query($sql);
    
    if (!$resultado) {
        echo "Error en la consulta: " . $conn->error;
    }
    
    $conn->close();
    return $resultado;
}

/**
 * Ejecuta una consulta SELECT y devuelve un array asociativo
 * @param string $sql Consulta SQL
 * @return array Lista de resultados (vacía si no hay datos)
 */
function obtener_datos($sql) {
    // ejecuta función conectar
    $conn = conectar();
    // ejecuta función consulta
    $resultado = $conn->query($sql);
    
    $datos = []; // Array donde guardaremos las filas

    if ($resultado && $resultado->num_rows > 0) {
        // Recorremos cada fila y la añadimos al array
        while($fila = $resultado->fetch_assoc()) {
            $datos[] = $fila;
        }
    }

    $conn->close();
    return $datos;
}

/**
 * Genera una lista <ul> a partir de un array de datos
 * @param array $datos El array devuelto por obtener_datos()
 * @param string $columna El nombre del campo que quieres mostrar
 */
function listar($datos, $columna) {
    if (empty($datos)) {
        echo "<p>No hay datos para mostrar.</p>";
        return;
    }

    echo "<ul>";
    foreach ($datos as $fila) {
        // Usamos htmlspecialchars por seguridad al mostrar datos
        echo "<li>" . htmlspecialchars($fila[$columna]) . "</li>";
    }
    echo "</ul>";
}



/**
 * Genera una tabla HTML automática a partir de un array asociativo
 * @param array $datos El array devuelto por obtener_datos()
 */
function entablar($datos) {
    if (empty($datos)) {
        echo "<p>La tabla está vacía.</p>";
        return;
    }

    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    
    // 1. Generar cabecera usando las llaves del primer registro
    echo "<thead><tr style='background: #eee;'>";
    $columnas = array_keys($datos[0]);
    foreach ($columnas as $col) {
        echo "<th style='padding: 8px;'>" . ucfirst($col) . "</th>";
    }
    echo "</tr></thead>";

    // 2. Generar cuerpo de la tabla
    echo "<tbody>";
    foreach ($datos as $fila) {
        echo "<tr>";
        foreach ($fila as $valor) {
            echo "<td style='padding: 8px;'>" . htmlspecialchars($valor) . "</td>";
        }
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}




/**
 * Genera una lista detallada de todos los campos de un array 
 * @param array $datos El array devuelto por obtener_datos()
 */
function detallar_lista($datos) {
    if (empty($datos)) {
        echo "<p>No hay datos a mostrar. El contenido está vacío.</p>";
        return;
    }

    foreach ($datos as $fila) {
        echo "<div style='border: 1px solid #ccc; margin-bottom: 20px; padding: 15px; border-radius: 8px; font-family: sans-serif;'>";
        echo "<ul style='list-style: none; padding: 0;'>";
        
        foreach ($fila as $campo => $valor) {
            // Ponemos el nombre del campo en negrita y mayúscula inicial
            $etiqueta = ucfirst(str_replace('_', ' ', $campo));
            
            echo "<li style='margin-bottom: 5px;'>";
            echo "<strong>$etiqueta:</strong> " . htmlspecialchars($valor);
            echo "</li>";
        }
        
        echo "</ul>";
        echo "</div>";
    }
}