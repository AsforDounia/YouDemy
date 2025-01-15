<?php
require_once(__DIR__ . '/../models/Course.php');

class StudentController extends BaseController {
    protected $CourseModel;

    public function __construct() {
        // $this->CourseModel = new Course();
    }
    public function studentDashboard() {
        $this->render('student/dashboard');
    }
    



}
