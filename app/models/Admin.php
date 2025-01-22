<?php 
require_once(__DIR__.'/../config/db.php');

class Admin extends User {

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllUsers(){
        $query = "SELECT * FROM users WHERE user_id != :user_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $_SESSION['user']['id']);

        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }


    public function changeStatusOfUser($userId, $status) {
        try {
            $stmt = $this->conn->prepare("UPDATE users SET status = ? WHERE user_id = ?");
            $stmt->execute([$status, $userId]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteUser($userId) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM users WHERE user_id = ?");
            $stmt->execute([$userId]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // public function changeUserRole($userId , $userRole){
    //     try {
    //         $stmt = $this->conn->prepare("UPDATE users SET role = ? WHERE user_id = ?");
    //         $stmt->execute([$userRole, $userId]);
    //     } catch (PDOException $e) {
    //         echo "Error: " . $e->getMessage();
    //     }
    // }

}
