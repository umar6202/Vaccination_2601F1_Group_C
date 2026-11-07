<nav class="navbar navbar-expand-lg sticky-top site-navbar">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
            <img class="site-brand-logo" src="material/logo1.jpg" width="40" height="40" alt="">
            e-Vaccination
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#siteNavigation" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="siteNavigation">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="parent_info.php">Parents</a></li>
                <li class="nav-item"><a class="nav-link" href="hospital_info.php">Hospitals</a></li>
                <li class="nav-item"><a class="nav-link" href="admin_info.php">Admin</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="sitemap.php">Sitemap</a></li>

                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'parent'): ?>
                    <li class="nav-item"><a class="nav-link" href="parent_dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="hospitals.php">Book Appointment</a></li>
                <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'hospital'): ?>
                    <li class="nav-item"><a class="nav-link" href="hospital_dashboard.php">Dashboard</a></li>
                <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="admin_messages.php">Messages</a></li>
                <?php endif; ?>
            </ul>

            <?php if (isset($_SESSION['user_id'])): ?>
                <a class="btn btn-outline-danger" href="logout.php">Logout</a>
            <?php else: ?>
                <div class="d-flex gap-2">
                    <a class="btn btn-outline-primary" href="login.php">Login</a>
                    <a class="btn btn-primary" href="register.php">Register</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>
