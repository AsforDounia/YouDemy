<?php
require_once(__DIR__ . '/../config/db.php');

class Course extends Db {
    public function __construct() {
        parent::__construct();
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
}
