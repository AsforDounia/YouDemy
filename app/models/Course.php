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
    public function getMostPopularCourse() {
        $query = "SELECT * FROM courses ORDER BY nb_etudiants DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
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
        $sql = "SELECT c.category_name, COUNT(co.course_id) AS total_courses FROM Categories c LEFT JOIN Courses co ON c.category_id = co.category_id GROUP BY c.category_name;" ;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
