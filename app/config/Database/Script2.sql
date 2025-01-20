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
  category_id INT,
  teacher_id INT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (category_id) REFERENCES Categories(category_id) ON DELETE SET NULL,
  FOREIGN KEY (teacher_id) REFERENCES Users(user_id) ON DELETE SET NULL
);

CREATE TABLE Contents (
  content_id INT PRIMARY KEY,
  content_type ENUM('Document', 'Video'),
  content_url VARCHAR(255),

  FOREIGN KEY (content_id) REFERENCES Courses(course_id) ON DELETE CASCADE
);

CREATE TABLE ContentVideos (
  content_id INT PRIMARY KEY,
  video_duration INT,
  FOREIGN KEY (content_id) REFERENCES Contents(content_id) ON DELETE CASCADE
);


CREATE TABLE ContentDocuments (
  content_id INT PRIMARY KEY,
  document_format VARCHAR(50),
  FOREIGN KEY (content_id) REFERENCES Contents(content_id) ON DELETE CASCADE
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

INSERT INTO Categories (category_name) VALUES
('Web Development'),
('Data Science'),
('Design'),
('Marketing'),
('Photography'),
('Business'),
('Personal Development'),
('Programming Languages'),
('Cybersecurity'),
('AI & Machine Learning');

-- Insertion des cours
INSERT INTO Courses (title, description, category_id, teacher_id) VALUES
('Learn PHP', 'Comprehensive course on PHP programming.', 1, 9),
('Master Python', 'Advanced Python programming techniques.', 2, 5),
('Graphic Design Basics', 'Introduction to design concepts.', 3, 6),
('SEO Fundamentals', 'Learn the basics of SEO.', 4, 9),
('Photography 101', 'A beginner-friendly photography course.', 5, 5),
('Business Strategy', 'Key strategies for business success.', 6, 6),
('Stress Management', 'Techniques for personal development.', 7, 9),
('JavaScript for Beginners', 'An introduction to JavaScript.', 1, 5),
('Introduction to Cybersecurity', 'Fundamentals of cybersecurity.', 9, 6),
('AI Concepts', 'Basic concepts of AI and machine learning.', 10, 9),
('ReactJS Essentials', 'Learn to build dynamic web applications using ReactJS.', 1, 6),
('Data Visualization with Python', 'Techniques for visualizing data effectively.', 2, 5),
('Advanced CSS Techniques', 'Take your CSS skills to the next level.', 3, 9),
('Email Marketing Basics', 'Strategies for successful email campaigns.', 4, 5),
('Portrait Photography', 'Master the art of portrait photography.', 5, 6),
('Entrepreneurship Fundamentals', 'Essential skills for starting a business.', 6, 9),
('Mindfulness Meditation', 'Develop mindfulness through meditation.', 7, 5),
('Ruby on Rails Basics', 'Learn web development with Ruby on Rails.', 8, 6),
('Network Security', 'Protect networks from cyber threats.', 9, 9),
('Deep Learning Foundations', 'Introduction to deep learning concepts.', 10, 5);

-- Insertion des contenus
INSERT INTO Contents (content_id, content_type, content_url) VALUES
(1, 'Video', 'https://www.youtube.com/embed/t0syDUSbdfE'),  -- Learn PHP
(2, 'Document', 'https://www.univ-orleans.fr/iut-orleans/informatique/intra/tuto/php/FastPHP.pdf'),  -- PHP Document
(3, 'Video', 'https://www.youtube.com/embed/mH2-ILnwKYM'),  -- Master Python
(4, 'Document', 'https://docs.python.org/3/tutorial/index.html'),  -- Python Documentation
(5, 'Video', 'https://www.youtube.com/embed/4EkGqO2jv4w'),  -- Graphic Design Basics
(6, 'Document', 'https://www.canva.com/learn/graphic-design/'),  -- Graphic Design Document
(7, 'Video', 'https://www.youtube.com/embed/M8B7U2DVqpM'),  -- SEO Fundamentals
(8, 'Document', 'https://moz.com/learn/seo'),  -- SEO Document
(9, 'Video', 'https://www.youtube.com/embed/XAo6z9VGmWQ'),  -- Photography 101
(10, 'Document', 'https://www.nationalgeographic.com/photography/photo-tips/'),  -- Photography Document
(11, 'Video', 'https://www.youtube.com/embed/EW77kS2mrOY'),  -- ReactJS Essentials
(12, 'Document', 'https://reactjs.org/docs/getting-started.html'),  -- ReactJS Document
(13, 'Video', 'https://www.youtube.com/embed/CpqPLMeUNuU'),  -- Data Visualization with Python
(14, 'Document', 'https://pandas.pydata.org/pandas-docs/stable/user_guide/visualization.html'),  -- Data Visualization Document
(15, 'Video', 'https://www.youtube.com/embed/fNroHZhG5Mw'),  -- Advanced CSS Techniques
(16, 'Document', 'https://www.w3.org/Style/CSS/'),  -- CSS Document
(17, 'Video', 'https://www.youtube.com/embed/5zDaXBU4XtA'),  -- Ruby on Rails Basics
(18, 'Document', 'https://guides.rubyonrails.org/'),  -- Ruby on Rails Document
(19, 'Video', 'https://www.youtube.com/embed/XMUNZbNwaVE'),  -- Deep Learning Foundations
(20, 'Document', 'https://www.deeplearningbook.org/');  -- Deep Learning Document


-- Insertion des contenus vidéo
INSERT INTO ContentVideos (content_id, video_duration) VALUES
(1, 300),
(3, 450),
(5, 600),
(7, 720),
(9, 540),
(11, 400),
(13, 350),
(15, 480),
(17, 390),
(19, 610);

-- Insérer des données dans la table ContentDocuments
INSERT INTO ContentDocuments (content_id, document_format) VALUES
(2, 'PDF'),
(4, 'PDF'),
(6, 'PDF'),
(8, 'PDF'),
(10, 'PDF'),
(12, 'PDF'),
(14, 'PDF'),
(16, 'PDF'),
(18, 'PDF'),
(20, 'PDF');

-- Insérer des données dans la table Enrollments
INSERT INTO Enrollments (student_id, course_id, grade, status) VALUES
(2, 1, 'A', 'Completed'),
(4, 2, 'B', 'Completed'),
(6, 3, 'C', 'Ongoing'),
(8, 4, 'A', 'Ongoing'),
(10, 5, 'B', 'Completed'),
(2, 6, 'A', 'Completed'),
(4, 7, 'B', 'Ongoing'),
(6, 8, 'C', 'Completed'),
(8, 9, 'A', 'Ongoing'),
(10, 10, 'B', 'Completed');

-- Insertion des tags
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

-- Insertion des associations de tags aux cours
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
