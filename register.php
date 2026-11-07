<?php
// Include database connection
include 'conn.php';

$error = "";
$success = "";

if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password']; 
    $role = 'parent'; // Fixed role as per requirements

    // Check if email already exists in the database
    $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check_email) > 0) {
        $error = "This email is already registered!";
    } else {
        // Insert user data into the database
        $query = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
        if (mysqli_query($conn, $query)) {
            $success = "Registration successful! You can now <a href='login.php' class='fw-bold' style='color: #17365d;'>Login</a>.";
        } else {
            $error = "Something went wrong, please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Registration - e-Vaccination</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Separate External CSS File -->
    <link rel="stylesheet" href="style.css?v=navy-2026">

    <link rel="icon" type="image/jpeg" href="material/logo1.jpg">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-light">

    <!-- Navbar -->
    <?php require __DIR__ . '/includes/header.php'; ?>

    <!-- Registration Section -->
    <div class="container-fluid p-0">
        <div class="row g-0 split-container align-items-center">
            
            <!-- Left Side: Registration Form -->
            <div class="col-lg-6 d-flex justify-content-center align-items-center py-5">
                <div class="col-md-8 col-lg-7 px-4">
                    <div class="card shadow-sm border-0 rounded-4 p-4 bg-white">
                        <h3 class="text-center fw-bold mb-4 text-dark">Parent Register</h3>

                        <?php if(!empty($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <?php if(!empty($success)): ?>
                            <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php endif; ?>

                        <form action="" method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Full Name</label>
                                <input type="text" name="name" class="form-control" required placeholder="Enter your full name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email Address</label>
                                <input type="email" name="email" class="form-control" required placeholder="name@example.com">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Password</label>
                                <input type="password" name="password" class="form-control" required placeholder="******">
                            </div>
                            <!-- Role is hidden and fixed as parent -->
                            <input type="hidden" name="role" value="parent">

                            <button type="submit" name="register" class="btn w-100 py-2 fw-bold text-white shadow-sm" style="background-color: #17365d;">Register Account</button>
                        </form>
                        <div class="text-center mt-3">
                            <small class="text-muted">Already have an account? <a href="login.php" style="color: #17365d;" class="fw-semibold">Login here</a></small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Image -->
            <div class="col-lg-6 d-none d-lg-block p-0">
                <img src="material/Register1.jpg" alt="Register Illustration" class="w-100 vh-100" style="object-fit: cover;">
            </div>

        </div>
    </div>

    <!-- Modern & Professional Footer -->
    <?php require __DIR__ . '/includes/footer.php'; ?>
</body>
</html>