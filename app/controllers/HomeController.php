<?php
require_once(__DIR__ . '/../models/Course.php');

class HomeController extends BaseController {
    protected $CourseModel;

    public function __construct() {
        $this->CourseModel = new Course();
        
    }
    public function homePages(){
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * 6;
        $courses = $this->CourseModel->getAllCourses(null, $offset);
        $totalCourses = $this->CourseModel->getTotalCourses();
        $totalPages = ceil($totalCourses / 6);

        
        $data = [
            'courses' => $courses,
            'totalPages' => $totalPages,
            'currentPage' => $page,
        ];
        $this->render('Home',$data);

       }

}
