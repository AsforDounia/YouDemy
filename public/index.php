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




Route::get('/teacher/dashboard', [TeacherController::class, 'teacherDashboard']);




Route::get('/student/dashboard', [StudentController::class, 'studentDashboard']);







// Dispatch the request
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);



