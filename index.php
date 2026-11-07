<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Vaccination Management System</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css?v=navy-2026">

    <link rel="icon" type="image/jpeg" href="material/logo1.jpg">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <?php require __DIR__ . '/includes/header.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Column: Text & CTA Buttons -->
                <div class="col-lg-6 hero-text pe-lg-4">
                    <h1>Protecting Little Futures with Smart Vaccination Management</h1>
                    <p class="text-muted">Ensure your children never miss a critical vaccine. Track schedules, book hospital appointments instantly, and manage digital records securely in one place.</p>
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a href="register.php" class="btn btn-success btn-lg px-4" style="background-color: #17365d; border-color: #17365d;">Register Your Child Now</a>
                        <a href="hospital_info.php" class="btn btn-outline-secondary btn-lg px-4">Find Vaccination Center</a>
                    </div>
                </div>
                
                <!-- Right Column: Image -->
                <div class="col-lg-6 mt-5 mt-lg-0 text-center">
                    <div class="hero-image-wrapper">
                        <img src="material/herosection.jpg" alt="Vaccination consultation" class="hero-main-img img-fluid rounded shadow">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section with ID -->
    <div id="features" class="container py-4">
        <div class="row">
            <!-- Parent Portal Card -->
            <div class="col-md-4">
                <a href="parent_info.php" class="text-decoration-none">
                    <div class="card p-3 shadow-sm border-0 mb-3 hover-card">
                        <div class="d-flex align-items-center">
                            <div class="icon-box p-3 rounded me-3" style="background-color: #eaf0f8;">
                                <i class="fas fa-user text-success" style="color: #17365d !important;"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 text-dark">Parent Portal:</h6>
                                <small class="text-muted">Manage Schedule & Records</small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Hospital Portal Card -->
            <div class="col-md-4">
                <a href="hospital_info.php" class="text-decoration-none">
                    <div class="card p-3 shadow-sm border-0 mb-3 hover-card">
                        <div class="d-flex align-items-center">
                            <div class="icon-box p-3 rounded me-3" style="background-color: #eaf0f8;">
                                <i class="fas fa-hospital text-success" style="color: #17365d !important;"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 text-dark">Hospital Portal:</h6>
                                <small class="text-muted">Manage Appointments & Status</small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Admin Control Card -->
            <div class="col-md-4">
                <a href="admin_info.php" class="text-decoration-none">
                    <div class="card p-3 shadow-sm border-0 mb-3 hover-card">
                        <div class="d-flex align-items-center">
                            <div class="icon-box p-3 rounded me-3" style="background-color: #eaf0f8;">
                                <i class="fas fa-shield-alt text-success" style="color: #17365d !important;"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 text-dark">Admin Control:</h6>
                                <small class="text-muted">System Oversight & Reporting</small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Modern & Professional Footer -->
    <?php require __DIR__ . '/includes/footer.php'; ?>
</body>
</html>