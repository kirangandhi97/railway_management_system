<?php

namespace App\Controllers;

class DashboardController
{
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }
        require __DIR__ . '/../Views/dashboard.php';
    }
}
