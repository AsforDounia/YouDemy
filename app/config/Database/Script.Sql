DROP DATABASE IF EXISTS YouDemy;
CREATE DATABASE YouDemy;
USE YouDemy;

CREATE TABLE `users` (
  `user_id` int(11) AUTO_INCREMENT PRIMARY KEY,
  `full_name` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` enum('Suspended','Active') DEFAULT 'Active',
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` enum('Admin','Teacher','Student') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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


-- INSERT INTO `users` ( `full_name`, `email`, `password`, `role`, `created_at` , `updated_at`) VALUES
-- ('admin', 'admin@gmail.com', '$2y$10$t08pnC/MXhaUxgKrSyd.NOq.9/NSLfLetJdyU3//1bgwJe7cuSV1e', 'admin',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
-- ('Student1', 'Student1@gmail.com', '$2y$10$t08pnC/MXhaUxgKrSyd.NOq.9/NSLfLetJdyU3//1bgwJe7cuSV1e', 'Student',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
-- ('Teacher1', 'Teacher1@gmail.com', '$2y$10$0oT/LEQ1k.knep9Xf5K.S.CiVhShih6jvwDbQFvW4Pzui5AKnzzMS', 'Teacher',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);




-- Insertion de 10 utilisateurs
INSERT INTO `users` (`full_name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
('Admin', 'admin@gmail.com', '$2y$10$t08pnC/MXhaUxgKrSyd.NOq.9/NSLfLetJdyU3//1bgwJe7cuSV1e', 'Admin', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Student1', 'student1@gmail.com', '$2y$10$t08pnC/MXhaUxgKrSyd.NOq.9/NSLfLetJdyU3//1bgwJe7cuSV1e', 'Student', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Student2', 'student2@gmail.com', '$2y$10$t08pnC/MXhaUxgKrSyd.NOq.9/NSLfLetJdyU3//1bgwJe7cuSV1e', 'Student', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Student3', 'student3@gmail.com', '$2y$10$t08pnC/MXhaUxgKrSyd.NOq.9/NSLfLetJdyU3//1bgwJe7cuSV1e', 'Student', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Teacher1', 'teacher1@gmail.com', '$2y$10$t08pnC/MXhaUxgKrSyd.NOq.9/NSLfLetJdyU3//1bgwJe7cuSV1e', 'Teacher', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Teacher2', 'teacher2@gmail.com', '$2y$10$t08pnC/MXhaUxgKrSyd.NOq.9/NSLfLetJdyU3//1bgwJe7cuSV1e', 'Teacher', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Student4', 'student4@gmail.com', '$2y$10$t08pnC/MXhaUxgKrSyd.NOq.9/NSLfLetJdyU3//1bgwJe7cuSV1e', 'Student', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Student5', 'student5@gmail.com', '$2y$10$t08pnC/MXhaUxgKrSyd.NOq.9/NSLfLetJdyU3//1bgwJe7cuSV1e', 'Student', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Teacher3', 'teacher3@gmail.com', '$2y$10$t08pnC/MXhaUxgKrSyd.NOq.9/NSLfLetJdyU3//1bgwJe7cuSV1e', 'Teacher', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Student6', 'student6@gmail.com', '$2y$10$t08pnC/MXhaUxgKrSyd.NOq.9/NSLfLetJdyU3//1bgwJe7cuSV1e', 'Student', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

-- Insertion de 10 catégories
INSERT INTO `Categories` (`category_name`) VALUES
('Development'),
('Business'),
('IT & Software'),
('Design'),
('Marketing'),
('Photography'),
('Music'),
('Personal Development'),
('Health & Fitness'),
('Finance & Accounting');

-- Insertion de 10 cours
INSERT INTO `Courses` (`title`, `description`, `content_url`, `category_id`, `teacher_id`, `course_type`) VALUES
('HTML Basics', 'Learn the basics of HTML.', 'url1', 1, 5, 'Document'),
('CSS Advanced', 'Advanced concepts in CSS.', 'url2', 1, 5, 'Document'),
('JavaScript Essentials', 'Core concepts of JavaScript.', 'url3', 1, 6, 'Video'),
('Business Strategy', 'Master business strategies.', 'url4', 2, 6, 'Document'),
('UI/UX Design', 'User interface and experience design.', 'url5', 4, 9, 'Video'),
('Digital Marketing', 'Marketing in the digital age.', 'url6', 5, 9, 'Document'),
('Python Programming', 'Learn Python programming.', 'url7', 1, 5, 'Video'),
('Photography Basics', 'Introduction to photography.', 'url8', 6, 9, 'Video'),
('Music Production', 'Produce your own music.', 'url9', 7, 9, 'Document'),
('Personal Finance', 'Manage your finances effectively.', 'url10', 10, 6, 'Video');

-- Insertion de 10 inscriptions
INSERT INTO `Enrollments` (`student_id`, `course_id`, `grade`, `status`) VALUES
(2, 1, 'A', 'Completed'),
(3, 2, 'B', 'In Progress'),
(4, 3, 'A', 'Completed'),
(7, 4, 'C', 'In Progress'),
(8, 5, 'B', 'Completed'),
(2, 6, 'A', 'Completed'),
(3, 7, 'B', 'In Progress'),
(4, 8, 'A', 'Completed'),
(7, 9, 'B', 'Completed'),
(8, 10, 'A', 'In Progress');

-- Insertion de 10 tags
INSERT INTO `Tags` (`tag_name`) VALUES
('HTML'),
('CSS'),
('JavaScript'),
('Business'),
('Design'),
('Marketing'),
('Python'),
('Photography'),
('Music'),
('Finance');

-- Insertion de 10 associations de tags aux cours
INSERT INTO `CourseTags` (`tag_id`, `course_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);
