<?php

require_once 'assets/config/db.php';
require_once 'assets/includes/header.php';

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

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Mina vykort</h1>
    </div>

    <?php if (empty($postcards)): ?>
        <p>Du har inte skapat några vykort ännu.</p>
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
                                        Publicerad: <?= htmlspecialchars($row['created_at'] ?? '') ?>
                                    </p>
                                </div>
                            </div>

                        </div>

                        <div class="postcard-footer">
                            <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm">Redigera</a>

                            <form action="assets/functions/delete.php" method="post" class="m-0">
                                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Radera</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php
require_once 'assets/includes/footer.php';
?>