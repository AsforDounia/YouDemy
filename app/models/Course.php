<?php
require_once(__DIR__ . '/../config/db.php');

class Course extends Db {
    public function __construct() {
        parent::__construct();
    }

    // public function getAllCourses($teacherId = null) {
    //     if($teacherId != null){
    //         $query = "SELECT courses.course_id, courses.title, courses.description, courses.content_url, courses.course_type, categories.category_name, users.full_name , profile_picture, GROUP_CONCAT(tags.tag_name ORDER BY tags.tag_name SEPARATOR ' , ') AS tag_name FROM courses INNER JOIN categories ON courses.category_id = categories.category_id INNER JOIN users ON courses.teacher_id = users.user_id LEFT JOIN coursetags ON courses.course_id = coursetags.course_id LEFT JOIN tags ON coursetags.tag_id = tags.tag_id WHERE teacher_id = :teacher_id GROUP BY courses.course_id ORDER BY courses.course_id;";
    //         $stmt = $this->conn->prepare($query);
    //         $stmt->execute(['teacher_id' => $teacherId]);
    //     }else{
    //         $query = "SELECT courses.course_id, courses.title, courses.description, courses.content_url, courses.course_type, categories.category_name, users.full_name , profile_picture, GROUP_CONCAT(tags.tag_name ORDER BY tags.tag_name SEPARATOR ' , ') AS tag_name FROM courses INNER JOIN categories ON courses.category_id = categories.category_id INNER JOIN users ON courses.teacher_id = users.user_id LEFT JOIN coursetags ON courses.course_id = coursetags.course_id LEFT JOIN tags ON coursetags.tag_id = tags.tag_id GROUP BY courses.course_id ORDER BY courses.course_id;";
    //         $stmt = $this->conn->prepare($query);
    //         $stmt->execute();
    //     }
    //     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }


