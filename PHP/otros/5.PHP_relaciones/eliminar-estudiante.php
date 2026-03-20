<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$studentId = $_POST['student_id'] ?? '';
if (!$studentId) {
    header('Location: index.php');
    exit;
}

$conn = connectDB();

// Primero verificamos que el estudiante existe
$stmt = $conn->prepare("SELECT slug FROM students WHERE id = ?");
$stmt->bind_param("i", $studentId);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

if (!$student) {
    header('Location: index.php');
    exit;
}

// Eliminar el estudiante (las matrículas se eliminarán automáticamente por la restricción ON DELETE CASCADE)
$stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
$stmt->bind_param("i", $studentId);

if ($stmt->execute()) {
    // Redirigir al índice con mensaje de éxito
    header('Location: index.php?success=estudiante_eliminado');
} else {
    // Redirigir de vuelta al estudiante con mensaje de error
    header('Location: estudiante.php?slug=' . urlencode($student['slug']) . '&error=eliminar_estudiante');
}

$stmt->close();
$conn->close();