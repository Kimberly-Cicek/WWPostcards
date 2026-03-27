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
          You have left some fields empty!
        </div>
      </div>';
      break;

    case 'error':
      echo '
      <div class="container d-flex justify-content-center mt-3">
        <div class="alert alert-danger w-50 text-center">
          You have entered an invalid email address or password!
        </div>
      </div>';
      break;

    case 'success':
      echo '
      <div class="container d-flex justify-content-center mt-3">
        <div class="alert alert-success w-50 text-center">
          Welcome back! <i class="fa-regular fa-envelope"></i>
        </div>
      </div>';
      break;
  }
}
?>

<div class="container py-4">

  <!-- HERO -->
  <div class="hero mb-5 text-center">

    <h1 class="display fw-bold">
      Discover the world, one postcard at a time
    </h1>

    <p class="lead text-muted hero-text">
      Explore destinations through real stories
    </p>

    <!-- KARTA -->
    <div class="map-container mt-4">

      <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Jordglogen.png" class="globe" alt="Jordglob">
    

    <!-- ASIA (klickbar - första pinnen) -->
<a href="feed.asia.php" class="pin">
    <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Pin.png" alt="Pin">
    <div class="popup">ASIA</div>
</a>

<!-- EUROPE (inte klickbar) -->
<div class="pin2">
    <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Pin.png" alt="Pin">
    <div class="popup">EUROPE</div>
</div>

      <!-- NORTH AMERICA -->
      <div class="pin3">
        <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Pin.png" alt="Pin">
        <div class="popup">NORTH AMERICA</div>
      </div>

      <!-- SOUTH AMERICA -->
      <div class="pin4">
        <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Pin.png" alt="Pin">
        <div class="popup">SOUTH AMERICA</div>
      </div>

      <!-- AFRICA -->
      <div class="pin5">
        <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Pin.png" alt="Pin">
        <div class="popup">AFRICA</div>
      </div>

      <!-- OCEANIA -->
      <div class="pin6">
        <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Pin.png" alt="Pin">
        <div class="popup">OCEANIA</div>
      </div>

    </div>

  </div>

  <!-- VYKORT -->
  <h4 class="mb-4">New postcards</h4>
<div class="row g-4">

  <!-- 1 -->
  <div class="col-12 col-lg-6 d-flex"> 
    <div class="postcard-card shadow-sm w-100"> <!-- Postcard card som tar upp hela höjden och har en liten skugga -->
      <div class="row g-0 h-100"> <!-- Rad utan mellanrum som tar upp hela höjden -->

        <div class="col-md-6"> <!-- Kolumn som tar upp halva bredden på medium och större skärmar -->
          <div class="postcard-image-wrap"> <!-- Wrapper för bilden som gör att den tar upp hela höjden och har en minsta höjd -->
            <img src="uploads/Baliberg.jpg" class="postcard-image" alt="Indonesien"> 
               
          </div>
        </div>

        <div class="col-md-6">
          <div class="postcard-back">
            <div class="stamp-box">
              <i class="fa-solid fa-location-dot fa-2x" style="color:#ff5733;"></i>
            </div>

            <h2 class="postcard-title">Livets resa i Indonesien</h2>
            <p class="postcard-location">Bali, Indonesien</p>

            <div class="postcard-message"> 
              Mina favorit platser på Bali.
            </div>

            <p class="postcard-date">Publicerad: 2026-03-17</p>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- 2 -->
  <div class="col-12 col-lg-6 d-flex">
    <div class="postcard-card shadow-sm w-100"> 
      <div class="row g-0 h-100">

        <div class="col-md-6"> <!-- Kolumn som tar upp halva bredden på medium och större skärmar -->
          <div class="postcard-image-wrap"> <!-- Wrapper för bilden som gör att den tar upp hela höjden och har en minsta höjd -->
            <img src="uploads/Parisbild.jpg" class="postcard-image"  alt="Paris">
                 
          </div>
        </div>

        <div class="col-md-6">
          <div class="postcard-back">
            <div class="stamp-box">
              <i class="fa-solid fa-location-dot fa-2x" style="color:#ff5733;"></i>
            </div>

            <h2 class="postcard-title">Min utbytestermin i Paris</h2>
            <p class="postcard-location">Paris, Frankrike</p>

            <div class="postcard-message">
              Smultronställen i Frankrike
            </div>

            <p class="postcard-date">Publicerad: 2026-03-17</p>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- 3 -->
  <div class="col-12 col-lg-6 d-flex">
    <div class="postcard-card shadow-sm w-100">
      <div class="row g-0 h-100">

        <div class="col-md-6">
          <div class="postcard-image-wrap">
            <img src="uploads/Sydamerika.jpg" class="postcard-image" alt="sydamerika">
                
          </div>
        </div>

        <div class="col-md-6">
          <div class="postcard-back">
            <div class="stamp-box">
              <i class="fa-solid fa-location-dot fa-2x" style="color:#ff5733;"></i>
            </div>

            <h2 class="postcard-title">Backpackar i Sydamerika</h2>
            <p class="postcard-location">Brasilien</p>

            <div class="postcard-message">
              Tips på hikes i Brasilien.
            </div>

            <p class="postcard-date">Publicerad: 2026-03-17</p>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- 4 -->
  <div class="col-12 col-lg-6 d-flex">
    <div class="postcard-card shadow-sm w-100">
      <div class="row g-0 h-100">

        <div class="col-md-6">
          <div class="postcard-image-wrap">
            <img src="uploads/USAroadtrip.jpg" class="postcard-image" alt="USA">
            
          </div>
        </div>

        <div class="col-md-6">
          <div class="postcard-back">
            <div class="stamp-box">
              <i class="fa-solid fa-location-dot fa-2x" style="color:#ff5733;"></i>
            </div>

            <h2 class="postcard-title">Roadtrip i USA</h2>
            <p class="postcard-location">USA</p>

            <div class="postcard-message">
              Mina bästa stopp längs vägen.
            </div>

            <p class="postcard-date">Publicerad: 2026-03-17</p>
          </div>
        </div>

      </div>
    </div>
  </div>

</div>
</main>
<?php
require_once 'assets/includes/footer.php';
?>