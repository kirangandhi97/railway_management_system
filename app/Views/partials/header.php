<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php?page=<?php echo isset($_SESSION['user_id']) ? 'dashboard' : 'home'; ?>"><?php echo isset($_SESSION['user_id']) ? 'Welcome ' . $_SESSION['user_name'] . '!' : 'Railway Management'; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item"><a class="nav-link" href="javascript:void()"></a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=viewBookings">View Bookings</a></li>
                        <li class="nav-item"><a class="nav-link text-danger" href="index.php?page=logout">Logout</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=login">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=register">Register</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>