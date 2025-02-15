<?php
session_start();

require 'vendor/autoload.php';
require 'config/config.php';
require 'app/Core/Database.php';
require 'app/Controllers/HomeController.php';
require 'app/Controllers/AuthController.php';
require 'app/Controllers/DashboardController.php';
require 'app/Controllers/BookingController.php';

use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\BookingController;

$page = $_GET['page'] ?? 'home';
$authController = new AuthController();
$dashboardController = new DashboardController();
$bookingController = new BookingController();

$publicPages = ['home', 'login', 'register', 'search'];
$privatePages = ['dashboard', 'book'];

if (in_array($page, $privatePages) && !isset($_SESSION['user_id'])) {
    header('Location: index.php?page=login');
    exit;
}

switch ($page) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->login();
        } else {
            $authController->showLoginForm();
        }
        break;
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->register();
        } else {
            $authController->showRegisterForm();
        }
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'dashboard':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookingController->search();
        } else {
            $dashboardController->index();
        }
        break;
    case 'book':
        $bookingController->book();
        break;
    case 'viewBookings':
        $bookingController->viewBookings();
        break;
    default:
        echo "404 Not Found";
        break;
}
