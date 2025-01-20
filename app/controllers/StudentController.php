<?php
require_once(__DIR__ . '/../models/Course.php');

class StudentController extends BaseController {
    protected $CourseModel;
    protected $EnrollmentModel;

    public function __construct() {
        $this->CourseModel = new Course();
        $this->EnrollmentModel = new Enrollment();
    }
    public function studentDashboard($courseIdDisplay = null) {
        $data = [];
        $data += [
            'courses' => $this->CourseModel->getAllCourses(),
        ];
        $courseFound = false;
        // var_dump($data);die();
        $studentID = $_SESSION['user']['id'];
        
        $studentCourses = $this->EnrollmentModel->getStudentCourses($studentID);
        if ($courseIdDisplay != null) {
            foreach($studentCourses as $course) {
                if($course['course_id'] == $courseIdDisplay) {
                    $courseFound = true;
                }
            }
            if ($courseFound) {
                $courseUrl = $this->CourseModel->getCourseUrlById($courseIdDisplay);
                $data += [
                    'courseUrl' => $courseUrl,
                    ];
            }
            $data += [
                'coursesIDs' => $courseIdDisplay,
            ];
        }


        $this->render('student/dashboard',['data' => $data , 'studentCourses' => $studentCourses]);
    }

    public function displayCourse() {
        // $studentID = $_SESSION['user']['id'];
        $courseID = $_POST['course_id'];
        // $studentCourses = $this->EnrollmentModel->getStudentCourses($studentID);
        // foreach($studentCourses as $course) {
        //     if($course['course_id'] == $courseID) {
        //         $courseIdDisplay = $course['course_id'];
        //     }
        // }
        // if(isset($courseIdDisplay)){
            // $this->studentDashboard($courseIdDisplay);
        // }
        // else{
            $this->studentDashboard($courseID);
        // }
        

    }



    

}
