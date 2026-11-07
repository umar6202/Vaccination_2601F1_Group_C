<?php
session_start();
include 'conn.php';

// Check if admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$admin_name = $_SESSION['user_name'];
$success = "";

// Delete Message Action
if (isset($_GET['delete_id'])) {
    $del_id = intval($_GET['delete_id']);
    mysqli_query($conn, "DELETE FROM admin_messages WHERE id = $del_id");
    $success = "Message deleted successfully!";
}

// Fetch all messages
$all_messages = mysqli_query($conn, "SELECT * FROM admin_messages ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Messages - Admin Dashboard</title>
    <!-- Bootstrap 5 CSS & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css?v=navy-2026">

    <link rel="icon" type="image/jpeg" href="material/logo1.jpg">
    <style>
        body {
            background: linear-gradient(135deg, #f3f6fb 0%, #eaf0f8 100%);
            min-height: 100vh;
            font-family: system-ui, sans-serif;
        }
        .custom-navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <?php require __DIR__ . '/includes/header.php'; ?>

    <!-- Main Container -->
    <div class="container my-5">

        <?php if(!empty($success)): ?>
            <div class="alert alert-success rounded-3 alert-dismissible fade show"><?php echo $success; ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        <?php endif; ?>

        <!-- Messages Table Card -->
        <div class="card shadow-sm border-0 rounded-4 p-4 bg-white">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="fw-bold text-dark mb-0"><i class="fas fa-envelope-open-text text-primary me-2"></i>Received Inquiries & Support Messages</h4>
                <span class="badge bg-primary fs-6"><?php echo ($all_messages) ? mysqli_num_rows($all_messages) : 0; ?> Total Messages</span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Sender Name</th>
                            <th>Email Address</th>
                            <th>Role / Type</th>
                            <th>Message</th>
                            <th>Received At</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($all_messages && mysqli_num_rows($all_messages) > 0): ?>
                            <?php while ($msg = mysqli_fetch_assoc($all_messages)): ?>
                                <tr>
                                    <td class="fw-semibold"><?php echo htmlspecialchars($msg['sender_name']); ?></td>
                                    <td><a href="mailto:<?php echo htmlspecialchars($msg['sender_email']); ?>" class="text-decoration-none"><?php echo htmlspecialchars($msg['sender_email']); ?></a></td>
                                    <td>
                                        <?php if ($msg['sender_role'] == 'Parent'): ?>
                                            <span class="badge bg-info text-dark px-3 py-2">Parent</span>
                                        <?php elseif ($msg['sender_role'] == 'Hospital'): ?>
                                            <span class="badge bg-success px-3 py-2">Hospital</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary px-3 py-2">Visitor</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="max-width: 300px;"><?php echo nl2br(htmlspecialchars($msg['sender_message'])); ?></td>
                                    <td class="text-muted small"><?php echo date('M d, Y - h:i A', strtotime($msg['created_at'])); ?></td>
                                    <td class="text-end">
                                        <a href="admin_messages.php?delete_id=<?php echo $msg['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this message?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No messages received yet.</td>
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