<?php
require_once 'config.php';

$error = '';
$success = '';
$course = null;

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    
    if (empty($title)) {
        $error = 'El título es obligatorio.';
    } else {
        $newSlug = createSlug($title);
        if ($newSlug !== $slug && getCourseBySlug($newSlug)) {
            $error = 'Ya existe un curso con un título similar.';
        } else {
            $conn = connectDB();
            $stmt = $conn->prepare("UPDATE courses SET title = ?, description = ?, slug = ? WHERE id = ?");
            $stmt->bind_param("sssi", $title, $description, $newSlug, $course['id']);
            
            if ($stmt->execute()) {
                $success = 'Curso actualizado correctamente.';
                $course['title'] = $title;
                $course['description'] = $description;
                $course['slug'] = $newSlug;
            } else {
                $error = 'Error al actualizar el curso.';
            }
            
            $stmt->close();
            $conn->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso - Sistema de Gestión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>/index.php">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>/curso.php?slug=<?php echo htmlspecialchars($slug); ?>"><?php echo htmlspecialchars($course['title']); ?></a></li>
                <li class="breadcrumb-item active">Editar</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header">
                <h1 class="h3 mb-0">Editar Curso</h1>
            </div>
            <div class="card-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
                <?php endif; ?>

                <form method="POST" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" class="form-control" id="title" name="title" 
                               value="<?php echo htmlspecialchars($course['title']); ?>" required>
                        <div class="invalid-feedback">El título es obligatorio.</div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($course['description']); ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <a href="<?php echo BASE_URL; ?>/curso.php?slug=<?php echo htmlspecialchars($slug); ?>" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
    </script>
</body>
</html>