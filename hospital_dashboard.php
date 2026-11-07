<?php
// Start session and include database connection
session_start();
include 'conn.php';

// Check if hospital is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'hospital') {
    header("Location: login.php");
    exit();
}

$hospital_user_name = $_SESSION['user_name'];
$success = "";
$error = "";

// Find the corresponding hospital ID from the hospitals table using the hospital name
$h_query = mysqli_query($conn, "SELECT id FROM hospitals WHERE hospital_name = '$hospital_user_name'");
if ($h_row = mysqli_fetch_assoc($h_query)) {
    $hospital_id = $h_row['id'];
} else {
    $hospital_id = 0;
}

// Handle Status Update (Approve / Reject)
if (isset($_POST['update_status'])) {
    $appointment_id = mysqli_real_escape_string($conn, $_POST['appointment_id']);
    $new_status = mysqli_real_escape_string($conn, $_POST['status']);

    $update_query = "UPDATE appointments SET status = '$new_status' WHERE id = '$appointment_id' AND hospital_id = '$hospital_id'";
    if (mysqli_query($conn, $update_query)) {
        $success = "Appointment status updated successfully to $new_status!";
    } else {
        $error = "Failed to update status. Please try again.";
    }
}

// Fetch appointments for this specific hospital along with parent and child details
$appointments_query = mysqli_query($conn, "SELECT appointments.*, children.child_name, users.name AS parent_name, users.email AS parent_email 
    FROM appointments 
    JOIN children ON appointments.child_id = children.id 
    JOIN users ON appointments.parent_id = users.id 
    WHERE appointments.hospital_id = '$hospital_id' 
    ORDER BY appointments.appointment_date ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Dashboard - e-Vaccination</title>
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
<body class="dashboard-body bg-light">

    <!-- Professional Modern Navbar -->
    <?php require __DIR__ . '/includes/header.php'; ?>

    <!-- Main Content -->
    <div class="container my-5" style="min-height: 70vh;">
        
        <?php if(!empty($success)): ?>
            <div class="alert alert-success rounded-3 shadow-sm"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if(!empty($error)): ?>
            <div class="alert alert-danger rounded-3 shadow-sm"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-4 p-4 bg-white">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h4 class="fw-bold m-0 text-dark">
                            <i class="fas fa-calendar-check me-2" style="color: #17365d;"></i>Manage Patient Appointments
                        </h4>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Parent Name</th>
                                    <th>Child Name</th>
                                    <th>Vaccine Name</th>
                                    <th>Appointment Date</th>
                                    <th>Current Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (mysqli_num_rows($appointments_query) > 0): ?>
                                    <?php while ($row = mysqli_fetch_assoc($appointments_query)): ?>
                                        <tr>
                                            <td class="fw-semibold">
                                                <?php echo htmlspecialchars($row['parent_name']); ?><br>
                                                <small class="text-muted"><?php echo htmlspecialchars($row['parent_email']); ?></small>
                                            </td>
                                            <td><?php echo htmlspecialchars($row['child_name']); ?></td>
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
                                            <td>
                                                <form action="" method="POST" class="d-flex gap-2">
                                                    <input type="hidden" name="appointment_id" value="<?php echo $row['id']; ?>">
                                                    <select name="status" class="form-select form-select-sm" style="width: 120px;" required>
                                                        <option value="Pending" <?php if($row['status']=='Pending') echo 'selected'; ?>>Pending</option>
                                                        <option value="Approved" <?php if($row['status']=='Approved') echo 'selected'; ?>>Approved</option>
                                                        <option value="Rejected" <?php if($row['status']=='Rejected') echo 'selected'; ?>>Rejected</option>
                                                    </select>
                                                    <button type="submit" name="update_status" class="btn btn-sm text-white fw-semibold" style="background-color: #17365d;">Update</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">No appointment requests found for this hospital.</td>
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