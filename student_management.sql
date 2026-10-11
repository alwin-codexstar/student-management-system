CREATE DATABASE IF NOT EXISTS student_management;
USE student_management;

CREATE TABLE IF NOT EXISTS students (
 id INT AUTO_INCREMENT PRIMARY KEY,
 student_code VARCHAR(30) NOT NULL UNIQUE,
 first_name VARCHAR(80) NOT NULL,
 last_name VARCHAR(80) NOT NULL,
 email VARCHAR(150) NOT NULL UNIQUE,
 phone VARCHAR(30),
 course VARCHAR(100) NOT NULL,
 department VARCHAR(100),
 year_level INT NOT NULL,
 date_of_birth DATE,
 gender VARCHAR(20),
 address TEXT,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS attendance (
 id INT AUTO_INCREMENT PRIMARY KEY,
 student_id INT NOT NULL,
 attendance_date DATE NOT NULL,
 status ENUM('Present','Absent','Late') NOT NULL DEFAULT 'Present',
 FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
 UNIQUE KEY unique_attendance (student_id, attendance_date)
);

CREATE TABLE IF NOT EXISTS marks (
 id INT AUTO_INCREMENT PRIMARY KEY,
 student_id INT NOT NULL,
 subject VARCHAR(120) NOT NULL,
 marks DECIMAL(5,2) NOT NULL,
 max_marks DECIMAL(5,2) NOT NULL DEFAULT 100,
 FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);

INSERT IGNORE INTO students
(student_code,first_name,last_name,email,phone,course,department,year_level,date_of_birth,gender,address)
VALUES
('STU001','Arun','Kumar','arun@example.com','9876543210','B.Sc Computer Science','Computer Science',2,'2005-06-12','Male','Madurai'),
('STU002','Priya','Devi','priya@example.com','9876543211','BCA','Computer Applications',3,'2004-09-20','Female','Chennai');
