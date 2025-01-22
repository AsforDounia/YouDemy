
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

    // get Total Enrollments
    public function getTotalEnrollments($teacher_id) {
        try{
            $sql = "SELECT COUNT(Enrollments.student_id) FROM Enrollments JOIN Courses ON Enrollments.course_id = Courses.course_id WHERE Courses.teacher_id = :teacher_id ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':teacher_id', $teacher_id);
            $stmt->execute();
            $result = $stmt->fetchColumn();
            return $result;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }



    public function getStudentCourses($studentID) {
            $query = "SELECT courses.course_id, courses.title, courses.description, categories.category_name, users.full_name, users.profile_picture, contents.content_type, contents.content_url, GROUP_CONCAT(tags.tag_name ORDER BY tags.tag_name SEPARATOR ', ') AS tag_name FROM Courses AS courses JOIN Enrollments on courses.course_id = Enrollments.course_id  INNER JOIN Categories AS categories ON courses.category_id = categories.category_id INNER JOIN Users AS users ON courses.teacher_id = users.user_id INNER JOIN Contents AS contents ON courses.course_id = contents.content_id LEFT JOIN CourseTags AS coursetags ON courses.course_id = coursetags.course_id LEFT JOIN Tags AS tags ON coursetags.tag_id = tags.tag_id WHERE Enrollments.student_id = :student_id GROUP BY courses.course_id ORDER BY courses.course_id;";
            $stmt = $this->conn->prepare($query);
            $stmt->execute(['student_id' => $studentID]);
        
            $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function enrollInCourse($student_id, $courseID){
        try{
            $query = "INSERT INTO Enrollments (student_id, course_id) VALUES (:student_id, :courseID)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':student_id', $student_id);
            $stmt->bindParam(':courseID', $courseID);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}
