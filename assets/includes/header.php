<?php
//Init session management
session_start();
require_once 'assets/includes/display_errors.php';
require_once 'assets/config/db.php';
require_once 'assets/functions/session.login.php';
require_once 'assets/functions/photo.uploads.php';
require_once 'assets/functions/photo.resize.php';
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asien - Vykortsflöde</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!-- Jcrop css -->
    <link rel="stylesheet" href="assets/css/jcrop.min.css">
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ballet:opsz@16..72&family=DM+Serif+Display:ital@0;1&family=Noto+Serif+Display:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ballet:opsz@16..72&family=DM+Serif+Display:ital@0;1&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Noto+Serif+Display:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <!-- Custom styles -->
    <link rel="stylesheet" href="assets/css/style.css">


</head>

<body>
    <header class="mb-5">
        <div class="container">
            <nav class="navbar navbar-expand-md">
                <a href="index.htm" class="navbar-brand">

                </a>

                <a href="index.php">
                    <img src="images/postcardlogga.png" alt="Logo" width="150" class="mb-3">
                </a>
                <ul class="navbar-nav me-auto">
                    <?php
                    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
                        echo '
                                    
                    <li class="nav-item">
                        <a href="#" class="nav-link ps-5">About us</a>
                    </li>
                    <li class="nav-item"><a href="feed.asia.php" class="nav-link">Discover postcards</a></li>
                       <li class="nav-item">
                    <a href="add_postcard.php" class="nav-link">Create postcard</a>
                    </li>
                    <li class="nav-item"><a href="#" class="nav-link">My friends</a></li>';
                    } else {
                        echo '
                    <li class="nav-item">
                        <a href="#" class="nav-link ps-5">About us</a>
                    </li>
                    <li class="nav-item"><a href="feed.asia.php" class="nav-link">Discover postcards</a></li>
                       <li class="nav-item">';
                    }
                    ?>
                </ul>
                <?php
                // Checks whether user is logged in or not
                if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
                    echo '
    <a href="my_page.php" class="btn me-2">
    <i class="fa-solid fa-user min-sida-btn"></i></a>
    <a href="logout.php" class="btn rounded-pill py-2 px-4 logout-btn">Logout</a>';
                } else {
                    echo
                    ' <!-- Button for login -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <button class="btn dropdown-toggle rounded-pill py-2 px-4 loggain-drop" data-bs-toggle="dropdown" type="button">
                            <i class="fa-solid fa-user mx-2"></i>Log in
                        </button>
                        <div class="dropdown-menu dropdown-menu-end p-4 px-5">
                            <form action="index.php" method="post">
                                <div class="mb-2">
                                    <label for="email" class="form-label sr-only"></label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                    <label for="password" class="form-label sr-only"></label>
                                    <input type="password" class="form-control" id="password"
                                        name="password" placeholder="Password">
                                </div>
                                <div class="text-center">
                                <button type="submit" class="btn logga-in px-5 py-2 rounded-pill" name="login">Log in</button>
                                </div>
                            </form>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="register.php">Not a member? Register here!<i class="fa-solid fa-circle-right ps-1"></i></a>
                            <a class="dropdown-item" href="#">Forgot password?</a>
                        </div>
                    </li>
                </ul>';
                } ?>

            </nav>
        </div>

        <?php
        // Checks whether user is logged in or not
        if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
            echo '
        <a href="add_postcard.php" class="floating-upload-btn">
            <i class="fa-solid fa-plus"></i> Create postcard
        </a>';
        }
        ?>
    </header>