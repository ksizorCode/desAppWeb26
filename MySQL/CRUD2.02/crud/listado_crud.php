<?php
$datos=[
    'titulo'=>'Listado Crud',
    'descripcion'=>'Listado Interacivo crud',
    'icono'=>'puzzle.png',
    'bodyClass'=>'crud-home'
];


require_once '../functions.php';

// 1. Extraer los datos
$sql = obtener_datos("SELECT * FROM alumnos");

me_header();
?>

<div class="container">
    <h2>Gestión de Alumnos</h2>
    
    <a href="create.php" style="display: inline-block; margin-bottom: 20px; background: green; color: white; padding: 10px; text-decoration: none; border-radius: 5px;">
        + Nuevo Alumno
    </a>

    <table border="1" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f4f4f4;">
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($sql)): ?>
                <tr><td colspan="4" style="text-align: center;">No hay registros</td></tr>
            <?php else: ?>
                <?php foreach ($sql as $u): ?>
                    <tr>
                        <td style="padding: 8px; text-align: center;"><?php echo $u['id']; ?></td>
                        <td style="padding: 8px;"><?php echo htmlspecialchars($u['nombre']); ?></td>
                        <td style="padding: 8px;"><?php echo htmlspecialchars($u['email']); ?></td>
                        <td style="padding: 8px; text-align: center;">
                            <a href="update.php?id=<?php echo $u['id']; ?>" style="color: blue;">Editar</a> | 
                            <a href="delete.php?id=<?php echo $u['id']; ?>" 
                               style="color: red;" 
                               onclick="return confirm('¿Estás seguro de borrar a este usuario?')">
                               Borrar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php me_footer(); ?>