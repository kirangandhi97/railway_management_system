<?php

namespace App\Controllers;

use App\Models\Train;
use App\Models\Booking;

class BookingController
{
    private $trainModel;
    private $bookingModel;

    public function __construct()
    {
        $this->trainModel = new Train();
        $this->bookingModel = new Booking();
    }

    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $source = trim($_POST['source']);
            $destination = trim($_POST['destination']);

            $trains = $this->trainModel->searchTrains($source, $destination);

            // Pass train results to search view
            require_once "app/Views/dashboard.php";
        } else {
            require_once "app/Views/dashboard.php";
        }
    }

    public function book()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $trainId = $_POST['train_id'];
            $seats = $_POST['seats'];

            // Call createBooking and check the result
            if ($this->bookingModel->createBooking($userId, $trainId, $seats)) {
                header("Location: index.php?page=viewBookings");
                exit;
            } else {
                header("Location: index.php?page=dashboard&error=Not enough seats available!");
                exit;
            }
        }
    }

    public function viewBookings()
    {
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $bookings = $this->bookingModel->getUserBookings($userId);

            // Render the view with the user's bookings
            require_once "app/Views/bookings.php";
        } else {
            header('Location: index.php?page=login');
            exit;
        }
    }
}
