<?php
// Include header
require_once 'assets/includes/header.php';
?>
<main>
    <form >
        <label for="email" class="form-label">E-post</label>
        <div>
        <input type="email" class="form-control" id="email" name="email">
        </div>
        <div>
        <label for="password" class="form-label">Lösenord</label>
        <input type="password" class="form-control" id="password "
            name="password">
            </div>
            <button type="submit" class="btn">Logga in</button>


    </form>
    <p>Ej medlem? Tryck hejhej<a href="register.php">här</a> för att registrera dig!</p>

</main>

<?php
//Include footer
require_once 'assets/includes/footer.php';
?>