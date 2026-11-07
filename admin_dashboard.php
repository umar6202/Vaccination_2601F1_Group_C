<?php
// Start session and include database connection
session_start();
include 'conn.php';

// 1. IMPORTANT: Yeh code admin login check se PEHLE hona chahiye taake public form submit ho sakay
if (isset($_POST['submit_hospital_req'])) {
    $h_name     = mysqli_real_escape_string($conn, $_POST['hospital_name']);
    $h_email    = mysqli_real_escape_string($conn, $_POST['hospital_email']);
    $h_location = mysqli_real_escape_string($conn, $_POST['hospital_location']);
    $h_phone    = mysqli_real_escape_string($conn, $_POST['hospital_phone']);

    $insert_req = "INSERT INTO hospital_requests (hospital_name, hospital_email, hospital_location, hospital_phone, status) 
                  VALUES ('$h_name', '$h_email', '$h_location', '$h_phone', 'Pending')";
    
    if (mysqli_query($conn, $insert_req)) {
        // Redirect back with success status so modal popup triggers on hospital_info.php
        header("Location: hospital_info.php?status=success");
        exit();
    } else {
        // Fallback error redirection if query fails
        header("Location: hospital_info.php?status=error");
        exit();
    }
}

// 2. Ab yahan Admin Login Check lagayein (yeh sirf admin pages ke liye hai)
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$admin_name = $_SESSION['user_name'];
$success = "";
$error = "";

// Handle Direct Add Hospital Form Submission (by Admin)
if (isset($_POST['add_hospital'])) {
    $hospital_name  = mysqli_real_escape_string($conn, $_POST['hospital_name']);
    $address        = mysqli_real_escape_string($conn, $_POST['address']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $email          = mysqli_real_escape_string($conn, $_POST['email']);
    $password       = mysqli_real_escape_string($conn, $_POST['password']); 

    $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check_email) > 0) {
        $error = "This email is already registered with another account.";
    } else {
        $insert_hospital = "INSERT INTO hospitals (hospital_name, address, contact_number) VALUES ('$hospital_name', '$address', '$contact_number')";
        if (mysqli_query($conn, $insert_hospital)) {
            $insert_user = "INSERT INTO users (name, email, password, role) VALUES ('$hospital_name', '$email', '$password', 'hospital')";
            mysqli_query($conn, $insert_user);
            $success = "Hospital added successfully and login credentials created!";
        } else {
            $error = "Failed to add hospital. Please try again.";
        }
    }
}

// Handle Approve Action for Hospital Request
if (isset($_GET['approve_id'])) {
    $req_id = intval($_GET['approve_id']);
    $get_req = mysqli_query($conn, "SELECT * FROM hospital_requests WHERE id = $req_id");
    
    if ($get_req && mysqli_num_rows($get_req) > 0) {
        $req_data = mysqli_fetch_assoc($get_req);
        $h_name  = mysqli_real_escape_string($conn, $req_data['hospital_name']);
        $h_email = mysqli_real_escape_string($conn, $req_data['hospital_email']);
        $h_loc   = mysqli_real_escape_string($conn, $req_data['hospital_location']);
        $h_phone = mysqli_real_escape_string($conn, $req_data['hospital_phone']);
        $default_pass = "hospital123";

        // Update status to Approved
        mysqli_query($conn, "UPDATE hospital_requests SET status = 'Approved' WHERE id = $req_id");

        // Insert into hospitals & users tables if not already existing
        $check_user = mysqli_query($conn, "SELECT * FROM users WHERE email = '$h_email'");
        if (mysqli_num_rows($check_user) == 0) {
            mysqli_query($conn, "INSERT INTO hospitals (hospital_name, address, contact_number) VALUES ('$h_name', '$h_loc', '$h_phone')");
            mysqli_query($conn, "INSERT INTO users (name, email, password, role) VALUES ('$h_name', '$h_email', '$default_pass', 'hospital')");
        }
        $success = "Hospital request approved and credentials generated successfully!";
    }
}

// Handle Reject Action for Hospital Request
if (isset($_GET['reject_id'])) {
    $req_id = intval($_GET['reject_id']);
    mysqli_query($conn, "UPDATE hospital_requests SET status = 'Rejected' WHERE id = $req_id");
    $success = "Hospital request has been rejected.";
}

// Fetch statistics
$total_hospitals    = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hospitals"));
$total_parents      = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE role = 'parent'"));
$total_appointments = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM appointments"));

// Fetch pending/processed hospital requests
$hospital_requests  = mysqli_query($conn, "SELECT * FROM hospital_requests ORDER BY id DESC");

