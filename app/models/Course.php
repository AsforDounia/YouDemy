<?php
require_once(__DIR__ . '/../config/db.php');

class Course extends Db {
    public function __construct() {
        parent::__construct();
    }

    public function getAllCourses() {
        $query = "SELECT * FROM Courses INNER JOIN Categories ON Courses.category_id = Categories.category_id INNER JOIN Users ON Courses.teacher_id = Users.user_id;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
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
        $sql = "INSERT INTO courses (title, description, content, tags, category, teacher_id) VALUES (:title, :description, :content, :tags, :category, :teacher_id)";
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

    public function getCoursesByTeacher($teacherId) {
        $sql = "SELECT * FROM courses WHERE teacher_id = :teacher_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['teacher_id' => $teacherId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

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
}
