<?php require 'views/partials/head.php';?>

<link href="src/css/heroes.css" rel="stylesheet">
<link href="src/css/features.css" rel="stylesheet">

<?php require 'views/partials/header.php';?>

<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="alarm" viewBox="0 0 16 16">
        <path d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9z"/>
        <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1zm1.038 3.018a6 6 0 0 1 .924 0 6 6 0 1 1-.924 0M0 3.5c0 .753.333 1.429.86 1.887A8.04 8.04 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5M13.5 1c-.753 0-1.429.333-1.887.86a8.04 8.04 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1"/>
    </symbol>
    <symbol id="repeat" viewBox="0 0 16 16">
        <path d="M11 5.466V4H5a4 4 0 0 0-3.584 5.777.5.5 0 1 1-.896.446A5 5 0 0 1 5 3h6V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192m3.81.086a.5.5 0 0 1 .67.225A5 5 0 0 1 11 13H5v1.466a.25.25 0 0 1-.41.192l-2.36-1.966a.25.25 0 0 1 0-.384l2.36-1.966a.25.25 0 0 1 .41.192V12h6a4 4 0 0 0 3.585-5.777.5.5 0 0 1 .225-.67Z"/>
    </symbol>
    <symbol id="pie-chart" viewBox="0 0 16 16">
        <path d="M7.5 1.018a7 7 0 0 0-4.79 11.566L7.5 7.793zm1 0V7.5h6.482A7 7 0 0 0 8.5 1.018M14.982 8.5H8.207l-4.79 4.79A7 7 0 0 0 14.982 8.5M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8"/>
    </symbol>
    <symbol id="chevron-right" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
    </symbol>
</svg>

<div class="col-xxl-8 px-4 py-5">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
            <img src="src/img/accueil.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
        </div>
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Edusign</h1>
            <p class="lead">Automate, digitalize like more than 1,500 training organizations that use Edusign, your management of document signatures, attendance, and muche more.</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="https://edusign.com/fr/" class="btn btn-primary btn-lg px-4 me-md-2">Learn more</a>
                <a href="/edusign/about" class="btn btn-outline-secondary btn-lg px-4">About</a>
            </div>
        </div>
    </div>
</div>
<div class="px-4 py-5" id="featured-3">
    <h2 class="pb-2 border-bottom">The benefits of Edusign</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        <div class="feature col">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                <svg class="bi" width="1em" height="1em"><use xlink:href="#alarm"/></svg>
            </div>
            <h3 class="fs-2 text-body-emphasis">Attendance</h3>
            <p>Does reporting absences during your training take you an infinite amount of time? Edusign offers you various solutions to automatically report absences. Whether you are in person or remotely, there are solutions for you. All our methods remain certified by the OPCO.</p>
            <a href="https://edusign.com/fr/gestion-administrative-des-apprenants/" class="icon-link">
                Discover our attendance solutions
                <svg class="bi"><use xlink:href="#chevron-right"/></svg>
            </a>
        </div>
        <div class="feature col">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                <svg class="bi" width="1em" height="1em"><use xlink:href="#repeat"/></svg>
            </div>
            <h3 class="fs-2 text-body-emphasis">Automate your documents</h3>
            <p>Track all your documents on a single platform. Access a history of electronically signed documents in 2 clicks. For your learners, speakers or even business contacts.</p>
            <a href="https://edusign.com/fr/signature-electronique/" class="icon-link">
            Automate your document signatures
                <svg class="bi"><use xlink:href="#chevron-right"/></svg>
            </a>
        </div>
        <div class="feature col">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                <svg class="bi" width="1em" height="1em"><use xlink:href="#pie-chart"/></svg>
            </div>
            <h3 class="fs-2 text-body-emphasis">Learning Analysis</h3>
            <p>Access all your data with powerful analytics. Real-time, global or per-user analysis. Export all your sheets to .csv, PDF or API in 1 click.</p>
            <a href="https://edusign.com/fr/features-statistiques/" class="icon-link">
                Discover the in-depth analysis of statistics
                <svg class="bi"><use xlink:href="#chevron-right"/></svg>
            </a>
        </div>
    </div>
</div>

<?php require 'views/partials/footer.php'; ?>