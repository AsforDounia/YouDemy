DROP DATABASE IF EXISTS YouDemy;
CREATE DATABASE YouDemy;
USE YouDemy;

CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100),
    password VARCHAR(255),
    email VARCHAR(100) UNIQUE,
    status VARCHAR(50) DEFAULT CASE
        WHEN role = 'Teacher' THEN 'Disabled'
        ELSE 'Active'
    END,
    profile_picture VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    role ENUM('Admin', 'Teacher', 'Student')
);

CREATE TABLE Categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100)
);


CREATE TABLE Courses (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    description TEXT,
    content_url VARCHAR(255),
    category_id INT,
    teacher_id INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    course_type ENUM('Document', 'Video'),
    FOREIGN KEY (category_id) REFERENCES Categories(category_id) ON DELETE SET NULL,
    FOREIGN KEY (teacher_id) REFERENCES Users(user_id) ON DELETE SET NULL
);


CREATE TABLE Enrollments (
    student_id INT,
    course_id INT,
    enrollment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    grade VARCHAR(10),
    status VARCHAR(50),
    PRIMARY KEY (student_id, course_id),
    FOREIGN KEY (student_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES Courses(course_id) ON DELETE CASCADE
);

CREATE TABLE Tags (
    tag_id INT AUTO_INCREMENT PRIMARY KEY,
    tag_name VARCHAR(100)
);


CREATE TABLE CourseTags (
    tag_id INT,
    course_id INT,
    PRIMARY KEY (tag_id, course_id),
    FOREIGN KEY (tag_id) REFERENCES Tags(tag_id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES Courses(course_id) ON DELETE CASCADE
);


INSERT INTO `users` ( `full_name`, `email`, `password`, `role`, `created_at` , `updated_at`) VALUES
('admin', 'admin@gmail.com', '$2y$10$t08pnC/MXhaUxgKrSyd.NOq.9/NSLfLetJdyU3//1bgwJe7cuSV1e', 'admin',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
('Student1', 'Student1@gmail.com', '$2y$10$t08pnC/MXhaUxgKrSyd.NOq.9/NSLfLetJdyU3//1bgwJe7cuSV1e', 'Student',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
('Teacher1', 'Teacher1@gmail.com', '$2y$10$0oT/LEQ1k.knep9Xf5K.S.CiVhShih6jvwDbQFvW4Pzui5AKnzzMS', 'Teacher',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);

