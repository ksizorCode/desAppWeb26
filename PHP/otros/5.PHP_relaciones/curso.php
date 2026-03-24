<?php
require_once 'config.php';

$slug = $_GET['slug'] ?? '';
if (!$slug) {
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}

$course = getCourseBySlug($slug);
if (!$course) {
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}

$students = getStudentsInCourse($course['id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($course['title']); ?> - Detalles del Curso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>/index.php">Inicio</a></li>
                <li class="breadcrumb-item active"><?php echo htmlspecialchars($course['title']); ?></li>
            </ol>
        </nav>

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">Detalles del Curso</h1>
                <div>
                    <a href="<?php echo BASE_URL; ?>/editar-curso.php?slug=<?php echo htmlspecialchars($course['slug']); ?>" class="btn btn-primary btn-sm">Editar</a>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCourseModal">Eliminar</button>
                </div>
            </div>
            <div class="card-body">
                <h2 class="h4"><?php echo htmlspecialchars($course['title']); ?></h2>
                <p class="text-muted"><?php echo htmlspecialchars($course['description']); ?></p>
                <p class="text-muted">Fecha de creación: <?php echo date('d/m/Y', strtotime($course['created_at'])); ?></p>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="h4 mb-0">Estudiantes Matriculados</h2>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#enrollStudentModal">
                    Matricular Estudiante
                </button>
            </div>
            <div class="card-body">
                <?php if (empty($students)): ?>
                    <p class="text-muted">No hay estudiantes matriculados en este curso.</p>
                <?php else: ?>
                    <div class="list-group">
                        <?php foreach ($students as $student): ?>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1"><?php echo htmlspecialchars($student['name']); ?></h5>
                                    <p class="mb-1"><?php echo htmlspecialchars($student['email']); ?></p>
                                </div>
                                <div>
                                    <a href="<?php echo BASE_URL; ?>/estudiante/<?php echo htmlspecialchars($student['slug']); ?>" 
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

        <!-- Modal para matricular estudiante -->
        <div class="modal fade" id="enrollStudentModal" tabindex="-1" aria-labelledby="enrollStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="enrollStudentModalLabel">Matricular Estudiante</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?php echo BASE_URL; ?>/matricular.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                            <input type="hidden" name="action" value="enroll">
                            <div class="mb-3">
                                <label for="student_id" class="form-label">Seleccionar Estudiante</label>
                                <select class="form-select" id="student_id" name="student_id" required>
                                    <option value="">Seleccione un estudiante</option>
                                    <?php
                                    $conn = connectDB();
                                    $allStudents = $conn->query("SELECT * FROM students ORDER BY name")->fetch_all(MYSQLI_ASSOC);
                                    $conn->close();
                                    foreach ($allStudents as $student): 
                                        // Verificar si el estudiante ya está matriculado
                                        $isEnrolled = false;
                                        foreach ($students as $enrolledStudent) {
                                            if ($enrolledStudent['id'] === $student['id']) {
                                                $isEnrolled = true;
                                                break;
                                            }
                                        }
                                        if (!$isEnrolled):
                                    ?>
                                        <option value="<?php echo $student['id']; ?>">
                                            <?php echo htmlspecialchars($student['name']); ?>
                                        </option>
                                    <?php 
                                        endif;
                                    endforeach; 
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Matricular</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal para eliminar curso -->
        <div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="deleteCourseModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteCourseModalLabel">Eliminar Curso</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Está seguro de que desea eliminar este curso? Esta acción no se puede deshacer.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form action="<?php echo BASE_URL; ?>/eliminar-curso.php" method="POST" class="d-inline">
                            <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
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