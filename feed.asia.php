<?php
require_once 'assets/config/db.php';
require_once 'assets/includes/header.php';

$continent = 'Asien';

/* =========================
   SPARA KOMMENTAR
========================= */
if (isset($_POST['comment'], $_POST['postcard_id'])) {
    $stmt = $dbh->prepare("INSERT INTO comments (postcard_id, text) VALUES (?, ?)");
    $stmt->execute([
        $_POST['postcard_id'],
        $_POST['comment']
    ]);
}

/* =========================
   RADERA KOMMENTAR
========================= */
if (isset($_POST['delete_id'])) {
    $stmt = $dbh->prepare("DELETE FROM comments WHERE id = ?");
    $stmt->execute([$_POST['delete_id']]);
}

/* =========================
   HÄMTA VYKORT
========================= */
$stmt = $dbh->prepare("SELECT * FROM postcard WHERE continent = :continent ORDER BY created_at DESC");
$stmt->execute(['continent' => $continent]);
$postcards = $stmt->fetchAll();
?>

<div class="container mb-4">
    <form class="row g-3">
        <div class="col-md-3">
            <label class="form-label">Land</label>
            <select class="form-select">
                <option selected>Alla länder</option>
                <option>Japan</option>
                <option>Thailand</option>
                <option>Sydkorea</option>
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label">Stad</label>
            <select class="form-select">
                <option selected>Alla städer</option>
                <option>Tokyo</option>
                <option>Bangkok</option>
                <option>Seoul</option>
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label">Datum</label>
            <select class="form-select">
                <option selected>Senaste först</option>
                <option>Äldsta först</option>
            </select>
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button type="button" class="btn btn-dark w-100">Filtrera</button>
        </div>
    </form>
</div>

<div class="container py-5">
    <h1 class="h2 mb-4">Vykort från Asien</h1>

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


                        <!-- =========================
                             KOMMENTARER
                        ========================= -->

                        <div class="p-3">

                            <?php
                            $stmt = $dbh->prepare("SELECT * FROM comments WHERE postcard_id = ?");
                            $stmt->execute([$row['id']]);
                            $comments = $stmt->fetchAll();
                            ?>

                            <?php foreach ($comments as $comment): ?>
                                <div style="margin-bottom:8px;">
                                    💬 <?= htmlspecialchars($comment['text']) ?>

                                    <form method="post" style="display:inline;">
                                        <input type="hidden" name="delete_id" value="<?= $comment['id'] ?>">
                                        <button class="btn btn-sm btn-danger">Radera</button>
                                    </form>
                                </div>
                            <?php endforeach; ?>

                            <!-- =========================
                                 FORMULÄR
                            ========================= -->

                            <button class="btn btn-outline-dark btn-sm mt-2"
                                onclick="this.nextElementSibling.style.display='block'">
                                Kommentera
                            </button>

                            <form method="post" style="display:none; margin-top:10px;">
                                <input type="hidden" name="postcard_id" value="<?= $row['id'] ?>">
                                <textarea name="comment" class="form-control mb-2"
                                    placeholder="Skriv kommentar..."></textarea>
                                <button class="btn btn-success btn-sm">Skicka</button>
                            </form>

                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info">Det finns inga vykort från Asien ännu.</div>
    <?php endif; ?>
</div>

<?php require_once 'assets/includes/footer.php'; ?>