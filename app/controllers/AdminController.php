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
        
        if(strpos($_SERVER['REQUEST_URI'], 'addCategory') !== false || strpos($_SERVER['REQUEST_URI'], 'editCategory') !== false){
            $this->manageCategories($form);
        }
        elseif(strpos($_SERVER['REQUEST_URI'], 'addUser') !== false){
            $this->adminDashboard($form);
        }
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
            // 'allUsers' => $this->AdminModel->getAllUsers(),
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
        if($user['status'] == "Suspended"){
            $status = "Active";
        }
        else{
            $status = "Suspended";
        }
        $this->AdminModel->changeStatusOfUser($user_id,$status);

        header('Location: /admin/dashboard/manageUsers');
        
        exit;

    }

    public function displayRoleForm($user_id){
        $this->manageUsers($user_id);
        // $user = $this->UserModel->findByID($user_id);

        // $userRole = $this->UserModel->findRole($user_id);
    }

    // public function changeUserRole(){
    //     $user_id = (int)$_POST['user_id'];
    //     $role = $_POST['role'];
    //     $this->AdminModel->changeUserRole($user_id,$role);
    //     header('Location: /admin/dashboard/manageUsers');
    //     exit;
    // }

    public function deleteUser($user_id){
        $this->AdminModel->deleteUser($user_id);
        header('Location: /admin/dashboard/manageUsers');

        exit;

    }



    public function manageCourses(){
        $data = [
            'courses' => $this->CourseModel->getAllCourses(),
        ];
        $this->render('admin/manageCourses', $data);
        exit;
    }

    public function deleteCourse($course_id){
        $this->CourseModel->deleteCourse($course_id);
        header('Location: /admin/dashboard/manageCourses');
    }


    public function manageCategories($form = null){
        $data = [];
        if($form != null){
            if($form === 'addCategory'){
                $data = [
                    'formAddCat' => $form,
                ];
            }
            elseif($form === 'editCategory'){
                $data = [
                    'formEditCat' => $form,
                ];
            }

        }
        $data += [
            'categories' => $this->CategoryModel->getAllCategories(),
        ];
        // var_dump($data);die();
        $this->render('admin/manageCategories', $data);
        exit;
    }

    public function addCategory(){
        $categoryName = $_POST['categoryName'];
        $this->CategoryModel->addCategory($categoryName);
        header('Location: /admin/dashboard/manageCategories');
        exit;
    }

    public function deleteCategory($categoryID){
        $this->CategoryModel->deleteCategory($categoryID);
        header('Location: /admin/dashboard/manageCategories');
        exit;
    }


    public function editCategory(){
        $categoryID = $_POST['category_id'];
        $categoryName = $_POST['categoryName'];
        $this->CategoryModel->modifyCategory($categoryID, $categoryName);
        header('Location: /admin/dashboard/manageCategories');
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
