<?php
require_once 'assets/includes/header.php';
require_once 'assets/config/db.php';            
require_once 'assets/functions/register-user.php';
?>
<main>
    <!--Alert för lyckad registrering-->
    <?php
    // Checks if an action is set
    if (isset($_GET['action'])) {
        // Checks which action is set
        switch ($_GET['action']) {
            case 'inserted':
                echo '
          <div class="container d-flex justify-content-center mt-3">
<div class="alert alert-success w-50 text-center">
Your registration worked!
</div>
</div>
';
                break;

            case 'empty':
                echo '
          <div class="container d-flex justify-content-center mt-3">
<div class="alert alert-danger w-50 text-center">
You have left some fields empty!
</div>
</div>  ';
                break;
        }
    }
    ?>
    <!--Formulär för registering-->
    <section class="container d-flex justify-content-center p-5 my-5" id="regform">
        <div>
            <h2 class="mb-5 text-center">Hello new member!</h2>
            <p>Fill in your email and password to register.</p>
            <form action="register.php" method="post">
                <label for="email" class="form-label">Email:</label>
                <div>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div>
                    <label for="password" class="form-label mt-2">Password:</label>
                    <input type="password" class="form-control" id="password"
                        name="password">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn rounded-pill p-2 px-4 mt-4" name="register">Register! <i class="fa-solid fa-circle-plus"></i></button>
                </div>
                <div class="text-center">
                    <p class="text-muted divider-top mt-3">or log in with</p>
                    <div>
                        <a href="#" class="social-icon"><i class="fa-brands fa-google"></i></a>
                        <a href="#" class="social-icon"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="fa-brands fa-apple"></i></a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
<?php
//Include footer
require_once 'assets/includes/footer.php';
?>