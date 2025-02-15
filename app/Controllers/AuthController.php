<?php

namespace App\Controllers;

use App\Core\Database;
use App\Models\User;

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function showLoginForm()
    {
        require __DIR__ . '/../Views/login.php';
    }

    public function showRegisterForm()
    {
        require __DIR__ . '/../Views/register.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if (!empty($name) && !empty($email) && !empty($password)) {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                if ($this->userModel->create([
                    'name' => $name,
                    'email' => $email,
                    'password' => $hashedPassword
                ])) {
                    header("Location: index.php?page=login");
                } else {
                    header("Location: index.php?page=register&error=Error registering user.");
                    exit;
                }
            } else {
                header("Location: index.php?page=register&error=All fields are required.");
                exit;
            }
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = new User();
            $loggedInUser = $user->findByEmail($email);

            if ($loggedInUser && password_verify($password, $loggedInUser['password'])) {
                session_start();
                $_SESSION['user_id'] = $loggedInUser['id'];
                $_SESSION['user_name'] = $loggedInUser['name'];
                $_SESSION['user_email'] = $loggedInUser['email'];
                header('Location: index.php?page=dashboard');
                exit;
            } else {
                header('Location: index.php?page=login&error=Invalid email or password!');
                exit;
            }
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: index.php?page=login');
        exit;
    }
}
