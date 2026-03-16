<?php
require_once 'assets/includes/display_errors.php';
require_once 'assets/config/db.php';
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
                <a href="index.html" class="navbar-brand">
                    <i class="fa-solid fa-camera"></i>
                    <span class="ms-1">Pixie</span>
                </a>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">Startsidan</a>
                    </li>
                    <li class="nav-item"><a href="#" class="nav-link">Produkter</a></li>
                    <li class="nav-item"><a href="feed.asia.php" class="nav-link">Asien</a></li>
                    <li class="nav-item"><a href="my_page.php" class="nav-link">Min sida</a></li>
                </ul>
                <form class="d-flex">
                    <input type="search" class="form-control me-2" placeholder="Ange sökord...">
                    <button type="submit" class="btn btn-primary">Sök</button>
                </form>
            </nav>
        </div>

        <a href="add_postcard.php" class="floating-upload-btn">
            <i class="fa-solid fa-plus"></i> Skapa vykort
        </a>
    </header>

</body>

</html>