<?php
// Include header
require_once 'assets/includes/header.php';
?>
<main>
    <!-- Hero section -->
    <section class="hero text-center text-white py-5">
        <div class="container py-5">
            <h1 class="display-4 fw-bold">
                <i class="fa-solid fa-seedling"></i>
                Bygg en grönare framtid
            </h1>
            <p class="lead mt-3">
                Vi hjälper företag och privatpersoner att göra hållbara val
                som skyddar vår planet för kommande generationer.
            </p>
            <a href="#" class="btn btn-light btn-lg text-success rounded-pill mt-4">
                Kom igång <i class="fa-solid fa-arrow-right ms-2"></i>
            </a>
        </div>
    </section>
    <!-- Features section -->
    <section class="pt-5">
        <div class="container text-center">
            <?php
            // Checks if an action is set
            if (isset($_GET['action'])) {
                // Checks which action is set
                switch ($_GET['action']) {
                    case 'deleted':
                        echo '
                            <div class="alert alert-danger">
                                Posten har raderats från databasen!
                            </div>
                        ';
                        break;
                    case 'empty':
                        echo '
                            <div class="alert alert-warning">
                                Du har inte angett någon e-postadress eller lösenord!
                            </div>
                        ';
                        break;
                    case 'error':
                        echo '
                            <div class="alert alert-danger">
                                Du har angett fel e-postadress eller lösenord!
                            </div>
                        ';
                        break;
                    case 'logout':
                        echo '
                            <div class="alert alert-success">
                                Du har lyckats logga ut! :-)
                            </div>
                        ';
                        break;
                }
            }
            ?>
            <h2 class="mb-5 text-success">Varför välja EcoVibe?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card p-4">
                        <i class="fa-solid fa-solar-panel fa-3x text-success"></i>
                        <h5 class="mt-3">Förnybar energi</h5>
                        <p class="text-muted">Vi stödjer övergången till sol- och vindkraft för en renare energiframtid.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4">
                        <i class="fa-solid fa-recycle fa-3x text-success"></i>
                        <h5 class="mt-3">Cirkulär ekonomi</h5>
                        <p class="text-muted">Minska avfall genom att återanvända och återvinna material i alla led.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4">
                        <i class="fa-solid fa-water fa-3x text-success"></i>
                        <h5 class="mt-3">Rent vatten</h5>
                        <p class="text-muted">Skydda våra vattenresurser genom hållbar förvaltning och rening.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center text-success mb-5">Vad våra kunder säger</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 h-100">
                        <div class="card-body">
                            <div class="text-warning">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                        <p class="card-text">
                            "EcoVibe har hjälpt oss att minska vårt koldioxidavtryck med 40% på bara ett år."
                        </p>
                        <p class="fw-bold mb-0">Anna Lindström</p>
                        <small class="text-muted">VD, GreenTech AB</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 h-100">
                        <div class="card-body">
                            <div class="text-warning">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                        <p class="card-text">
                            "Fantastisk rådgivning! Vi har nu en helt hållbar leverantörskedja."
                        </p>
                        <p class="fw-bold mb-0">Erik Johansson</p>
                        <small class="text-muted">Grundare, EcoShop</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 h-100">
                        <div class="card-body">
                            <div class="text-warning">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>
                        </div>
                        <p class="card-text">
                            "Professionellt team som verkligen bryr sig om miljön. Rekommenderas!"
                        </p>
                        <p class="fw-bold mb-0">Sara Bergman</p>
                        <small class="text-muted">Miljöchef, NaturCo</small>
                    </div>
                </div>
            </div>
    </section>
</main>
<?php
// Include footer
require_once 'assets/includes/footer.php';
?>