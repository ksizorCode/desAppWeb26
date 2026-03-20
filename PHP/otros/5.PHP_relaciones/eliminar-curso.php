<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$courseId = $_POST['course_id'] ?? '';
if (!$courseId) {
    header('Location: index.php');
    exit;
}

$conn = connectDB();

// Primero verificamos que el curso existe
$stmt = $conn->prepare("SELECT slug FROM courses WHERE id = ?");
$stmt->bind_param("i", $courseId);
$stmt->execute();
$result = $stmt->get_result();
$course = $result->fetch_assoc();
$stmt->close();

if (!$course) {
    header('Location: index.php');
    exit;
}

// Eliminar el curso (las matrículas se eliminarán automáticamente por la restricción ON DELETE CASCADE)
$stmt = $conn->prepare("DELETE FROM courses WHERE id = ?");
$stmt->bind_param("i", $courseId);

if ($stmt->execute()) {
    // Redirigir al índice con mensaje de éxito
    header('Location: index.php?success=curso_eliminado');
} else {
    // Redirigir de vuelta al curso con mensaje de error
    header('Location: curso.php?slug=' . urlencode($course['slug']) . '&error=eliminar_curso');
}

$stmt->close();
$conn->close();