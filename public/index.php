<?php
session_start();



require_once ('../core/BaseController.php');
require_once '../core/Router.php';
require_once '../core/Route.php';

require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/AdminController.php';
require_once '../app/controllers/TeacherController.php';
require_once '../app/controllers/StudentController.php';


$router = new Router();
Route::setRouter($router);



// Route::get('/', [AuthController::class, 'homePages']);
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);


Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard']);
Route::get('/admin/displayForm/{form}', [AdminController::class, 'displayForm']);
Route::post('/admin/AddUser', [AuthController::class, 'register']);


Route::get('/admin/dashboard/manageUsers', [AdminController::class, 'manageUsers']);
Route::get('/admin/changeStatusOfUser/{user_id}', [AdminController::class, 'changeStatusOfUser']);
Route::get('/admin/displayRoleForm/{user_id}', [AdminController::class, 'displayRoleForm']);
// Route::post('/admin/ChangeUserRole', [AdminController::class, 'changeUserRole']);
Route::get('/admin/deleteUser/{user_id}', [AdminController::class, 'deleteUser']);


Route::get('/admin/dashboard/manageCourses', [AdminController::class, 'manageCourses']);
Route::get('/admin/deleteCourse/{course_id}', [AdminController::class, 'deleteCourse']);


Route::get('/admin/dashboard/manageCategories', [AdminController::class, 'manageCategories']);
Route::post('/admin/addCategory', [AdminController::class, 'addCategory']);
Route::get('/admin/deleteCategory/{categoryID}', [AdminController::class, 'deleteCategory']);
Route::post('/admin/editCategory', [AdminController::class, 'editCategory']);



Route::get('/admin/dashboard/manageTags', [AdminController::class, 'manageTags']);
Route::post('/admin/addTag', [AdminController::class, 'addTag']);
Route::get('/admin/deleteTag/{tagID}', [AdminController::class, 'deleteTag']);
Route::post('/admin/editTag', [AdminController::class, 'editTag']);









// Route::get('/pagination', [AdminController::class, 'pagination']);




Route::get('/teacher/dashboard', [TeacherController::class, 'teacherDashboard']);
Route::get('/teacher/displayForm/{form}', [TeacherController::class, 'displayForm']);
Route::get('/teacher/dashboard/manageMyCourses', [TeacherController::class, 'manageMyCourses']);
Route::post('/teacher/addCourse', [TeacherController::class, 'addCourse']);
Route::get('/teacher/deleteCourse/{course_id}', [TeacherController::class, 'deleteCourse']);
Route::post('/teacher/modifyCourse', [TeacherController::class, 'modifyCourse']);
Route::get('/teacher/dashboard/manegeEnrollmentsByCourse', [TeacherController::class, 'manegeEnrollmentsByCourse']);



Route::get('/student/dashboard', [StudentController::class, 'studentDashboard']);
Route::post('/student/displayCourse', [StudentController::class, 'displayCourse']);
Route::get('/student/dashboard/myCourses', [StudentController::class, 'myCourses']);
Route::get('/student/student/enrollInCourse/{courseId}', [StudentController::class, 'enrollInCourse']);




Route::get('/dashboardx', [AuthController::class, 'dashboardx']);






// Dispatch the request
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);



