<? require_once '../functions.php';
// Crear Conexión
$conn = new mysqli(SERV, USER, PASS, DBNM);
// Verificar Conexión
if ($conn->connect_error) {
  die("La conexión ha fallado: " . $conn->connect_error);
}

// Consulta SQL:
$sql = "CREATE TABLE IF NOT EXISTS `alumnos` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, # ID único
  `nombre` VARCHAR(100) NOT NULL,                # Nombre
  `apellido` VARCHAR(100) NOT NULL,              # Apellido
  `rol` VARCHAR(20) DEFAULT 'Alumno',            # Alumno, Profesor, Fantasma, Staff
  `foto` VARCHAR(255),                           # Dirección o URL de la imagen
  `emoji` VARCHAR(10),                           # Campo exclusivo para el emoticono
  `email` VARCHAR(150) UNIQUE,                   # Email único
  `telefono` VARCHAR(20),                        # Teléfono
  `casa` VARCHAR(50),                            # Casa de Hogwarts
  `direccion` VARCHAR(255),                      # Dirección
  `anio_nacimiento` INT,                         # Año nacimiento
  `ciudad` VARCHAR(100),                         # Ciudad
  `curso` INT,                                   # NULL para profesores  `actividades_extra` VARCHAR(255),              # Clubes
  `actividades_extra` VARCHAR(255),              # listado de actividades extra del alumno
  `patronus` VARCHAR(50),                        # Forma del Patronus
  `notas_interes` TEXT,                          # Datos extra
  `fecha_registro` TIMESTAMP DEFAULT CURRENT_TIMESTAMP # Fecha auto
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;";

if ($conn->query($sql) === TRUE) {
  echo "La tabla Alumnos ha sido creada satisfactoriamente";
} else {
  echo "Error al crear la base de datos " . $conn->error;
}

$conn->close();
?>



<? me_header();?>

<h1>Tabla Creada en base de datos</h1>

<? me_footer();?>
