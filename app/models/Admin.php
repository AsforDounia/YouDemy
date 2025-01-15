<?php 
require_once(__DIR__.'/../config/db.php');

class Admin extends User {

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllUsers()
    {
        $query = "SELECT * FROM users WHERE user_id != :user_id GROUP BY role";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $_SESSION['user']['id']);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function changeStatus($userId, $status) {
        try {
            $stmt = $this->conn->prepare("UPDATE users SET status = ? WHERE id = ?");
            $stmt->execute([$status, $userId]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteUser($userId) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$userId]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getTotalUsers()
    {
        $query = "SELECT COUNT(*) as total FROM users WHERE role != 'admin'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getRecentActivities()
    {
        // Placeholder for recent activities logic
        // This should be implemented based on your application's requirements
        return []; // Return an empty array for now
    }
}
