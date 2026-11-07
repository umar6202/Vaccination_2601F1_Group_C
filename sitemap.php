<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sitemap - e-Vaccination Management System</title>
    <link rel="icon" type="image/jpeg" href="material/logo1.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css?v=navy-2026">
</head>
<body class="bg-light">
    <?php require __DIR__ . '/includes/header.php'; ?>
    <main class="container py-5">
        <header class="page-heading mb-4">
            <p class="text-primary fw-semibold mb-2">Explore e-Vaccination</p>
            <h1 class="fw-bold">Sitemap</h1>
            <p class="text-muted mb-0">Find the main pages and portals available on this website.</p>
        </header>
        <div class="row g-4">
            <section class="col-md-6 col-lg-4">
                <div class="card h-100 p-4">
                    <h2 class="h5 fw-bold"><i class="fas fa-globe me-2 text-primary"></i>Public Pages</h2>
                    <ul class="list-unstyled sitemap-links mb-0">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
            
                    </ul>
                </div>
            </section>
            <section class="col-md-6 col-lg-4">
                <div class="card h-100 p-4">
                    <h2 class="h5 fw-bold"><i class="fas fa-hospital me-2 text-primary"></i>Portals</h2>
                    <ul class="list-unstyled sitemap-links mb-0">
                        <li><a href="parent_info.php">Parent Portal</a></li>
                        <li><a href="hospital_info.php">Hospital Portal</a></li>
                        <li><a href="admin_info.php">Admin Information</a></li>
                        <li><a href="hospitals.php">Hospitals & Booking</a> <span class="text-muted small">(sign-in required)</span></li>
                    </ul>
                </div>
            </section>
            <section class="col-md-6 col-lg-4">
                <div class="card h-100 p-4">
                    <h2 class="h5 fw-bold"><i class="fas fa-user-lock me-2 text-primary"></i>Account</h2>
                    <ul class="list-unstyled sitemap-links mb-0">
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Parent Registration</a></li>
                    </ul>
                </div>
            </section>
        </div>
    </main>
    <?php require __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
