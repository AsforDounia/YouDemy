
<?php
require_once(__DIR__ . '/../config/db.php');

class Teacher extends Db {
    public function __construct() {
        parent::__construct();
    }

    // Les Top 3 enseignants
    public function getTop3Teachers() {
        $sql = "SELECT users.user_id, users.full_name, COUNT(enrollments.course_id) AS total_enrollments FROM Users INNER JOIN courses ON users.user_id = courses.teacher_id INNER JOIN Enrollments ON courses.course_id = enrollments.course_id GROUP BY users.user_id ORDER BY total_enrollments DESC LIMIT 3; ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Total Pending Teachers
    public function getTotalPendingTeachers() {
        $sql = "SELECT COUNT(*) FROM Users WHERE role = 'Teacher' AND status ='Suspended' AND created_at = updated_at";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result;

        }




}
