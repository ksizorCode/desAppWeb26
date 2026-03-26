<?

/* Config */
require 'config.php';




/* Configuraicón básica */
function getheader(){
    include 'inc/header.php';
}

function getfooter(){
    include 'inc/footer.php';
}









/* BASE DE DATOS */

// =========================================
// 🔌 FUNCIÓN DE CONEXIÓN
// =========================================
function conn(){

    // Crear conexión
    $conn = new mysqli(SERV, USER, PASS, DBNM);

    // Validar conexión
    if ($conn->connect_error) {
        die("❌ Error de conexión: " . $conn->connect_error);
    }

    // Establecer charset (IMPORTANTE para tildes/emojis)
    $conn->set_charset("utf8mb4");

    return $conn; // 👈 Devolvemos la conexión
}


// =========================================
// 📊 FUNCIÓN DE CONSULTA
// =========================================
function consulta($sql){

    // Obtener conexión
    $conn = conn();

    // Ejecutar consulta
    $result = $conn->query($sql);

    // Validar errores en la consulta
    if (!$result) {
        die("❌ Error en la consulta: " . $conn->error);
    }

    // Array donde guardaremos los datos
    $data = [];

    // Si hay resultados
    if ($result->num_rows > 0) {

        // Recorrer resultados
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    // Cerrar conexión
    $conn->close();

    return $data; // 👈 Devolvemos siempre el array
}



/* Modo Debug */

function debug_print_r($cosa, $texto = ''){

    if (DEBUG) {
        echo '<div class="debug">';
            // 👇 Solo mostrar span si hay texto
            // echo !empty($texto) ? '<span>'.$texto.'</span>' : '';

            if (!empty($texto)) {
                echo '<span>' . $texto . '</span>';
            }

        echo '<pre><code>';

        // 📦 Si es array o objeto
        if (is_array($cosa) || is_object($cosa)) {
            print_r($cosa);
        }
        else{
            echo $cosa;
        }
        echo '</code></pre></div>';
    }
}




/* Formatear Fechas */


function formatear_fecha($fecha) {
    // Configuramos locale en español
    setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'spanish');

    // Creamos objeto DateTime
    $dt = new DateTime($fecha);

    // Formato: Jueves 05 Enero de 1458
    return strftime('%A %d %B de %Y', $dt->getTimestamp());
}
