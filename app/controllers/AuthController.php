<?php 
require_once (__DIR__.'/../models/User.php');
class AuthController extends BaseController {
 
   protected $UserModel ;
   public function __construct(){

      $this->UserModel = new User();

      
   }
public function dashboardx(){
    $this->render('admin/dashboardx');


}

    public function showLoginForm()
    {
        $this->render('auth/login');
    }

    public function login($em = null, $pass = null){
        if($em != null && $pass != null ){
            $email = $em;
            $password = $pass;
        }
        else{
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($password)) {
                $_SESSION['error'] = 'Invalid email or password.';
                header('Location: /login');
                exit;
            }
        }

        $user = $this->UserModel->findByEmail($email);
        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['error'] = 'Incorrect credentials.';
            header('Location: /login');
            exit;
        }
        if($user['status'] === 'Suspended'){
            $_SESSION['error'] = 'Your account has been suspended, please wait for the administrator to activate your account.';
            header('Location: /login');
            exit;
        }

        $_SESSION['user'] = [
            'id' => $user['user_id'],
            'name' => $user['full_name'],
            'role' => $user['role'],
        ];


        switch ($user['role']) {
            case 'Admin':
                header('Location: /admin/dashboard');
                break;
            case 'Teacher':
                header('Location: /teacher/dashboard');
                break;
            case 'Student':
                header('Location: /student/dashboard');
                break;
        }
        exit;
    }

    public function showRegisterForm(){
        $this->render('auth/register');
    }

    public function register(){
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $compteStatus = 'Active';
        if($_SERVER['REQUEST_URI'] != '/register'){
            $roleArray = ['Admin', 'Teacher', 'Student'];
            $location = 'Location: /admin/dashboard';
        }
        else{
            if($role == 'Teacher'){
                $compteStatus = 'Suspended';
            }
            $location = 'Location: /register';
            $roleArray = ['Teacher', 'Student'];
        }
        if (empty($fullname) || !filter_var($email, FILTER_VALIDATE_EMAIL) || !in_array($role, $roleArray)) {
            $_SESSION['error'] = 'Please fill in all fields correctly.';
            header($location);
            exit;
        }


        $usersTotal = $this->UserModel->getTotalUsers();
        if( $usersTotal == 0 ){
            $role = 'Admin';
        }

        
        if ($this->UserModel->findByEmail($email)) {
            $_SESSION['error'] = 'This email is already in use.';
            header($location);
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        $this->UserModel->createNewUser([
            'fullname' => $fullname,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => $role,
            'compteStatus' => $compteStatus
        ]);

        if($_SERVER['REQUEST_URI'] != '/register'){
            header($location);
        }
        else{
            $this->login($email, $password );
            // var_dump($location);die();
        }

        exit;
    }


    public function logout(){
        session_start();
        session_unset();
        session_destroy();
        header('Location: /login');
        exit;
    }
}




