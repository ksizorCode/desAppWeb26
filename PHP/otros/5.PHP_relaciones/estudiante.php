<?php
require_once 'config.php';

$slug = $_GET['slug'] ?? '';
if (!$slug) {
    header('Location: index.php');
    exit;
}

$student = getStudentBySlug($slug);
if (!$student) {
    header('Location: index.php');
    exit;
}

$courses = getCoursesForStudent($student['id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($student['name']); ?> - Detalles del Estudiante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>/index.php">Inicio</a></li>
                <li class="breadcrumb-item active"><?php echo htmlspecialchars($student['name']); ?></li>
            </ol>
        </nav>

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">Detalles del Estudiante</h1>
                <div>
                    <a href="<?php echo BASE_URL; ?>/editar-estudiante.php?slug=<?php echo htmlspecialchars($student['slug']); ?>" class="btn btn-primary btn-sm">Editar</a>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteStudentModal">Eliminar</button>
                </div>
            </div>
            <div class="card-body">
                <h2 class="h4"><?php echo htmlspecialchars($student['name']); ?></h2>
                <p class="text-muted">Email: <?php echo htmlspecialchars($student['email']); ?></p>
                <p class="text-muted">Fecha de registro: <?php echo date('d/m/Y', strtotime($student['created_at'])); ?></p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="h4 mb-0">Cursos Matriculados</h2>
            </div>
            <div class="card-body">
                <?php if (empty($courses)): ?>
                    <p class="text-muted">Este estudiante no está matriculado en ningún curso.</p>
                <?php else: ?>
                    <div class="list-group">
                        <?php foreach ($courses as $course): ?>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1"><?php echo htmlspecialchars($course['title']); ?></h5>
                                    <p class="mb-1"><?php echo htmlspecialchars($course['description']); ?></p>
                                </div>
                                <div>
                                    <a href="<?php echo BASE_URL; ?>/curso.php?slug=<?php echo htmlspecialchars($course['slug']); ?>" 
                                       class="btn btn-info btn-sm me-2">Ver</a>
                                    <form action="<?php echo BASE_URL; ?>/matricular.php" method="POST" class="d-inline">
                                        <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                        <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                                        <input type="hidden" name="action" value="unenroll">
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('¿Está seguro de dar de baja a este estudiante del curso?')">
                                            Dar de baja
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Modal para eliminar estudiante -->
        <div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="deleteStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteStudentModalLabel">Eliminar Estudiante</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Está seguro de que desea eliminar este estudiante? Esta acción no se puede deshacer.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form action="<?php echo BASE_URL; ?>/eliminar-estudiante.php" method="POST" class="d-inline">
                            <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>