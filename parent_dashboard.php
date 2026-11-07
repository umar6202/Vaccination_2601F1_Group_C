<?php
// Start session and include database connection
session_start();
include 'conn.php';

// Check if parent is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'parent') {
    header("Location: login.php");
    exit();
}

$parent_id = $_SESSION['user_id'];
$parent_name = $_SESSION['user_name'];
$success = "";
$error = "";

// Handle Add Child Form Submission
if (isset($_POST['add_child'])) {
    $child_name = mysqli_real_escape_string($conn, $_POST['child_name']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $grade = mysqli_real_escape_string($conn, $_POST['grade']);

    $insert_query = "INSERT INTO children (parent_id, child_name, age, gender, grade) VALUES ('$parent_id', '$child_name', '$age', '$gender', '$grade')";
    
    if (mysqli_query($conn, $insert_query)) {
        $success = "Child record added successfully!";
    } else {
        $error = "Failed to add child record. Please try again.";
    }
}

// Fetch children belonging to this parent
$children_query = mysqli_query($conn, "SELECT * FROM children WHERE parent_id = '$parent_id'");

// Fetch appointments booked by this parent along with child and hospital names (Using 'appointments' table)
$appointments_query = mysqli_query($conn, "SELECT appointments.*, children.child_name, hospitals.hospital_name 
    FROM appointments 
    JOIN children ON appointments.child_id = children.id 
    JOIN hospitals ON appointments.hospital_id = hospitals.id 
    WHERE appointments.parent_id = '$parent_id'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Dashboard - e-Vaccination</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css?v=navy-2026">

    <link rel="icon" type="image/jpeg" href="material/logo1.jpg">
</head>
<body class="dashboard-body">

    <!-- Professional Navbar -->
    <?php require __DIR__ . '/includes/header.php'; ?>

    <!-- Main Dashboard Content -->
    <div class="container my-5">
        
        <?php if(!empty($success)): ?>
            <div class="alert alert-success rounded-3"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if(!empty($error)): ?>
            <div class="alert alert-danger rounded-3"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Quick Action Banner for Hospital Booking -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-primary text-white border-0 rounded-4 p-4 shadow-sm">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <div class="mb-3 mb-md-0">
                            <h3 class="fw-bold mb-1">Book Vaccine Appointments</h3>
                            <p class="mb-0 text-white-50">Explore registered hospitals and schedule timely vaccination slots for your children.</p>
                        </div>
                        <a href="hospitals.php" class="btn btn-light text-primary fw-bold px-4 py-3 rounded-3 shadow-sm">
                            <i class="fas fa-hospital me-2"></i> View Hospitals & Book
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Side: Add Child Form -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <h4 class="fw-bold mb-4 text-dark">Add New Child</h4>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Child's Name</label>
                            <input type="text" name="child_name" class="form-control" required placeholder="Enter child name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Age</label>
                            <input type="number" name="age" class="form-control" required placeholder="Enter age">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-control" required>
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Grade / Class</label>
                            <input type="text" name="grade" class="form-control" required placeholder="e.g. Preschool / Grade 1">
                        </div>
                        <button type="submit" name="add_child" class="btn btn-primary w-100 py-2 fw-bold mt-2">Add Child</button>
                    </form>
                </div>
            </div>

            <!-- Right Side: Registered Children List -->
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <h4 class="fw-bold mb-4 text-dark">My Registered Children</h4>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (mysqli_num_rows($children_query) > 0): ?>
                                    <?php while ($row = mysqli_fetch_assoc($children_query)): ?>
                                        <tr>
                                            <td class="fw-semibold"><?php echo htmlspecialchars($row['child_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['age']); ?></td>
                                            <td><?php echo htmlspecialchars($row['gender']); ?></td>
                                            <td><?php echo htmlspecialchars($row['grade']); ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">No children registered yet.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointments History Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <h4 class="fw-bold mb-4 text-dark"><i class="fas fa-calendar-alt text-primary me-2"></i>My Booked Appointments</h4>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Child Name</th>
                                    <th>Hospital Name</th>
                                    <th>Vaccine Name</th>
                                    <th>Appointment Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (mysqli_num_rows($appointments_query) > 0): ?>
                                    <?php while ($app = mysqli_fetch_assoc($appointments_query)): ?>
                                        <tr>
                                            <td class="fw-semibold"><?php echo htmlspecialchars($app['child_name']); ?></td>
                                            <td><?php echo htmlspecialchars($app['hospital_name']); ?></td>
                                            <td><?php echo htmlspecialchars($app['vaccine_name']); ?></td>
                                            <td><i class="far fa-calendar-alt me-1 text-secondary"></i><?php echo htmlspecialchars($app['appointment_date']); ?></td>
                                            <td>
                                                <?php if ($app['status'] == 'Approved'): ?>
                                                    <span class="badge bg-success px-3 py-2">Approved</span>
                                                <?php elseif ($app['status'] == 'Rejected'): ?>
                                                    <span class="badge bg-danger px-3 py-2">Rejected</span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">No appointments booked yet.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modern & Professional Footer -->
    <?php require __DIR__ . '/includes/footer.php'; ?>
</body>
</html>