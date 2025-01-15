<?php
require_once(__DIR__ . '/../models/Admin.php');
require_once(__DIR__ . '/../models/User.php');

class AdminController extends BaseController
{
    private $AdminModel;

    public function __construct()
    {
        $this->AdminModel = new Admin();
    }

    /**
     * Render the admin dashboard
     */
    public function adminDashboard()
    {
        // Check if the user is logged in and has admin role
        // var_dump($_SESSION['user']);die();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
            header('Location: /login');
            exit;
        }

        // Fetch data for the dashboard (e.g., user statistics, recent activities, etc.)
        $data = [
            'allUsers' => $this->AdminModel->getAllUsers(),
            // 'recentActivities' => $this->AdminModel->getRecentActivities(),
        ];

        // Render the dashboard view
        $this->render('admin/dashboard', $data);
    }
}
