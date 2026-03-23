<?php
require_once 'assets/includes/header.php';
?>

<main>

<?php
// Alerts
if (isset($_GET['action'])) {
  switch ($_GET['action']) {
    case 'empty':
      echo '
      <div class="container d-flex justify-content-center mt-3">
        <div class="alert alert-warning w-50 text-center">
          Du har inte angett någon e-postadress eller lösenord!
        </div>
      </div>';
      break;

    case 'error':
      echo '
      <div class="container d-flex justify-content-center mt-3">
        <div class="alert alert-danger w-50 text-center">
          Du har angett felaktig e-postadress eller lösenord!
        </div>
      </div>';
      break;

    case 'success':
      echo '
      <div class="container d-flex justify-content-center mt-3">
        <div class="alert alert-success w-50 text-center">
          Välkommen tillbaka!
        </div>
      </div>';
      break;
  }
}
?>

<div class="container py-4">

  <!-- HERO -->
  <div class="hero mb-5 text-center">

    <h1 class="display-4 fw-bold">
      Discover the world, one postcard at a time
    </h1>

    <p class="lead text-muted">
      Explore destinations through real stories
    </p>

    <!-- KARTA -->
    <div class="map-container mt-4">

      <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Jordglogen.png" class="globe" alt="Jordglob">

    <!-- ASIA (klickbar - första pinnen) -->
<a href="feed.asia.php" class="pin">
    <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Pin.png">
    <div class="popup">ASIA</div>
</a>

<!-- EUROPE (inte klickbar) -->
<div class="pin2">
    <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Pin.png">
    <div class="popup">EUROPE</div>
</div>

      <!-- NORTH AMERICA -->
      <div class="pin3">
        <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Pin.png">
        <div class="popup">NORTH AMERICA</div>
      </div>

      <!-- SOUTH AMERICA -->
      <div class="pin4">
        <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Pin.png">
        <div class="popup">SOUTH AMERICA</div>
      </div>

      <!-- AFRICA -->
      <div class="pin5">
        <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Pin.png">
        <div class="popup">AFRICA</div>
      </div>

      <!-- OCEANIA -->
      <div class="pin6">
        <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Pin.png">
        <div class="popup">OCEANIA</div>
      </div>

    </div>

  </div>

  <!-- VYKORT -->
  <h4 class="mb-4">Nyinkomna Vykort</h4>

  <div class="row g-4">

    <div class="col-12 col-md-6">
      <div class="card shadow-sm">
        <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Sk%C3%A4rmavbild%202026-03-17%20kl.%2010.45.36.png" class="card-img-top">
        <div class="card-body text-center">
          <h6 class="card-title">Livets resa i Indonesien</h6>
          <p class="card-text">Mina favorit platser på Bali.</p>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6">
      <div class="card shadow-sm">
        <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Sk%C3%A4rmavbild%202026-03-17%20kl.%2011.40.39.png" class="card-img-top">
        <div class="card-body text-center">
          <h6 class="card-title">Min utbytestermin i Paris</h6>
          <p class="card-text">Smultronställen i Frankrike</p>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6">
      <div class="card shadow-sm">
        <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Sk%C3%A4rmavbild%202026-03-17%20kl.%2011.43.04.png" class="card-img-top">
        <div class="card-body text-center">
          <h6 class="card-title">Backpackar i Sydamerika</h6>
          <p class="card-text">Tips på hikes i Brasilien.</p>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6">
      <div class="card shadow-sm">
        <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Sk%C3%A4rmavbild%202026-03-17%20kl.%2011.44.18.png" class="card-img-top">
        <div class="card-body text-center">
          <h6 class="card-title">Roadtrip i USA</h6>
          <p class="card-text">Mina bästa stopp längs vägen.</p>
        </div>
      </div>
    </div>

  </div>

</div>

</main>

<?php
require_once 'assets/includes/footer.php';
?>