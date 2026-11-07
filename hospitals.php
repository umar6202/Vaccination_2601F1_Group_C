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
$success = "";
$error = "";

// Handle Appointment Booking Submission
if (isset($_POST['book_appointment'])) {
    $child_id = mysqli_real_escape_string($conn, $_POST['child_id']);
    $hospital_id = mysqli_real_escape_string($conn, $_POST['hospital_id']);
    $vaccine_name = mysqli_real_escape_string($conn, $_POST['vaccine_name']);
    $appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
    $status = 'Pending'; // Default status when booked

    // Insert into appointments table matching your existing database structure
    $insert_query = "INSERT INTO appointments (parent_id, child_id, hospital_id, vaccine_name, appointment_date, status) 
                     VALUES ('$parent_id', '$child_id', '$hospital_id', '$vaccine_name', '$appointment_date', '$status')";
    
    if (mysqli_query($conn, $insert_query)) {
        $success = "Vaccination appointment booked successfully!";
    } else {
        $error = "Failed to book appointment. Please try again.";
    }
}

// Fetch hospitals from your existing hospitals table
$hospitals_query = mysqli_query($conn, "SELECT * FROM hospitals");

// Fetch children belonging to this logged-in parent for the booking dropdown
$children_query = mysqli_query($conn, "SELECT * FROM children WHERE parent_id = '$parent_id'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospitals & Appointments - e-Vaccination</title>
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

    <!-- Main Content -->
    <div class="container my-5">
        
        <?php if(!empty($success)): ?>
            <div class="alert alert-success rounded-3"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if(!empty($error)): ?>
            <div class="alert alert-danger rounded-3"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="row">
            <!-- Left Side: Book Appointment Form -->
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <h4 class="fw-bold mb-4 text-dark">Book Appointment</h4>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Select Child</label>
                            <select name="child_id" class="form-control" required>
                                <option value="">Choose child...</option>
                                <?php while ($child = mysqli_fetch_assoc($children_query)): ?>
                                    <option value="<?php echo $child['id']; ?>"><?php echo htmlspecialchars($child['child_name']); ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Select Hospital</label>
                            <select name="hospital_id" class="form-control" required>
                                <option value="">Choose hospital...</option>
                                <?php 
                                // Reset pointer or re-query for hospitals list in dropdown
                                $hospitals_dropdown = mysqli_query($conn, "SELECT * FROM hospitals");
                                while ($hospital = mysqli_fetch_assoc($hospitals_dropdown)): 
                                ?>
                                    <option value="<?php echo $hospital['id']; ?>"><?php echo htmlspecialchars($hospital['hospital_name']); ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Vaccine Name</label>
                            <input type="text" name="vaccine_name" class="form-control" required placeholder="e.g. Polio & Measles Booster">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Appointment Date</label>
                            <input type="date" name="appointment_date" class="form-control" required>
                        </div>

                        <button type="submit" name="book_appointment" class="btn btn-primary w-100 py-2 fw-bold mt-2">Book Slot</button>
                    </form>
                </div>
            </div>

            <!-- Right Side: Hospitals List Table -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <h4 class="fw-bold mb-4 text-dark">Registered Vaccination Centers</h4>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Hospital Name</th>
                                    <th>Address</th>
                                    <th>Contact Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (mysqli_num_rows($hospitals_query) > 0): ?>
                                    <?php while ($row = mysqli_fetch_assoc($hospitals_query)): ?>
                                        <tr>
                                            <td class="fw-semibold text-primary"><?php echo htmlspecialchars($row['hospital_name']); ?></td>
                                            <td><small class="text-muted"><i class="fas fa-map-marker-alt me-1 text-danger"></i><?php echo htmlspecialchars($row['address']); ?></small></td>
                                            <td><i class="fas fa-phone-alt me-1 text-success"></i><?php echo htmlspecialchars($row['contact_number']); ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">No hospitals found in database.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <?php require __DIR__ . '/includes/footer.php'; ?>
</body>
</html>