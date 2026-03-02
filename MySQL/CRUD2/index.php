<?
$datos=[
    'titulo'=>'Inicio del CRUD',
    'descripcion'=>'Pagina de Inicio',
    'icono'=>'icon.png',
    'bodyClass'=>'home'
];

require_once 'functions.php'?>
<? me_header();?>

<h1>Bienvenidos a mi CRUD</h1>
<p>El crud es el sistema habitual para:</p>
<ul>
    <li>Crear</li>
    <li>Read (Leer)</li>
    <li>Update (Actualizar / Editar)</li>
    <li>Delete (Borrar)</li>
</ul>

<? me_footer();?>

