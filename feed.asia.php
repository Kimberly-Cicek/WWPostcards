<?php
require_once 'assets/includes/header.php';
require_once 'assets/config/db.php';

$continent = 'Asien';

/* =========================
   SAVE COMMENT
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
   DELETE COMMENT
*/
if (isset($_POST['delete_id']) && isset($_SESSION['user_id'])) {
    $stmt = $dbh->prepare("DELETE FROM comments WHERE id = ? AND user_id = ?");
    $stmt->execute([
        $_POST['delete_id'],
        $_SESSION['user_id']
    ]);
}

/* 
   GET POSTCARD
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
                <label class="form-label filter-label">Country</label>
                <select class="form-select custom-select">
                    <option selected>All countries</option>
                    <option>Japan</option>
                    <option>Thailand</option>
                    <option>South Korea</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label filter-label">City</label>
                <select class="form-select custom-select">
                    <option selected>All cities</option>
                    <option>Tokyo</option>
                    <option>Bangkok</option>
                    <option>Seoul</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label filter-label">Date</label>
                <select class="form-select custom-select">
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

<!-- 
     POSTCORD
 -->
<div class="container py-5">
    <h1 class="h2 mb-4 text-center">Postcards from Asia</h1>

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
                                        Published: <?= htmlspecialchars($row['created_at'] ?? '') ?>
                                    </p>

                                </div>
                            </div>

                        </div>

                        <!-- BUTTON -->
                        <div class="p-3">
                            <button class="btn btn-primary btn-sm w-100"
                                data-bs-toggle="modal"
                                data-bs-target="#commentsModal<?= $row['id'] ?>">
                                Show comments / Comment
                            </button>
                        </div>

                    </div>

                </div>
                <div class="modal fade" id="commentsModal<?= $row['id'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Comments</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <!-- FORM -->
                                <form method="post" class="mb-3">
                                    <input type="hidden" name="postcard_id" value="<?= $row['id'] ?>"> <!-- Sends the cards id as parameter to know which comment belongs to which user -->

                                    <?php if (!isset($_SESSION['user_id'])): ?> <!-- Checks whether user is logged in -->
                                        <textarea class="form-control mb-2" disabled
                                            placeholder="You need to be logged in to comment"></textarea>
                                    <?php else: ?>
                                        <textarea name="comment" class="form-control mb-2"
                                            placeholder="Write comment..."></textarea> <!-- Only shows if user is logged in -->
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    <?php endif; ?> <!-- Checks whether user is logged in-->
                                </form>

                                <!-- COMMENTS (connection to database) -->
                                <?php
                                $stmt = $dbh->prepare("SELECT * FROM comments WHERE postcard_id = ?"); /* Get all comments with the same postcard_id as the current postcard */
                                $stmt->execute([$row['id']]);
                                $comments = $stmt->fetchAll(); /* Fetches all results and saves in $comments */
                                ?>

                                <?php if ($comments): ?> <!-- Checks if there are any comments -->
                                    <?php foreach ($comments as $comment): ?>
                                        <div class="border rounded p-2 mb-2">
                                            💬 <?= htmlspecialchars($comment['text']) ?>

                                            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $comment['user_id']): ?>
                                                <form method="post" style="display:inline;">
                                                    <input type="hidden" name="delete_id" value="<?= $comment['id'] ?>">
                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            <?php endif; ?> <!-- Closes the if-statement and only shows the comment to user who posted it -->
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="text-muted">No comments yet</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info">There are no postcards from Asia yet.</div> <!-- Shows if there are no postcards from Asia -->
    <?php endif; ?>
</div>

<?php require_once 'assets/includes/footer.php'; ?>