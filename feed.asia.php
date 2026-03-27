<?php
require_once 'assets/includes/header.php';
require_once 'assets/config/db.php';

$continent = 'Asien';

/* =========================
   SPARA KOMMENTAR
========================= */
if (isset($_POST['comment'], $_POST['postcard_id']) && isset($_SESSION['user_id'])) {
    $stmt = $dbh->prepare("INSERT INTO comments (postcard_id, user_id, text) VALUES (?, ?, ?)");
    $stmt->execute([
        $_POST['postcard_id'],
        $_SESSION['user_id'],
        $_POST['comment']
    ]);
}

/* 
   RADERA KOMMENTAR
*/
if (isset($_POST['delete_id']) && isset($_SESSION['user_id'])) {
    $stmt = $dbh->prepare("DELETE FROM comments WHERE id = ? AND user_id = ?");
    $stmt->execute([
        $_POST['delete_id'],
        $_SESSION['user_id']
    ]);
}

/* 
   HÄMTA VYKORT
 */
$stmt = $dbh->prepare("SELECT * FROM postcard WHERE continent = :continent ORDER BY created_at DESC");
$stmt->execute(['continent' => $continent]);
$postcards = $stmt->fetchAll();
?>

<!-- 
     FILTER
 -->
<div class="container mt-4 mb-4">
    <div class="filter-box p-4 rounded-4 shadow-sm">
        <form class="row g-3">

            <div class="col-md-3">
                <label class="form-label filter-label">Land</label>
                <select class="form-select custom-select">
                    <option selected>Alla länder</option>
                    <option>Japan</option>
                    <option>Thailand</option>
                    <option>Sydkorea</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label filter-label">Stad</label>
                <select class="form-select custom-select">
                    <option selected>Alla städer</option>
                    <option>Tokyo</option>
                    <option>Bangkok</option>
                    <option>Seoul</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label filter-label">Datum</label>
                <select class="form-select custom-select">
                    <option selected>Senaste först</option>
                    <option>Äldsta först</option>
                    <option>Denna månad</option>
                    <option>Detta år</option>
                </select>
            </div>

            <div class="col-md-3 d-flex align-items-end">
                <button type="button" class="btn filter-btn w-100">Filtrera</button>
            </div>

        </form>
    </div>
</div>

<!-- 
     VYKORT
 -->
<div class="container py-5">
    <h1 class="h2 mb-4">Postcards from Asia</h1>

    <?php if ($postcards): ?>
        <div class="row g-4">
            <?php foreach ($postcards as $row): ?>
                <div class="col-12 col-lg-6 d-flex">

                    <!-- POSTCARDS -->
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

                        <!-- KNAPP -->
                        <div class="p-3">
                            <button class="btn btn-outline-dark btn-sm w-100"
                                data-bs-toggle="modal"
                                data-bs-target="#commentsModal<?= $row['id'] ?>">
                                Visa kommentarer / Kommentera
                            </button>
                        </div>

                    </div>

                </div>

                <!--
                     MODAL (Ruta i mitten av skärmen som visar kommentarer och formulär)
                -->
                <div class="modal fade" id="commentsModal<?= $row['id'] ?>" tabindex="-1">
                    <div class="modal-dialog"> <!-- Modal dialog som centrerar innehållet -->
                        <div class="modal-content"> <!-- Modal innehåll -->

                            <div class="modal-header"> <!-- Modal header med titel och stäng-knapp -->
                                <h5 class="modal-title">Kommentarer</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <!-- FORM -->
                                <form method="post" class="mb-3"> <!-- Form för att skicka kommentar -->
                                    <input type="hidden" name="postcard_id" value="<?= $row['id'] ?>"> <!-- Skickar vykortets id som parameter för att veta vilken kommentar som hör till vilket vykort -->

                                    <?php if (!isset($_SESSION['user_id'])): ?> <!-- Kollar om användaren är inloggad, om inte så visas en textarea som är disabled-->
                                        <textarea class="form-control mb-2" disabled
                                            placeholder="Du måste vara inloggad för att kommentera"></textarea>
                                    <?php else: ?>
                                        <textarea name="comment" class="form-control mb-2"
                                            placeholder="Skriv kommentar..."></textarea> <!-- Textarea för att skriva kommentar, visas endast om användaren är inloggad -->
                                        <button class="btn btn-success btn-sm">Skicka</button>
                                    <?php endif; ?> <!-- Kollar om användaren är inloggad, om inte så visas en textarea som är disabled-->
                                </form>

                                <!-- COMMENTS (koppling till databasen) -->
                                <?php
                                $stmt = $dbh->prepare("SELECT * FROM comments WHERE postcard_id = ?"); /* Hämtar alla kommentarer som har samma postcard_id som det aktuella vykortet */
                                $stmt->execute([$row['id']]); /* Kör frågan och skickar in vykortets id som parameter */
                                $comments = $stmt->fetchAll(); /* Hämtar alla resultat och sparar i $comments */
                                ?>

                                <?php if ($comments): ?> <!-- Kollar om det finns några kommentarer -->
                                    <?php foreach ($comments as $comment): ?> <!-- Loopar igenom alla kommentarer och visar dem -->
                                        <div class="border rounded p-2 mb-2"> <!-- Visar varje kommentar i en box med runda hörn och en liten marginal -->
                                            💬 <?= htmlspecialchars($comment['text']) ?>

                                            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $comment['user_id']): ?> <!-- Visar radera-knappen endast för den som har skrivit kommentaren -->
                                                <form method="post" style="display:inline;"> <!-- Form för att radera kommentar -->
                                                    <input type="hidden" name="delete_id" value="<?= $comment['id'] ?>"> <!-- Skickar kommentaren id som parameter för att veta vilken kommentar som ska raderas -->
                                                    <button class="btn btn-danger btn-sm">Radera</button> <!-- Radera-knapp -->
                                                </form>
                                            <?php endif; ?> <!-- Stänger if-satsen för att visa radera-knappen endast för den som har skrivit kommentaren -->
                                        </div> <!-- Visar varje kommentar i en box med runda hörn och en liten marginal -->
                                    <?php endforeach; ?> <!-- Loopar igenom alla kommentarer och visar dem -->
                                <?php else: ?> <!-- Om det inte finns några kommentarer -->
                                    <p class="text-muted">Inga kommentarer ännu</p> <!-- Visas om det inte finns några kommentarer -->
                                <?php endif; ?> <!-- Stänger if-satsen för att kolla om det finns några kommentarer -->

                            </div>

                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info">Det finns inga vykort från Asien ännu.</div> <!-- Visas om det inte finns några vykort från Asien -->
    <?php endif; ?>
</div>

<?php require_once 'assets/includes/footer.php'; ?>