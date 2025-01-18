
<?php
require_once(__DIR__ . '/../config/db.php');

class Category extends Db {
    public function __construct() {
        parent::__construct();
    }
    public function getAllCategories() {
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

    // add category 
    public function addCategory($categoryName){
        try{
            $query = "INSERT INTO categories (category_name) VALUES (:catName)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':catName', $categoryName);
            $stmt->execute();
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

    }

    public function deleteCategory($categoryID){
        $query = "DELETE FROM categories WHERE category_id = :categoryID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':categoryID', $categoryID);
        $stmt->execute();
    }

    public function modifyCategory($categoryID , $categoryName){
        try{
            $query = "UPDATE categories SET category_name = :catName WHERE category_id = :categoryID";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':catName', $categoryName);
            $stmt->bindParam(':categoryID', $categoryID);
            $stmt->execute();
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}
