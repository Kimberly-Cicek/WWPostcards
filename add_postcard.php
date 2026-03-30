<?php
// Include database connection to allow saving postcards to the database
require_once 'assets/config/db.php';
// Include the header (navigation, styles, etc.)
require_once 'assets/includes/header.php';
// Include functions used for inserting data into the database
require_once 'assets/functions/insert.php';
?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8 col-xl-7">
            <!-- Container for the form with styling -->
            <div class="postcard-box shadow-sm rounded-4 p-4 p-md-5">
                <h1 class="mb-4 text-center">Create new postcard</h1>
                <p class="text-muted text-center mb-5">
                    Drop a postcard from the place you’re in — show the view, name the spot, and tell your story!
                </p>
                <!-- 
                    Form that sends data to add_postcard.php
                    POST is used to securely send data
                    enctype is required for file uploads
                -->
                <form action="add_postcard.php" method="post" enctype="multipart/form-data">

                    <div class="mb-4">
                        <label for="title" class="form-label fw-semibold">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="mb-4">
                        <label for="message" class="form-label fw-semibold">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="continent" class="form-label fw-semibold">Continent</label>
                        <select class="form-select" id="continent" name="continent" required>
                            <option value="">Choose continent</option>
                            <option value="Asien">Asia</option>
                            <option value="Europa">Europe</option>
                            <option value="Afrika">Africa</option>
                            <option value="Nordamerika">North America</option>
                            <option value="Sydamerika">South America</option>
                            <option value="Oceanien">Oceania</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="country" class="form-label fw-semibold">Country</label>
                        <input type="text" class="form-control" id="country" name="country" required>
                    </div>

                    <div class="mb-4">
                        <label for="city" class="form-label fw-semibold">City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>

                    <div class="mb-4">
                        <label for="image" class="form-label fw-semibold">Picture</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    </div>
                    <!-- name is used to detect form submission in PHP -->
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" name="create_postcard" class="btn btn-custom px-4 py-2">
                            Send postcard
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</main>
// Include footer (closing layout, scripts, etc.)
<?php require_once 'assets/includes/footer.php'; ?>