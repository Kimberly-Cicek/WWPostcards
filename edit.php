<?php

session_start();
require_once 'assets/config/db.php';



if (!isset($_SESSION['user_id'])) {
    die('Du måste vara inloggad.');
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Ogiltigt vykorts-id.');
}

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

$postcard = $stmt->fetch(PDO::FETCH_ASSOC);

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

    if (
        empty($title) ||
        empty($message) ||
        empty($continent) ||
        empty($country) ||
        empty($city)
    ) {
        $error = 'Alla fält måste fyllas i.';
    } else {
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
<main>

    <div class="container py-5">
        <h1 class="mb-4">Edit postcard</h1>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card shadow-sm p-4">
                    <form method="post">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input
                                type="text"
                                class="form-control"
                                id="title"
                                name="title"
                                value="<?= htmlspecialchars($postcard['title'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea
                                class="form-control"
                                id="message"
                                name="message"
                                rows="6"><?= htmlspecialchars($postcard['message'] ?? '') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="continent" class="form-label">Continent</label>
                            <input
                                type="text"
                                class="form-control"
                                id="continent"
                                name="continent"
                                value="<?= htmlspecialchars($postcard['continent'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <input
                                type="text"
                                class="form-control"
                                id="country"
                                name="country"
                                value="<?= htmlspecialchars($postcard['country'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input
                                type="text"
                                class="form-control"
                                id="city"
                                name="city"
                                value="<?= htmlspecialchars($postcard['city'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <p class="mb-2"><strong>Current picture:</strong></p>
                            <img
                                src="<?= htmlspecialchars($postcard['image_path'] ?? '') ?>"
                                alt="<?= htmlspecialchars($postcard['title'] ?? '') ?>"
                                style="max-width: 250px; height: auto;">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <a href="my_page.php" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
require_once 'assets/includes/footer.php';
?>