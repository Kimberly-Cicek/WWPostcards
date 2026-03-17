<?php
// Include header
require_once 'assets/includes/header.php';
// Register information to database
require_once 'assets/functions/register-user.php';
?>
<main class="container">
    <form action="register.php" method="post">
        <label for="email" class="form-label">E-post</label>
        <div>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div>
            <label for="password" class="form-label">Lösenord</label>
            <input type="password" class="form-control" id="password"
                name="password">
        </div>
        <button type="submit" class="btn" name="register">Registrera dig</button>
    </form>
</main>
<?php
//Include footer
require_once 'assets/includes/footer.php';
?>