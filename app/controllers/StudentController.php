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
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Student') {
            header('Location: /login');
            exit;
        }
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
        $courseID = $_POST['course_id'];
        $this->studentDashboard($courseID);

    }

    public function enrollInCourse($courseID){
        $student_id = $_SESSION['user']['id'];
        $enroll = $this->EnrollmentModel->enrollInCourse($student_id, $courseID);
        if($enroll){
            $data = [
                'courses' => $this->EnrollmentModel->getStudentCourses($student_id),
            ];
            $this->render('student/myCourses',['data' => $data]);
        }
        
    }
    public function myCourses() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Student') {
            header('Location: /login');
            exit;
        }
        $studentID = $_SESSION['user']['id'];
        $data = [
            'courses' => $this->EnrollmentModel->getStudentCourses($studentID),
        ];
        $this->render('student/myCourses',['data' => $data]);
    }



}
