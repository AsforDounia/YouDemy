<?php
require_once(__DIR__.'/../config/db.php');
require_once (__DIR__.'/../models/Content.php');
class DocumentContent extends Content {
    public function save($courseId, $contentUrl, $format) {
        try {
            // $this->conn->beginTransaction();
            parent::saveBaseContent($courseId, 'Document', $contentUrl);

            
            $stmt ="INSERT INTO ContentDocuments (content_id, document_format) VALUES (:content_id, :format)";
            $stmt = $this->conn->prepare($stmt);
    
            $stmt->execute(['content_id' => $courseId, 'format' => $format]);
            
            // $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            throw new Exception("Error saving document content: " . $e->getMessage());
        }
    }

    public function updateContent($contentId,$contentUrl,$format) {
        parent::updateBaseContent($contentId, 'Document', $contentUrl);
        $stmt = "UPDATE ContentDocuments SET document_format = :format WHERE content_id = :content_id";
        $stmt = $this->conn->prepare($stmt);
        $stmt->execute(['content_id' => $contentId, 'format' => $format ]);
    }

}
?>