    public function getAllCourses($teacherId = null) {
        if ($teacherId != null) {
            $query = "SELECT courses.course_id, courses.title, courses.description, categories.category_name, users.full_name, users.profile_picture, contents.content_type, contents.content_url, GROUP_CONCAT(tags.tag_name ORDER BY tags.tag_name SEPARATOR ', ') AS tag_name FROM Courses AS courses INNER JOIN Categories AS categories ON courses.category_id = categories.category_id INNER JOIN Users AS users ON courses.teacher_id = users.user_id INNER JOIN Contents AS contents ON courses.course_id = contents.content_id LEFT JOIN CourseTags AS coursetags ON courses.course_id = coursetags.course_id LEFT JOIN Tags AS tags ON coursetags.tag_id = tags.tag_id WHERE courses.teacher_id = :teacher_id GROUP BY courses.course_id ORDER BY courses.course_id;";
            $stmt = $this->conn->prepare($query);
            $stmt->execute(['teacher_id' => $teacherId]);
        } else {
            $query = "SELECT courses.course_id, courses.title, courses.description, categories.category_name, users.full_name, users.profile_picture, contents.content_type, contents.content_url, GROUP_CONCAT(tags.tag_name ORDER BY tags.tag_name SEPARATOR ', ') AS tag_name FROM Courses AS courses INNER JOIN Categories AS categories ON courses.category_id = categories.category_id INNER JOIN Users AS users ON courses.teacher_id = users.user_id INNER JOIN Contents AS contents ON courses.course_id = contents.content_id LEFT JOIN CourseTags AS coursetags ON courses.course_id = coursetags.course_id LEFT JOIN Tags AS tags ON coursetags.tag_id = tags.tag_id GROUP BY courses.course_id ORDER BY courses.course_id;";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    

    public function getTotalCourses() {
        $query = "SELECT COUNT(*) FROM courses";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result;
    }

    // Le cour avec le plus d' étudiants
    public function getMostPopularCourse($teacherId = null) {
        // var_dump($teacherId);die();
        if($teacherId != null) {
            $query = "SELECT Courses.course_id, Courses.title, COUNT(Enrollments.student_id) AS total_students FROM Enrollments JOIN Courses ON Enrollments.course_id = Courses.course_id WHERE Courses.teacher_id = :teacher_id  GROUP BY Courses.course_id ORDER BY total_students DESC LIMIT 1;";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':teacher_id', $teacherId);
        }
        else {
            $query = "SELECT Courses.course_id, Courses.title, COUNT(Enrollments.student_id) AS total_students FROM Enrollments JOIN Courses ON Enrollments.course_id = Courses.course_id GROUP BY Courses.course_id ORDER BY total_students DESC LIMIT 1;";
            $stmt = $this->conn->prepare($query);
        }

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
        }



    public function createCourse($data) {
        $sql = "INSERT INTO courses (title, description, content, category, teacher_id) VALUES (:title, :description, :content, :tags, :category, :teacher_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content'],
            'tags' => $data['tags'],
            'category' => $data['category'],
            'teacher_id' => $data['teacher_id'],
        ]);
    }

    // public function getCoursesByTeacher($teacherId) {
    //     $sql = "SELECT * FROM Courses INNER JOIN Categories ON Courses.category_id = Categories.category_id WHERE teacher_id = :teacher_id";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute(['teacher_id' => $teacherId]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getStatisticsByTeacher($teacherId) {
        $sql = "SELECT COUNT(*) as total_courses, SUM(enrollments) as total_enrollments FROM courses WHERE teacher_id = :teacher_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['teacher_id' => $teacherId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // New Courses
    public function getNewCourses() {
        $sql = "SELECT * FROM courses ORDER BY created_at DESC LIMIT 3";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteCourse($course_id){
        $sql = "DELETE FROM courses WHERE course_id = :course_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['course_id' => $course_id]);
        return true;
    }


    public function distributionOfCourses(){
        $sql = "SELECT Categories.category_name, COUNT(Courses.course_id) AS total_courses FROM Categories LEFT JOIN Courses ON Categories.category_id = Courses.category_id GROUP BY Categories.category_name;" ;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    // get Total Teacher Courses
    public function getTotalTeacherCourses($teacherId) {
        $sql = "SELECT COUNT(*) FROM courses WHERE teacher_id = :teacher_id ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['teacher_id' => $teacherId]);
        $result = $stmt->fetchColumn();
        return $result;
    }
    //  Distribution Of Courses By Enrollments
    public function distributionOfCoursesByEnrollments($teacherId){
        $sql = "SELECT Courses.course_id, Courses.title, COUNT(Enrollments.student_id) AS total_students FROM Enrollments JOIN Courses ON Enrollments.course_id = Courses.course_id WHERE Courses.teacher_id = :teacher_id GROUP BY Courses.course_id ORDER BY total_students DESC;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['teacher_id' => $teacherId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }






    public function saveCourse($title, $description, $categoryId, $teacherId, Content $content, $contentUrl, $specificData) {
        try {
            // $this->conn->beginTransaction();
            
            // Insert course
            $stmt = $this->conn->prepare("INSERT INTO Courses (title, description, category_id, teacher_id) VALUES (:title, :description, :category_id, :teacher_id)");
            $stmt->execute([
                ':title' => $title,
                ':description' => $description,
                ':category_id' => $categoryId,
                ':teacher_id' => $teacherId
            ]);
            
            $courseId = (int)$this->conn->lastInsertId();
            // Save the content
            $content->save($courseId, $contentUrl, $specificData);
            
    
            
            // $this->conn->commit();
            return $courseId;
        } catch (Exception $e) {
            $this->conn->rollBack();
            throw new Exception("Error saving course: " . $e->getMessage());
        }
    }

    public function modifyCourse($params) {
        try {
            // $params = [
            //     'title' => $title,
            //     'description' => $description,
            //     'category' => $category,
            //     'content_type' => $contentType,
            //     'content_url' => $contentUrl,
            //     'course_id' => $courseId,
            //     'content' => $content,
            //     'specificData' => $specificData

            // ];
         

            $sql = "UPDATE courses SET title = :title, description = :description, category_id = :category WHERE course_id = :course_id";
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                'title' => $params['title'],
                'description' => $params['description'],
                'category' => $params['category'],
                'course_id' => $params['course_id']
            ]);
            $params['content']->updateContent($params['course_id'], $params['content_url'] , $params['specificData']);
            
        } catch (Exception $e) {
            throw new Exception("Error modifying course: " . $e->getMessage());
        }
    }

    // public function getStudentsByCourse($courseId) {
    //     try {
    //         $stmt = $this->conn->prepare("
    //             SELECT 
    //                 u.user_id,
    //                 u.full_name,
    //                 u.email,
    //                 e.enrollment_date,
    //                 e.grade,
    //                 e.status
    //             FROM Enrollments e
    //             JOIN Users u ON e.student_id = u.user_id
    //             WHERE e.course_id = :course_id
    //             ORDER BY e.enrollment_date DESC
    //         ");

    //         $stmt->execute([':course_id' => $courseId]);
    //         return $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     } catch (Exception $e) {
    //         throw new Exception("Error fetching students by course: " . $e->getMessage());
    //     }
    // }

    public function getTeacherEnrollmentsByCourse($teacherId) {
        try {
            $sql = "
            SELECT 
                courses.course_id  AS course_id,
                courses.title AS course_title,
                categories.category_name AS category_name,
                Contents.content_type,
                enrollments.student_id,
                users.full_name AS student_name,
                enrollments.enrollment_date,
                enrollments.status
            FROM 
                courses
            LEFT JOIN 
                categories ON courses.category_id = categories.category_id
            LEFT JOIN 
                enrollments ON courses.course_id  = enrollments.course_id
            LEFT JOIN 
                users ON enrollments.student_id = users.user_id
            JOIN Contents ON courses.course_id = Contents.content_id
            WHERE 
                courses.teacher_id = :teacher_id
            ORDER BY 
                courses.course_id , enrollments.enrollment_date DESC
        ";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['teacher_id' => $teacherId]);
    
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des inscriptions : " . $e->getMessage());
        }
    }

}


