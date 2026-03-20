-- Create database if not exists
CREATE DATABASE IF NOT EXISTS student_courses;
USE student_courses;

-- Create students table
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create courses table
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    slug VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create student_courses junction table
CREATE TABLE IF NOT EXISTS student_courses (
    student_id INT,
    course_id INT,
    enrollment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (student_id, course_id),
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

-- Insert sample students
INSERT INTO students (name, email, slug) VALUES
('Juan García', 'juan@email.com', 'juan-garcia'),
('María López', 'maria@email.com', 'maria-lopez'),
('Carlos Rodríguez', 'carlos@email.com', 'carlos-rodriguez');

-- Insert sample courses
INSERT INTO courses (title, description, slug) VALUES
('PHP Básico', 'Curso introductorio de PHP', 'php-basico'),
('JavaScript Avanzado', 'Curso avanzado de JavaScript', 'javascript-avanzado'),
('MySQL y Bases de Datos', 'Fundamentos de bases de datos', 'mysql-bases-datos');

-- Insert sample enrollments
INSERT INTO student_courses (student_id, course_id) VALUES
(1, 1),
(1, 2),
(2, 1),
(3, 3);