// Fetch all appointments
$all_appointments   = mysqli_query($conn, "SELECT appointments.*, children.child_name, hospitals.hospital_name, users.name AS parent_name 
    FROM appointments 
    JOIN children ON appointments.child_id = children.id 
    JOIN hospitals ON appointments.hospital_id = hospitals.id 
    JOIN users ON appointments.parent_id = users.id 
    ORDER BY appointments.appointment_date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - e-Vaccination</title>
    <!-- Bootstrap 5 CSS & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css?v=navy-2026">

    <link rel="icon" type="image/jpeg" href="material/logo1.jpg">
    <style>
        body {
            background: linear-gradient(135deg, #f3f6fb 0%, #eaf0f8 100%);
            min-height: 100vh;
        }
        .custom-navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>

 <!-- Professional Modern Navbar -->
    <?php require __DIR__ . '/includes/header.php'; ?>

    <!-- Main Container -->
    <div class="container my-5">
        
        <?php if(!empty($success)): ?>
            <div class="alert alert-success rounded-3 alert-dismissible fade show"><?php echo $success; ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        <?php endif; ?>

        <?php if(!empty($error)): ?>
            <div class="alert alert-danger rounded-3 alert-dismissible fade show"><?php echo $error; ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        <?php endif; ?>

        <!-- Statistics Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white border-start border-primary border-4">
                    <div class="d-flex align-items-center">
                        <div class="fs-1 text-primary me-3"><i class="fas fa-hospital"></i></div>
                        <div>
                            <h6 class="text-muted mb-1">Total Hospitals</h6>
                            <h3 class="fw-bold mb-0"><?php echo $total_hospitals; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white border-start border-success border-4">
                    <div class="d-flex align-items-center">
                        <div class="fs-1 text-success me-3"><i class="fas fa-users"></i></div>
                        <div>
                            <h6 class="text-muted mb-1">Registered Parents</h6>
                            <h3 class="fw-bold mb-0"><?php echo $total_parents; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white border-start border-warning border-4">
                    <div class="d-flex align-items-center">
                        <div class="fs-1 text-warning me-3"><i class="fas fa-calendar-alt"></i></div>
                        <div>
                            <h6 class="text-muted mb-1">Total Appointments</h6>
                            <h3 class="fw-bold mb-0"><?php echo $total_appointments; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Incoming Hospital Partnership Requests Table -->
        <div class="card shadow-sm border-0 rounded-4 p-4 mb-5 bg-white">
            <h4 class="fw-bold mb-4 text-dark"><i class="fas fa-hospital-user text-primary me-2"></i>Hospital Partnership Requests</h4>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Hospital Name</th>
                            <th>Official Email</th>
                            <th>Location</th>
                            <th>Contact Phone</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($hospital_requests && mysqli_num_rows($hospital_requests) > 0): ?>
                            <?php while ($req = mysqli_fetch_assoc($hospital_requests)): ?>
                                <tr>
                                    <td class="fw-semibold"><?php echo htmlspecialchars($req['hospital_name']); ?></td>
                                    <td><?php echo htmlspecialchars($req['hospital_email']); ?></td>
                                    <td><?php echo htmlspecialchars($req['hospital_location']); ?></td>
                                    <td><?php echo htmlspecialchars($req['hospital_phone']); ?></td>
                                    <td>
                                        <?php if ($req['status'] == 'Approved'): ?>
                                            <span class="badge bg-success px-3 py-2">Approved</span>
                                        <?php elseif ($req['status'] == 'Rejected'): ?>
                                            <span class="badge bg-danger px-3 py-2">Rejected</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <?php if ($req['status'] == 'Pending'): ?>
                                            <a href="admin_dashboard.php?approve_id=<?php echo $req['id']; ?>" class="btn btn-sm btn-success me-1 fw-semibold" onclick="return confirm('Approve this hospital?')">
                                                <i class="fas fa-check me-1"></i>Approve
                                            </a>
                                            <a href="admin_dashboard.php?reject_id=<?php echo $req['id']; ?>" class="btn btn-sm btn-outline-danger fw-semibold" onclick="return confirm('Reject this request?')">
                                                <i class="fas fa-times me-1"></i>Reject
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted small">Processed</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No pending or active hospital requests.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add Hospital Form Section -->
        <div class="card shadow-sm border-0 rounded-4 p-4 mb-5 bg-white">
            <h4 class="fw-bold mb-4 text-dark"><i class="fas fa-hospital-symbol text-primary me-2"></i>Add New Hospital Directly</h4>
            <form action="" method="POST">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Hospital Name</label>
                        <input type="text" name="hospital_name" class="form-control" required placeholder="e.g. City General Hospital">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Contact Number</label>
                        <input type="text" name="contact_number" class="form-control" required placeholder="e.g. 021-33344455">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Hospital Address</label>
                        <input type="text" name="address" class="form-control" required placeholder="e.g. Main Shahrah-e-Faisal, Karachi">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Hospital Login Email</label>
                        <input type="email" name="email" class="form-control" required placeholder="hospital@example.com">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Hospital Login Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="******">
                    </div>
                    <div class="col-12 mt-4">
                        <button type="submit" name="add_hospital" class="btn btn-primary px-4 py-2 fw-bold">Add Hospital</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- All System Appointments Table -->
        <div class="card shadow-sm border-0 rounded-4 p-4 bg-white">
            <h4 class="fw-bold mb-4 text-dark"><i class="fas fa-list-alt text-primary me-2"></i>System-Wide Appointments</h4>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Parent Name</th>
                            <th>Child Name</th>
                            <th>Hospital Name</th>
                            <th>Vaccine</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($all_appointments && mysqli_num_rows($all_appointments) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($all_appointments)): ?>
                                <tr>
                                    <td class="fw-semibold"><?php echo htmlspecialchars($row['parent_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['child_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['hospital_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['vaccine_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['appointment_date']); ?></td>
                                    <td>
                                        <?php if ($row['status'] == 'Approved'): ?>
                                            <span class="badge bg-success px-3 py-2">Approved</span>
                                        <?php elseif ($row['status'] == 'Rejected'): ?>
                                            <span class="badge bg-danger px-3 py-2">Rejected</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No appointments found in the system yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Modern & Professional Footer -->
    <?php require __DIR__ . '/includes/footer.php'; ?>
</body>
</html>