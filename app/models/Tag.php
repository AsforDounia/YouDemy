
<?php
require_once(__DIR__ . '/../config/db.php');

class Tag extends Db {
    public function __construct() {
        parent::__construct();
    }
    public function getAllTags() {
        $query = "SELECT * FROM Tags";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // le nombre total des Tags
    public function getTagsCount(){
        $query = "SELECT COUNT(*) FROM Tags";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result;
    }

    // add tag 
    public function addtag($tagName){
        try{
            $query = "INSERT INTO Tags (tag_name) VALUES (:catName)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':catName', $tagName);
            $stmt->execute();
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

    }

    public function deletetag($tagID){
        $query = "DELETE FROM Tags WHERE tag_id = :tagID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tagID', $tagID);
        $stmt->execute();
    }

    public function modifytag($tagID , $tagName){
        try{
            $query = "UPDATE Tags SET tag_name = :catName WHERE tag_id = :tagID";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':catName', $tagName);
            $stmt->bindParam(':tagID', $tagID);
            $stmt->execute();
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function addCourseTags($tagId, $courseId){
        $stmt ="INSERT INTO CourseTags (tag_id, course_id) VALUES (:tag_id, :course_id)";
        $stmt = $this->conn->prepare($stmt);
        $stmt->execute([
            ':tag_id' => $tagId,
            ':course_id' => $courseId
        ]);
        
    }

}
