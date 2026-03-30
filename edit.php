<?php
/* Start session to access logged-in user data */
session_start();
/* Include database connection */
require_once 'assets/config/db.php';

/* Check if user is logged in */
if (!isset($_SESSION['user_id'])) {
    die('Du måste vara inloggad.');
}
/* Validate that an ID is provided and is a number */
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Ogiltigt vykorts-id.');
}
/* Store user ID and postcard ID */
$user_id = $_SESSION['user_id'];
$postcard_id = (int) $_GET['id'];

/* Get postcard and verifies that it belongs to user */
$sql = "SELECT id, title, message, image_path, continent, country, city, created_at
        FROM postcard
        WHERE id = :id AND user_id = :user_id";

$stmt = $dbh->prepare($sql);
$stmt->execute([
    ':id' => $postcard_id,
    ':user_id' => $user_id
]);
// Fetch postcard data
$postcard = $stmt->fetch(PDO::FETCH_ASSOC);

// If no postcard is found or doesn't belong to user
if (!$postcard) {
    die('Vykortet finns inte eller tillhör inte dig.');
}

$error = '';

/* Save changes */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $continent = trim($_POST['continent'] ?? '');
    $country = trim($_POST['country'] ?? '');
    $city = trim($_POST['city'] ?? '');
    // Check that all fields are filled
    if (
        empty($title) ||
        empty($message) ||
        empty($continent) ||
        empty($country) ||
        empty($city)
    ) {
        $error = 'Alla fält måste fyllas i.';
    } else {
        // Update postcard in database
        $sql = "UPDATE postcard
                SET title = :title,
                    message = :message,
                    continent = :continent,
                    country = :country,
                    city = :city
                WHERE id = :id AND user_id = :user_id";

        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':message' => $message,
            ':continent' => $continent,
            ':country' => $country,
            ':city' => $city,
            ':id' => $postcard_id,
            ':user_id' => $user_id
        ]);
        // Redirect after successful update
        header('Location: my_page.php');
        exit;
    }

    /* Update shows values if validation fails */
    $postcard['title'] = $title;
    $postcard['message'] = $message;
    $postcard['continent'] = $continent;
    $postcard['country'] = $country;
    $postcard['city'] = $city;
}


?>
<?php require_once 'assets/includes/header.php'; ?>
<main class="container my-5">

    <h1 class="mb-4 text-center">Edit postcard</h1>
    <!-- Show error message if something went wrong -->
    <?php if (!empty($error)): ?>
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error) ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- Form for editing postcard -->
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8 col-xl-7">
            <div class="postcard-box shadow-sm rounded-4 p-4 p-md-5">
                <form method="post">
                    <div class="mb-4">
                        <label for="title" class="form-label fw-semibold">Title</label>
                        <input
                            type="text"
                            class="form-control"
                            id="title"
                            name="title"
                            value="<?= htmlspecialchars($postcard['title'] ?? '') ?>">
                    </div>

                    <div class="mb-4">
                        <label for="message" class="form-label fw-semibold">Message</label>
                        <textarea
                            class="form-control"
                            id="message"
                            name="message"
                            rows="6"><?= htmlspecialchars($postcard['message'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="continent" class="form-label fw-semibold">Continent</label>
                        <input
                            type="text"
                            class="form-control"
                            id="continent"
                            name="continent"
                            value="<?= htmlspecialchars($postcard['continent'] ?? '') ?>">
                    </div>

                    <div class="mb-4">
                        <label for="country" class="form-label fw-semibold">Country</label>
                        <input
                            type="text"
                            class="form-control"
                            id="country"
                            name="country"
                            value="<?= htmlspecialchars($postcard['country'] ?? '') ?>">
                    </div>

                    <div class="mb-4">
                        <label for="city" class="form-label fw-semibold">City</label>
                        <input
                            type="text"
                            class="form-control"
                            id="city"
                            name="city"
                            value="<?= htmlspecialchars($postcard['city'] ?? '') ?>">
                    </div>

                    <div class="mb-4 text-center">
                        <p class="mb-2 fw-semibold">Current picture:</p>
                        <img
                            src="<?= htmlspecialchars($postcard['image_path'] ?? '') ?>"
                            alt="<?= htmlspecialchars($postcard['title'] ?? '') ?>"
                            class="img-fluid rounded"
                            style="max-width: 250px; height: auto;">
                    </div>

                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2">Save changes</button>
                        <a href="my_page.php" class="btn btn-danger px-4 py-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

// Include footer
<?php
require_once 'assets/includes/footer.php';
?>