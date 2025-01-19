<?php
require_once(__DIR__.'/../config/db.php');
require_once (__DIR__.'/../models/Content.php');
class VideoContent extends Content {
    public function save($courseId, $contentUrl, $duration) {
        try {
            // $this->conn->beginTransaction();
            
            // Save base content
            parent::saveBaseContent($courseId, 'Video', $contentUrl);
            
            // Save video specific data
            $stmt = $this->conn->prepare("INSERT INTO ContentVideos (content_id, video_duration) VALUES (:content_id, :duration)");
            
            $stmt->execute([
                ':content_id' => $courseId,
                ':duration' => $duration
            ]);
            
            // $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            throw new Exception("Error saving video content: " . $e->getMessage());
        }
    }
}
?>