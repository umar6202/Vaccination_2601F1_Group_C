<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Information - e-Vaccination</title>
    <link rel="icon" href="material/logo1.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css?v=navy-2026">
</head>
<body>
    <?php require __DIR__ . '/includes/header.php'; ?>

    <header class="about-hero text-center text-white">
        <div class="container py-5">
            <h1 class="fw-bold">System Administration</h1>
            <p class="lead mb-0">How administrators manage the e-Vaccination network.</p>
        </div>
    </header>

    <main class="container py-5">
        <div class="row g-4">
            <section class="col-md-4">
                <div class="card h-100 p-4">
                    <i class="fas fa-hospital fs-2 text-primary mb-3"></i>
                    <h2 class="h5 fw-bold">Hospital Requests</h2>
                    <p class="text-muted mb-0">Review requests and add approved hospitals.</p>
                </div>
            </section>
            <section class="col-md-4">
                <div class="card h-100 p-4">
                    <i class="fas fa-calendar-check fs-2 text-primary mb-3"></i>
                    <h2 class="h5 fw-bold">Appointments</h2>
                    <p class="text-muted mb-0">View appointment activity across the system.</p>
                </div>
            </section>
            <section class="col-md-4">
                <div class="card h-100 p-4">
                    <i class="fas fa-envelope fs-2 text-primary mb-3"></i>
                    <h2 class="h5 fw-bold">Support Messages</h2>
                    <p class="text-muted mb-0">Review questions sent by parents and hospitals.</p>
                </div>
            </section>
        </div>
        <div class="text-center mt-5">
            <a href="login.php" class="btn btn-primary btn-lg">Admin Login</a>
       </div>
    </main>



    <?php
include 'conn.php';

$error = '';

if (isset($_POST['send_message'])) {
    $name = mysqli_real_escape_string($conn, $_POST['sender_name']);
    $email = mysqli_real_escape_string($conn, $_POST['sender_email']);
    $role = mysqli_real_escape_string($conn, $_POST['sender_role']);
    $message = mysqli_real_escape_string($conn, $_POST['sender_message']);

    $query = "INSERT INTO admin_messages (sender_name, sender_email, sender_role, sender_message)
              VALUES ('$name', '$email', '$role', '$message')";

    if (mysqli_query($conn, $query)) {
        header('Location: admin_contact.php?sent=1');
        exit();
    }

    $error = 'Your message could not be sent. Please try again.';
}
?>


    <main class="container py-5">
        <div class="card p-4 p-md-5 mx-auto contact-card">
            <h1 class="h3 fw-bold text-center">Contact Admin</h1>
            <p class="text-muted text-center">Send a question or message to the system administrator.</p>

            <?php if (isset($_GET['sent'])): ?>
                <div class="alert alert-success">Your message was sent.</div>
            <?php endif; ?>
            <?php if ($error !== ''): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="post">
                <label class="form-label" for="sender_name">Name</label>
                <input class="form-control mb-3" id="sender_name" name="sender_name" required>

                <label class="form-label" for="sender_email">Email</label>
                <input class="form-control mb-3" id="sender_email" name="sender_email" type="email" required>

                <label class="form-label" for="sender_role">I am a</label>
                <select class="form-select mb-3" id="sender_role" name="sender_role" required>
                    <option value="parent">Parent</option>
                    <option value="hospital">Hospital representative</option>
                    <option value="admin">Other</option>
                </select>

                <label class="form-label" for="sender_message">Message</label>
                <textarea class="form-control mb-3" id="sender_message" name="sender_message" rows="5" required></textarea>
                <button class="btn btn-primary w-100" type="submit" name="send_message">Send Message</button>
            </form>
        </div>
    </main>

    <?php require __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
