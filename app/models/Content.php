<?php
require_once(__DIR__.'/../config/db.php');

abstract class Content extends Db {

    protected function saveBaseContent($courseId, $contentType, $contentUrl) {
        try {

            $sql = "INSERT INTO Contents (content_id, content_type, content_url) VALUES (:content_id, :content_type, :content_url)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':content_id', $courseId);
            $stmt->bindParam(':content_type', $contentType);
            $stmt->bindParam(':content_url', $contentUrl);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            throw new Exception("Error saving content: " . $e->getMessage());
        }
    }
    protected function updateBaseContent($courseId, $contentType, $contentUrl){
        try{
            $sql = "UPDATE Contents SET content_type = :content_type, content_url = :content_url WHERE content_id = :content_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':content_id', $courseId);
            $stmt->bindParam(':content_type', $contentType);
            $stmt->bindParam(':content_url', $contentUrl);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error updating content: " . $e->getMessage());
        }

    }
    abstract public function save($courseId, $contentUrl, $specificData);
}
?>