<?php
require_once 'assets/includes/header.php';
require_once 'assets/config/db.php';


if (!isset($_SESSION['user_id'])) {
    die('Du måste vara inloggad.');
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT id, title, message, image_path, continent, country, city, created_at
        FROM postcard
        WHERE user_id = :user_id
        ORDER BY created_at DESC";

$stmt = $dbh->prepare($sql);
$stmt->execute([
    ':user_id' => $user_id
]);

$postcards = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<main>
    <div class="container mb-4">
        <div class="filter-box p-4 rounded-4 shadow-sm">
            <form class="row g-3">
                <div class="col-md-3">
                    <label for="country" class="form-label filter-label">Country</label>
                    <select id="country" class="form-select custom-select">
                        <option selected>All countries</option>
                        <option>Japan</option>
                        <option>Thailand</option>
                        <option>South Korea</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="city" class="form-label filter-label">City</label>
                    <select id="city" class="form-select custom-select">
                        <option selected>All cities</option>
                        <option>Tokyo</option>
                        <option>Bangkok</option>
                        <option>Seoul</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="date" class="form-label filter-label">Date</label>
                    <select id="date" class="form-select custom-select">
                        <option selected>Latest</option>
                        <option>Oldest</option>
                        <option>This month</option>
                        <option>This year</option>
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button type="button" class="btn filter-btn w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="container py-5">
        <div class="d-flex justify-content-center mb-4">
            <h1 class="h2">My postcards</h1>
        </div>

        <?php if (empty($postcards)): ?>
            <p>You have not posted any postcards.</p>
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
                                            <?= nl2br(htmlspecialchars($row['message'] ?? '')) ?>
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
                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>


                            </form>

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