<?php
require_once 'assets/config/db.php';
require_once 'assets/includes/header.php';

$continent = 'Asien';

$stmt = $dbh->prepare("SELECT * FROM postcard WHERE continent = :continent ORDER BY created_at DESC");
$stmt->execute(['continent' => $continent]);
$postcards = $stmt->fetchAll();
?>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Vykort från Asien</h1>
    </div>

    <?php if ($postcards): ?>
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
                            <button class="btn btn-outline-dark btn-sm">
                                Kommentera
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info">Det finns inga vykort från Asien ännu.</div>
    <?php endif; ?>
</div>

<?php
require_once 'assets/includes/footer.php';
?>