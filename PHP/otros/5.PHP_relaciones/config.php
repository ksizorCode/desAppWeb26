<?php

// Base URL configuration
define('BASE_URL', 'http://thefinalproject.local/TheFinalProject/NEW_ORDER/5.PHP_relaciones');

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'student_courses');

// Connect to database
function connectDB() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");
    return $conn;
}

// Helper function to create slug from text
function createSlug($text) {
    $text = strtolower($text);
    $text = str_replace(' ', '-', $text);
    $text = preg_replace('/[^a-z0-9-]/', '', $text);
    return trim($text, '-');
}

// Helper function to get student by slug
function getStudentBySlug($slug) {
    $conn = connectDB();
    $stmt = $conn->prepare("SELECT * FROM students WHERE slug = ?");
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $student;
}

// Helper function to get course by slug
function getCourseBySlug($slug) {
    $conn = connectDB();
    $stmt = $conn->prepare("SELECT * FROM courses WHERE slug = ?");
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $result = $stmt->get_result();
    $course = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $course;
}

// Helper function to get all students enrolled in a course
function getStudentsInCourse($courseId) {
    $conn = connectDB();
    $stmt = $conn->prepare("SELECT students.* FROM students 
                          JOIN student_courses ON students.id = student_courses.student_id 
                          WHERE student_courses.course_id = ?");
    $stmt->bind_param("i", $courseId);
    $stmt->execute();
    $result = $stmt->get_result();
    $students = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();
    return $students;
}

// Helper function to get all courses a student is enrolled in
function getCoursesForStudent($studentId) {
    $conn = connectDB();
    $stmt = $conn->prepare("SELECT courses.* FROM courses 
                          JOIN student_courses ON courses.id = student_courses.course_id 
                          WHERE student_courses.student_id = ?");
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();
    $courses = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();
    return $courses;
}