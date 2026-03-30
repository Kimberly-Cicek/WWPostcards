<?php
require_once 'assets/includes/header.php';
require_once 'assets/config/db.php';

/* Checks if user is logged in */
if (!isset($_SESSION['user_id'])) {
    die('Du måste vara inloggad.');
}
/* Current logged-in user */
$user_id = $_SESSION['user_id'];

/* Fetch all postcards created by this user */
$sql = "SELECT id, title, message, image_path, continent, country, city, created_at
        FROM postcard
        WHERE user_id = :user_id
        ORDER BY created_at DESC";

$stmt = $dbh->prepare($sql);
$stmt->execute([
    ':user_id' => $user_id
]);

/* Fetch results as associative array */
$postcards = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<main>
    <div class="container mt-4 mb-4">
        <div class="filter-box p-4 rounded-4 shadow-sm">
            <form class="row g-3 align-items-end">
                <div class="col">
                    <label class="form-label filter-label">Continent</label>
                    <select class="form-select custom-select">
                        <option selected>Asia</option>
                        <option>Europe</option>
                        <option>South Amercia</option>
                        <option>North Amercia</option>
                        <option>Africa</option>
                        <option>Oceania</option>
                        <option>Antarctica</option>
                    </select>
                </div>

                <div class="col">
                    <label class="form-label filter-label">Country</label>
                    <select class="form-select custom-select">
                        <option selected>All countries</option>
                        <option>Japan</option>
                        <option>Thailand</option>
                        <option>South Korea</option>
                    </select>
                </div>

                <div class="col">
                    <label class="form-label filter-label">City</label>
                    <select class="form-select custom-select">
                        <option selected>All cities</option>
                        <option>Tokyo</option>
                        <option>Bangkok</option>
                        <option>Seoul</option>
                    </select>
                </div>

                <div class="col">
                    <label class="form-label filter-label">Date</label>
                    <select class="form-select custom-select">
                        <option selected>Latest</option>
                        <option>Oldest</option>
                        <option>This month</option>
                        <option>This year</option>
                    </select>
                </div>

                <div class="col-auto">
                    <button type="button" class="btn filter-btn">Filter</button> <!-- Fake -->
                </div>
            </form>
        </div>
    </div>

    <div class="container py-5">
        <div class="d-flex justify-content-center mb-4">
            <h1 class="h2">My postcards</h1>
        </div>

        <?php if (empty($postcards)): ?>
            <p>You have not posted any postcards.</p> <!-- Checks if user has any postcards -->
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($postcards as $row): ?>
                    <div class="col-12 col-lg-6 d-flex">
                        <div class="postcard-card shadow-sm w-100">
                            <div class="row g-0 h-100">

                                <div class="col-md-6">
                                    <div class="postcard-image-wrap">
                                        <img src="<?= htmlspecialchars($row['image_path'] ?? '') ?>"
                                            alt="<?= htmlspecialchars($row['title'] ?? '') ?>"
                                            class="postcard-image">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="postcard-back">
                                        <div class="stamp-box">
                                            <i class="fa-solid fa-location-dot fa-2x" style="color: #ff5733;"></i>
                                        </div>

                                        <h2 class="postcard-title">
                                            <?= htmlspecialchars($row['title'] ?? '') ?>
                                        </h2>

                                        <p class="postcard-location">
                                            <?= htmlspecialchars($row['city'] ?? '') ?>,
                                            <?= htmlspecialchars($row['country'] ?? '') ?>
                                        </p>

                                        <div class="postcard-message">
                                            <?= nl2br(htmlspecialchars($row['message'] ?? '')) ?> <!-- Keeps line breaks -->
                                        </div>

                                        <p class="postcard-date">
                                            Published: <?= htmlspecialchars($row['created_at'] ?? '') ?>
                                        </p>
                                    </div>
                                </div>

                            </div>

                            <div class="postcard-footer">
                                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>

                                <form action="assets/functions/delete.php" method="post" class="m-0">
                                    <input type="hidden" name="id" value="<?= $row['id']; ?>"> <!-- Sends postcard id -->
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>




                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
require_once 'assets/includes/footer.php';
?>