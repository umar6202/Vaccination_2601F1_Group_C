<?php
// Start session and include database connection
session_start();
include 'conn.php';

$error = "";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $selected_role = $_POST['role']; // Get role from dropdown

    // Check if user exists in the database with the selected role
    $query = "SELECT * FROM users WHERE email = '$email' AND role = '$selected_role'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        
        // Verify password
        if ($password == $user['password']) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on user role
            if ($user['role'] == 'parent') {
                header("Location: parent_dashboard.php");
                exit();
            } elseif ($user['role'] == 'hospital') {
                header("Location: hospital_dashboard.php");
                exit();
            } elseif ($user['role'] == 'admin') {
                header("Location: admin_dashboard.php");
                exit();
            } else {
                $error = "Invalid user role assigned.";
            }

        } else {
            $error = "Invalid password, please try again.";
        }
    } else {
        $error = "No account found with this email for the selected role.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - e-Vaccination</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

    <!-- Main Login Section -->
    <div class="container-fluid p-0">
        <div class="row g-0 split-container align-items-center">
            
            <!-- Left Side: Login Form with Dropdown -->
            <div class="col-lg-6 d-flex justify-content-center align-items-center py-5">
                <div class="col-md-8 col-lg-7 px-4">
                    <div class="card shadow-sm border-0 rounded-4 p-4 bg-white">
                        <h3 class="text-center fw-bold mb-4 text-dark">Portal Login</h3>

                        <?php if(!empty($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <form action="" method="POST">
                            <!-- Role Dropdown -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Login As</label>
                                <select name="role" class="form-select" required>
                                    <option value="" selected disabled>Select your role...</option>
                                    <option value="parent">Parent</option>
                                    <option value="hospital">Hospital Representative</option>
                                    <option value="admin">System Administrator</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email Address</label>
                                <input type="email" name="email" class="form-control" required placeholder="name@example.com">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Password</label>
                                <input type="password" name="password" class="form-control" required placeholder="******">
                            </div>

                            <button type="submit" name="login" class="btn w-100 py-2 fw-bold text-white shadow-sm" style="background-color: #17365d;">Login to Portal</button>
                        </form>

                        <div class="text-center mt-3">
                            <small class="text-muted">Don't have a parent account? <a href="register.php" style="color: #17365d;" class="fw-semibold">Register here</a></small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Image -->
            <div class="col-lg-6 d-none d-lg-block p-0">
                <img src="material/login1.jpeg" alt="Login Illustration" class="w-100 vh-100" style="object-fit: cover;">
            </div>

        </div>
    </div>

    <!-- Modern & Professional Footer -->
    <?php require __DIR__ . '/includes/footer.php'; ?>
</body>
</html>