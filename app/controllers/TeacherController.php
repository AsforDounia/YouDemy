<?php
require_once(__DIR__ . '/../models/Course.php');
require_once (__DIR__ . '/../models/DocumentContent.php');
require_once (__DIR__ . '/../models/VideoContent.php');
class TeacherController extends BaseController {
    protected $CourseModel;
    protected $EnrollmentModel;
    protected $TagModel;
    protected $CategoryModel;


    public function __construct() {
        $this->CourseModel = new Course();
        $this->EnrollmentModel = new Enrollment();
        $this->CategoryModel = new Category() ;
        $this->TagModel = new Tag();
    }
    // displayForm
    public function displayForm($form) {
        $this->manageMyCourses($form);
    }
    public function teacherDashboard() {
        $teacher_id = $_SESSION['user']['id'];
        // var_dump($teacher_id);die();
        $totalEnrollments = $this->EnrollmentModel->getTotalEnrollments($teacher_id);
        $totalCourses = $this->CourseModel->getTotalTeacherCourses($teacher_id);
        $mostPopularCourse = $this->CourseModel->getMostPopularCourse($teacher_id);
        $distributionOfCourses = $this->CourseModel->distributionOfCoursesByEnrollments($teacher_id);
        $data = [
            'totalEnrollments' => $totalEnrollments,
            'totalCourses' => $totalCourses,
            'mostPopularCourse' => $mostPopularCourse,
            'distributionOfCourses' => $distributionOfCourses,
        ];
        // var_dump($data['distributionOfCourses']);die();
        $this->render('teacher/dashboard', $data);
    }
    public function manageMyCourses($form = null , $error = null) {
        $teacher_id = $_SESSION['user']['id'];
        $data = [];
        if(isset($_GET['course_id'])){
            $course_id = (int)$_GET['course_id'];
            $data += [
                'idModifyform' => $course_id ,
                'course' => $this->CourseModel->getCourseById($course_id , $teacher_id ),
            ];
        }
        $teacher_id = $_SESSION['user']['id'];
        if($form != null) {
            $data += [
                'form' => $form,
            ];
        }
        $courses = $this->CourseModel->getAllCourses($teacher_id);
        $tags = $this->TagModel->getAllTags();
        $categories = $this->CategoryModel->getAllCategories();
        // var_dump($categories);die();
        $data += [
            'courses' => $courses,
            'tags' => $tags,
            'categories' => $categories,
        ];
        $this->render('teacher/manageMyCourses', $data);
    }



    public function addCourse() {
        // var_dump($_POST);die();
        $type = $_POST['type'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category = (int)$_POST['category'];
        $tags = trim($_POST['tags']);
        $tags_array = [];
        $tags_array = array_filter(array_map('trim', explode(',', $tags)));
        $cdn = $_POST['cdn'];
        $teacherId = $_SESSION['user']['id'];

        if (empty($title) || empty($description) || empty($cdn)) {
            $_SESSION['error'] = 'Please fill in all fields correctly.';
            header('Location: /teacher/displayForm/addCourse');
            exit;
        }
        
        try {
            if ($type === 'Video') {
        // var_dump($_POST);die();
                
                $content = new VideoContent();
                $duration = $_POST['duration'] ?? 0; // Assurez-vous d'avoir un champ duration dans votre formulaire
                $specificData = $duration;
            } else {
                $content = new DocumentContent();
                $specificData = strtoupper(pathinfo($cdn, PATHINFO_EXTENSION));
            }
            
            // Appel de la méthode save
            $courseId = $this->CourseModel->saveCourse(
                $title,
                $description,
                $category,
                $teacherId,
                $content,
                $cdn,
                $specificData
            );
            // Si vous voulez aussi sauvegarder les tags
            if(!empty($tags) && !empty($tags_array)){
                foreach ($tags_array as $tag) {
                    $tagId = (int)$tag ;
                    $this->TagModel->addCourseTags($tagId, $courseId);
                }
            }
        
            $this->manageMyCourses();
            
        } catch (Exception $e) {
            echo "Erreur: " . $e->getMessage();
        }
    }

    public function deleteCourse($course_id){
        $this->CourseModel->deleteCourse($course_id);
        header('Location: /teacher/dashboard/manageMyCourses');
    }

    public function modifyCourse() {
        try {
            
            // Validate and sanitize input data
            $courseId = (int)$_POST['course_id'];
            $title = $_POST[ 'title'];
            $description = $_POST[ 'description'];
            $category = (int)$_POST[ 'category'];
            $contentType = $_POST[ 'type'];
            $contentUrl = $_POST[ 'cdn'];
            $tags = trim($_POST[ 'tags']);
            
            // Input validation
            if (empty($title) || empty($description)|| empty($contentUrl)) {
                throw new Exception("All fields are required");
            }
            
            // Start transaction
            // $this->conn->beginTransaction();
            
            // Update course basic information
            
            $params = [
                'title' => $title,
                'description' => $description,
                'category' => $category,
                'content_type' => $contentType,
                'content_url' => $contentUrl,
                'course_id' => $courseId
            ];
            if($contentType == 'Video'){
                $content = new VideoContent();
                $duration = $_POST['duration'] ?? 0; // Assurez-vous d'avoir un champ duration dans votre formulaire
                $specificData = $duration;
                $params += [
                    'content' => $content,
                    'specificData' => $specificData
                ];
            } elseif($contentType == 'Document') {
                $content = new DocumentContent();
                $specificData = strtoupper(pathinfo($contentUrl, PATHINFO_EXTENSION));
                $params += [
                    'content' => $content,
                    'specificData' => $specificData
                ];
            }
            
            $this->CourseModel->modifyCourse($params);

            // Handle tags
            if (!empty($tags)) {
                $tags_array = [];
                $tags_array = array_filter(array_map('trim', explode(',', $tags)));
                if(!empty($tags_array)){
                    $this->TagModel->deleteCourseTags($courseId);
                    foreach ($tags_array as $tag) {
                        $tagId = (int)$tag ;
                        $this->TagModel->addCourseTags($tagId, $courseId);
                    }
                }
            }
            // // Commit transaction
            $this->manageMyCourses();

        } catch (Exception $e) {
            // Rollback transaction on error
            // if ($this->conn->inTransaction()) {
            //     $this->conn->rollBack();
            // }

            return [
                'success' => false,
                'message' => 'Error updating course: ' . $e->getMessage()
            ];
        }
    }

    public function manegeEnrollmentsByCourse(){
        $teacher_id = $_SESSION['user']['id'];
        $results = $this->CourseModel->getTeacherEnrollmentsByCourse($teacher_id);
        $data = [];
        foreach ($results as $row) {
            $courseId = $row['course_id'];
    
            if (!isset($data[$courseId])) {
                $data[$courseId] = [
                    'course_title' => $row['course_title'],
                    'category_name' => $row['category_name'],
                    'content_type' => $row['content_type'],
                    'enrollments' => []
                ];
            }
    
            if (!empty($row['student_id'])) {
                $data[$courseId]['enrollments'][] = [
                    'student_name' => $row['student_name'],
                    'enrollment_date' => $row['enrollment_date'],
                    'status' => $row['status']
                ];
            }
        }

        $this->render('teacher/enrollmentsByCourse', $data);
    }






}
