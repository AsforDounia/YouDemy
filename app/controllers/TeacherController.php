<?php
require_once(__DIR__ . '/../models/Course.php');

class TeacherController extends BaseController {
    protected $CourseModel;
    protected $EnrollmentModel;

    public function __construct() {
        $this->CourseModel = new Course();
        $this->EnrollmentModel = new Enrollment();
    }
    public function teacherDashboard() {
        $teacher_id = $_SESSION['user']['id'];
        // var_dump($teacher_id);die();        
        $totalEnrollments = $this->EnrollmentModel->getTotalEnrollments($teacher_id);
        $totalCourses = $this->CourseModel->getTotalTeacherCourses($teacher_id);
        $mostPopularCourse = $this->CourseModel->getMostPopularCourse($teacher_id);
        $data = [
            'totalEnrollments' => $totalEnrollments,
            'totalCourses' => $totalCourses,
            'mostPopularCourse' => $mostPopularCourse
        ];
        $this->render('teacher/dashboard', $data);
    }
    
    public function showCourseCreationForm() {
        $this->render('teacher/course_creation');
    }

    public function createCourse() {
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $content = $_POST['content'] ?? '';
        $tags = $_POST['tags'] ?? '';
        $category = $_POST['category'] ?? '';

        if (empty($title) || empty($description) || empty($content)) {
            $_SESSION['error'] = 'Veuillez remplir tous les champs.';
            header('Location: /teacher/course_creation');
            exit;
        }

        $this->CourseModel->createCourse([
            'title' => $title,
            'description' => $description,
            'content' => $content,
            'tags' => $tags,
            'category' => $category,
            'teacher_id' => $_SESSION['user']['id'],
        ]);

        $_SESSION['success'] = 'Cours créé avec succès.';
        header('Location: /teacher/courses');
        exit;
    }

    public function manageCourses() {
        $courses = $this->CourseModel->getCoursesByTeacher($_SESSION['user']['id']);
        $this->render('teacher/course_management', ['courses' => $courses]);
    }

    public function showStatistics() {
        $statistics = $this->CourseModel->getStatisticsByTeacher($_SESSION['user']['id']);
        $this->render('teacher/statistics', ['statistics' => $statistics]);
    }


}
