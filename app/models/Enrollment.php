
<?php
require_once(__DIR__ . '/../config/db.php');

class Enrollment extends Db {

    // Le cour avec le plus d' étudiants
    public function getMostEnrolledCourse() {
        try{
            $query = "SELECT * FROM enrollments INNER JOIN courses on enrollments.course_id = courses.course_id GROUP BY enrollments.course_id ORDER BY COUNT(enrollments.course_id) DESC LIMIT 1";
            $stmt = $this->conn->prepare($query);
            if( $stmt->execute() ){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            }
            else{
                return false;
            }

        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            }
    }




}
