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


Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard']);
Route::get('/admin/displayForm/{form}', [AdminController::class, 'displayForm']);
Route::post('/admin/AddUser', [AuthController::class, 'register']);


Route::get('/admin/dashboard/manageUsers', [AdminController::class, 'manageUsers']);
Route::get('/admin/changeStatusOfUser/{user_id}', [AdminController::class, 'changeStatusOfUser']);
Route::get('/admin/displayRoleForm/{user_id}', [AdminController::class, 'displayRoleForm']);
Route::post('/admin/ChangeUserRole', [AdminController::class, 'changeUserRole']);

Route::get('/admin/deleteUser/{user_id}', [AdminController::class, 'deleteUser']);



// Route::get('/pagination', [AdminController::class, 'pagination']);




Route::get('/teacher/dashboard', [TeacherController::class, 'teacherDashboard']);




Route::get('/student/dashboard', [StudentController::class, 'studentDashboard']);




Route::get('/dashboardx', [AuthController::class, 'dashboardx']);






// Dispatch the request
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);



