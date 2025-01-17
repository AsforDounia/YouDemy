<?php
require_once(__DIR__ . '/../models/Admin.php');
require_once(__DIR__ . '/../models/User.php');
require_once(__DIR__ . '/../models/Course.php');
require_once(__DIR__ . '/../models/Enrollment.php');
require_once(__DIR__ . '/../models/Category.php');
require_once(__DIR__ . '/../models/Teacher.php');


require_once(__DIR__ . '/../config/db.php'); // Ensure the database connection is included

class AdminController extends BaseController
{
    private $AdminModel;
    private $UserModel;
    private $CourseModel;
    private $EnrollmentModel;
    private $CategoryModel;
    private $TeacherModel;


    public function __construct()
    {
        
        $this->AdminModel = new Admin();
        $this->UserModel = new User();
        $this->CourseModel = new Course();
        $this->EnrollmentModel = new Enrollment();
        $this->CategoryModel = new Category() ;
        $this->TeacherModel = new Teacher();

      // Initialize the database connection
    }

    /**
     * Render the admin dashboard
     */

    public function displayForm($form){
        $this->adminDashboard($form);
    }
    public function adminDashboard($form = null){
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
            header('Location: /login');
            exit;
        }
   
        $data = [];
        if($form != null){
            $data = [
                'form' => $form,
            ];
        }
        $data += [
            'allUsers' => $this->AdminModel->getAllUsers(),
            'totalUsers' => $this->UserModel->getTotalUsers(),
            'totalCourses' => $this->CourseModel->getTotalCourses(),
            'mostPopularCourse' => $this->EnrollmentModel->getMostEnrolledCourse(),
            'CategoriesCount' => $this->CategoryModel->getCategoriesCount(),
            'Top3Teachers' => $this->TeacherModel->getTop3Teachers(),
            'TotalPendingTeachers' => $this->TeacherModel->getTotalPendingTeachers(),
            'NewCourses' => $this->CourseModel->getNewCourses(),

        ];
        $this->render('admin/dashboardx', $data);
    }

    
    public function manageUsers($user_id = null){
        $data = [];
        if($user_id != null){
            $data = [
                'user_id' => $user_id,
            ];
        }
        $data += [
            'users' => $this->AdminModel->getAllUsers(),
            'totalUsers' => $this->UserModel->getTotalUsers(),
        ];
        // var_dump($data);die();
        $this->render('admin/user_management', $data);
        exit;
    }

    public function changeStatusOfUser($user_id){
        $user = $this->UserModel->findByID($user_id);
        if($user['status'] == "Disabled"){
            $status = "Active";
        }
        else{
            $status = "Disabled";
        }
        $this->AdminModel->changeStatusOfUser($user_id,$status);

        $this->manageUsers();
        exit;

    }

    public function displayRoleForm($user_id){
        $this->manageUsers($user_id);
        // $user = $this->UserModel->findByID($user_id);

        // $userRole = $this->UserModel->findRole($user_id);
    }

    public function changeUserRole(){
        $user_id = (int)$_POST['user_id'];
        $role = $_POST['role'];
        $this->AdminModel->changeUserRole($user_id,$role);
        $this->manageUsers();
        exit;

    }

    public function deleteUser($user_id){
        $this->AdminModel->deleteUser($user_id);
        $this->manageUsers();
        exit;

    }
































    public function pagination()
    {
        $recordsTotalSQL = $this->AdminModel->getTotalUsers();
        $start = intval($_GET['start'] ?? 0);
        var_dump($start);
        echo "zertyuio";
        die();
        $length = intval($_GET['length'] ?? 10);
        $search_value = $_GET['search']['value'] ?? '';

        if (!empty($search_value)) {
            $users = $this->AdminModel->searchUsers($search_value);
        }
        else{
            $users = $this->AdminModel->getAllUsers($start , $length);
        }


        $returned = [
            "recordsTotal" => $recordsTotalSQL,
            "recordsFiltered" => $recordsTotalSQL,
            "draw" => $_GET['draw'] ?? 0,
            "data" => $users
        ];

        echo json_encode($returned);
    }
}
