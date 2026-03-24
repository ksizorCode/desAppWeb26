<?php
require_once 'config.php';

$error = '';
$success = '';
$student = null;

$slug = $_GET['slug'] ?? '';
if (!$slug) {
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}

$student = getStudentBySlug($slug);
if (!$student) {
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    
    if (empty($name) || empty($email)) {
        $error = 'El nombre y el email son obligatorios.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'El email no es válido.';
    } else {
        $newSlug = createSlug($name);
        if ($newSlug !== $slug && getStudentBySlug($newSlug)) {
            $error = 'Ya existe un estudiante con un nombre similar.';
        } else {
            $conn = connectDB();
            $stmt = $conn->prepare("UPDATE students SET name = ?, email = ?, slug = ? WHERE id = ?");
            $stmt->bind_param("sssi", $name, $email, $newSlug, $student['id']);
            
            if ($stmt->execute()) {
                $success = 'Estudiante actualizado correctamente.';
                $student['name'] = $name;
                $student['email'] = $email;
                $student['slug'] = $newSlug;
            } else {
                $error = 'Error al actualizar el estudiante.';
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
    <title>Editar Estudiante - Sistema de Gestión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>/index.php">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>/estudiante.php?slug=<?php echo htmlspecialchars($slug); ?>"><?php echo htmlspecialchars($student['name']); ?></a></li>
                <li class="breadcrumb-item active">Editar</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header">
                <h1 class="h3 mb-0">Editar Estudiante</h1>
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
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="<?php echo htmlspecialchars($student['name']); ?>" required>
                        <div class="invalid-feedback">El nombre es obligatorio.</div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?php echo htmlspecialchars($student['email']); ?>" required>
                        <div class="invalid-feedback">Por favor, introduce un email válido.</div>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <a href="estudiante.php?slug=<?php echo htmlspecialchars($slug); ?>" class="btn btn-secondary">Cancelar</a>
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