
<?php
require_once(__DIR__ . '/../config/db.php');

class Category extends Db {
    public function __construct() {
        parent::__construct();
    }
    public function getCategories() {
        $query = "SELECT * FROM categories";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // le nombre total des categories
    public function getCategoriesCount(){
        $query = "SELECT COUNT(*) FROM categories";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result;
    }


}
