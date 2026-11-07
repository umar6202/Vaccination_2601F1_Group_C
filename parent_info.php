<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Portal - e-Vaccination System</title>
    <!-- Bootstrap 5 CSS & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css?v=navy-2026">

    <link rel="icon" type="image/jpeg" href="material/logo1.jpg">
    <style>
        body {
            background-color: #f3f6fb;
            color: #212529;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }
        .navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #f0f0f0;
            padding: 15px 0;
        }
        .navbar-brand {
            font-weight: 700;
            color: #212529 !important;
        }
        .nav-link {
            color: #495057 !important;
            font-weight: 500;
            margin: 0 10px;
        }
        .nav-link:hover, .nav-link.active {
            color: #17365d !important;
        }
        .btn-teal {
            background-color: #17365d;
            color: #ffffff;
            font-weight: 500;
            border-radius: 6px;
            padding: 8px 20px;
            border: none;
        }
        .btn-teal:hover {
            background-color: #102a4c;
            color: #ffffff;
        }
        .btn-outline-custom {
            border: 1px solid #dee2e6;
            color: #495057;
            background-color: #ffffff;
            font-weight: 500;
            border-radius: 6px;
            padding: 8px 20px;
        }
        .btn-outline-custom:hover {
            background-color: #f8f9fa;
        }
        .hero-section {
            padding: 60px 0;
        }
        .hero-img-container {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border: 1px solid #f0f0f0;
        }
        .benefit-card {
            border: 1px solid #f0f0f0;
            border-radius: 12px;
            background: #ffffff;
            transition: all 0.3s ease;
        }
        .benefit-card:hover {
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transform: translateY(-3px);
        }
        .icon-box {
            width: 50px;
            height: 50px;
            background-color: #eaf0f8;
            color: #17365d;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <?php require __DIR__ . '/includes/header.php'; ?>

    <!-- Hero Section with Registration Image -->
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 pe-lg-5">
                    <h1 class="display-5 fw-bold text-dark mb-3" style="line-height: 1.2;">
                        Parent Portal & Immunization Overview
                    </h1>
                    <p class="text-muted lead mb-4" style="font-size: 1.1rem;">
                        Ensure your children never miss a critical vaccine. Track schedules, book hospital appointments instantly, and manage digital records securely in one place.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="register.php" class="btn btn-teal btn-lg shadow-sm">Register Your Child Now</a>
                        <a href="login.php" class="btn btn-outline-custom btn-lg">Portal Login</a>
                    </div>
                </div>
                <div class="col-lg-5 mt-4 mt-lg-0">
                    <div class="hero-img-container">
                        
                        <img src="material/parent_portal.jpg" alt="Parent Registering Child" class="img-fluid w-100" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=800&q=80';">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Overview -->
    <div class="container mb-5 py-4" id="features">
        <div class="text-center mb-5">
            <h3 class="fw-bold text-dark">Why Parents Trust Our System</h3>
            <p class="text-muted">Designed to make child healthcare tracking seamless and stress-free.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="benefit-card p-4 h-100">
                    <div class="icon-box">
                        <i class="fas fa-calendar-check fa-lg"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Instant Booking</h5>
                    <p class="text-muted small mb-0">Book vaccination slots with nearby registered hospitals without waiting in long physical queues.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="benefit-card p-4 h-100">
                    <div class="icon-box">
                        <i class="fas fa-notes-medical fa-lg"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Digital Records</h5>
                    <p class="text-muted small mb-0">Keep complete digital histories of all administered vaccines safely tied to your unique parent ID.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="benefit-card p-4 h-100">
                    <div class="icon-box">
                        <i class="fas fa-bell fa-lg"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Status Approvals</h5>
                    <p class="text-muted small mb-0">Receive clear status updates (Pending, Approved, or Completed) directly from the hospital administration.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Read-Only Sample Profile Section -->
    <div class="container mb-5">
        <div class="card border-0 shadow-sm p-4 bg-light rounded-4">
            <h5 class="fw-bold text-dark mb-3"><i class="fas fa-id-card text-success me-2"></i>Sample Parent Account Preview (Read-Only)</h5>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted">Parent Name</label>
                    <input type="text" class="form-control" value="Sundus" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted">Email Address</label>
                    <input type="text" class="form-control" value="sundus@gmail.com" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted">Linked Child Profile</label>
                    <input type="text" class="form-control" value="Ahmed Khan (Active)" readonly>
                </div>
            </div>
        </div>
    </div>

    <!-- Modern & Professional Footer -->
<?php require __DIR__ . '/includes/footer.php'; ?>
</body>
</html>