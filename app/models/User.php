<?php
require_once(__DIR__.'/../config/db.php');

class User extends Db {

    public function __construct()
    {
        parent::__construct();
    }


    public function findByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function findByID($user_id)
    {
        $query = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    // public function createNewUser($userData)
    // {
    //     $query = "INSERT INTO users (full_name, email, password, role) VALUES (:full_name, :email, :password, :role)";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(':full_name', $userData['name']);
    //     $stmt->bindParam(':email', $userData['email']);
    //     $stmt->bindParam(':password', $userData['password']);
    //     $stmt->bindParam(':role', $userData['role']);
    //     return $stmt->execute();
    // }


    public function createNewUser($userData){
    
        $profilePicturePath = null;

        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
            $fileName = $_FILES['profile_picture']['name'];
            $fileSize = $_FILES['profile_picture']['size'];
            $fileType = $_FILES['profile_picture']['type'];


            if (in_array($fileType, $allowedTypes)) {
                
                $newFileName = uniqid() . "_" . $fileName;
                $uploadDir = 'uploads/profile_pictures/';
                $uploadFilePath = $uploadDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $uploadFilePath)) {
                    $profilePicturePath = $uploadFilePath; 
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        $query = "INSERT INTO users (full_name, email, password, role, profile_picture) VALUES (:full_name, :email, :password, :role, :profile_picture)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':full_name', $userData['fullname']);
        $stmt->bindParam(':email', $userData['email']);
        $stmt->bindParam(':password', $userData['password']);
        $stmt->bindParam(':role', $userData['role']);
        $stmt->bindParam(':profile_picture', $profilePicturePath);
        return $stmt->execute();
    }

    public function getTotalUsers(){
        $query = "SELECT COUNT(*) as total FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}
