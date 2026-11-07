<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Portal & Registration - e-Vaccination System</title>
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
            padding: 50px 0;
        }
        .card-custom {
            border: 1px solid #f0f0f0;
            border-radius: 12px;
            background: #ffffff;
            transition: all 0.3s ease;
        }
        .card-custom:hover {
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
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <?php require __DIR__ . '/includes/header.php'; ?>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 pe-lg-5">
                    <h1 class="display-6 fw-bold text-dark mb-3">
                        Hospital Network & Nearest Appointment Booking
                    </h1>
                    <p class="text-muted lead mb-4" style="font-size: 1.05rem;">
                        Our system automatically maps and schedules your childâ€™s vaccination appointments with the <strong>nearest registered hospital</strong> based on your residential area for maximum convenience.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="login.php" class="btn btn-teal btn-lg shadow-sm">Hospital Staff Login</a>
                        <a href="#registerRequest" class="btn btn-outline-custom btn-lg">Hospital Partnership Request</a>
                    </div>
                </div>
                <div class="col-lg-5 mt-4 mt-lg-0">
    <div class="p-2 bg-light rounded-4 border text-center shadow-sm">
        
        <img src="material/hospital_portal.jpg" alt="Hospital Location Mapping" class="img-fluid rounded-4 mb-2" style="max-height: 250px; width: 100%; object-fit: cover;">
        <h5 class="fw-bold text-dark mt-2 mb-1">Smart Location Mapping</h5>
        <p class="text-muted small mb-2">Parents can easily view verified nearby healthcare desks and book doses instantly.</p>
    </div>
</div>
            </div>
        </div>
    </div>

    <!-- Section 1: List of Active Registered Hospitals -->
    <div class="container mb-5 py-3">
        <div class="text-center mb-4">
            <h3 class="fw-bold text-dark"><i class="fas fa-hospital text-success me-2"></i>Active Registered Hospitals on System</h3>
            <p class="text-muted">Currently verified medical centers offering child immunization desks.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card-custom p-4 h-100">
                    <div class="icon-box"><i class="fas fa-clinic-medical fa-lg"></i></div>
                    <h5 class="fw-bold text-dark">City Children Hospital</h5>
                    <p class="text-muted small mb-2"><i class="fas fa-map-marker-alt text-danger me-1"></i> Gulshan-e-Iqbal, Block 13, Karachi</p>
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">Nearest for District East</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom p-4 h-100">
                    <div class="icon-box"><i class="fas fa-clinic-medical fa-lg"></i></div>
                    <h5 class="fw-bold text-dark">Aga Khan Health Center</h5>
                    <p class="text-muted small mb-2"><i class="fas fa-map-marker-alt text-danger me-1"></i> North Nazimabad, Block H, Karachi</p>
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">Nearest for District Central</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom p-4 h-100">
                    <div class="icon-box"><i class="fas fa-clinic-medical fa-lg"></i></div>
                    <h5 class="fw-bold text-dark">Indus Child Care Unit</h5>
                    <p class="text-muted small mb-2"><i class="fas fa-map-marker-alt text-danger me-1"></i> Korangi Crossing, Karachi</p>
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">Nearest for District Korangi</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Hospital Partnership Request Form -->
    <div class="container mb-5" id="registerRequest">
        <div class="card border-0 shadow-sm p-4 bg-light rounded-4">
            <div class="row align-items-center">
                <div class="col-lg-4 mb-3 mb-lg-0">
                    <h4 class="fw-bold text-dark mb-2">Want to Add Your Hospital?</h4>
                    <p class="text-muted small mb-0">If your hospital or clinic wishes to join our e-Vaccination network, submit your official request details directly to the System Admin.</p>
                </div>
                <div class="col-lg-8">
                    <!-- Form action targets admin_dashboard.php -->
                    <form action="admin_dashboard.php" method="POST" class="row g-3 bg-white p-3 border rounded-3 shadow-sm">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Hospital Name</label>
                            <input type="text" name="hospital_name" class="form-control form-control-sm" placeholder="e.g. Aga Khan Hospital" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Official Email Address</label>
                            <input type="email" name="hospital_email" class="form-control form-control-sm" placeholder="contact@hospital.com" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Location / Area in City</label>
                            <input type="text" name="hospital_location" class="form-control form-control-sm" placeholder="e.g. Stadium Road, Karachi" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Authorized Contact Number</label>
                            <input type="text" name="hospital_phone" class="form-control form-control-sm" placeholder="021-111-911-911" required>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" name="submit_hospital_req" class="btn btn-teal btn-sm px-4 fw-bold">Send Partnership Request to Admin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal Popup -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow rounded-4 p-3 text-center">
      <div class="modal-body py-4">
        <div class="text-success mb-3">
          <i class="fas fa-check-circle fa-4x"></i>
        </div>
        <h4 class="fw-bold text-dark">Request Sent Successfully!</h4>
        <p class="text-muted small mb-4">Your hospital partnership request has been sent to the Admin Dashboard. You will be notified once it is approved.</p>
        <button type="button" class="btn btn-teal px-4" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>


    <!-- JavaScript to trigger modal when URL has status=success -->
    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById('successModal'));
            myModal.show();
        });
    </script>
    <?php endif; ?>

    <?php require __DIR__ . '/includes/footer.php'; ?>
</body>
</html>