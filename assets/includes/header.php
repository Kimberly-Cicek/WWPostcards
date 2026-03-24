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
    <!-- Custom styles -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <header class="p-3 border-bottom"> 
        <div class="container">
            <nav class="navbar navbar-expand-md">
                <a href="index.htm" class="navbar-brand">
                    
                </a>
            
                <a href="index.php">
    <img src="uploads/LoggaPostcards.png" alt="Logo" width="150" class="mb-3">
</a>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link active">Startsidan</a>
                    </li>
                    <li class="nav-item"><a href="feed.asia.php" class="nav-link">Asien</a></li>
                </ul>
                <?php
                // Checks whether user is logged in or not
                if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
                    echo '
    <a href="my_page.php" class="btn me-2">
    <i class="fa-solid fa-circle-user min-sida-btn"></i></a>
    <a href="logout.php" class="btn logout-btn">Logga ut</a>';
                } else {
                    echo
                    ' <!-- Button for login -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <button class="btn dropdown-toggle loggain-drop" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-circle-user mx-2"></i>Logga in
                        </button>
                        <div class="dropdown-menu dropdown-menu-end p-3">
                            <form action="index.php" method="post">
                                <div class="mb-3">
                                    <label for="email" class="form-label sr-only"></label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                    <label for="password" class="form-label sr-only"></label>
                                    <input type="password" class="form-control" id="password"
                                        name="password" placeholder="Lösenord">
                                </div>
                                <div class="text-center">
                                <button type="submit" class="btn logga-in" name="login">Logga in</button>
                                </div>
                            </form>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="register.php">Ej medlem? Registrera dig här!</a>
                            <a class="dropdown-item" href="#">Glömt lösenord?</a>
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
            <i class="fa-solid fa-plus"></i> Skapa vykort
        </a>';
        }
        ?>
    </header>