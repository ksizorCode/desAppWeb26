<? require_once '../functions.php'?>
<?
$datos=[
    'titulo'=>'Iniciar Reseteo',
    'descripcion'=>'Pagina de Iniciar Reseteo',
    'icono'=>'puzzle.png',
    'bodyClass'=>'home'
];?>


<? me_header();?>

<h1>Reset</h1>
<p>Este panel pondrá la base de datos a cero.</p>
<p>Si no sabe lo que está haciendo no toque nada y vallase de aquí:</p>
<ol>
    <h2>Pasito a pasito</h2>
    <li><a href="borrar_db.php">🧨 Borrar Tabla Alumnos</a></li>
    <li><a href="tabla_db.php">🖊Crear Tabla Alumnos</a></li>
    <li><a href="datos_db.php">📃 Insertar Alumnos en tabla Alumnos</a></li>
    <h2>Lo mismo pero del tirón</h2>
    <li><a href="speed_reset.php">🚅 Vacía Tabla y añade Alumnos en tabla Alumnos</a></li>
</ol>

<? me_footer();?>
