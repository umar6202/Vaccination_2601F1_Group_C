<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - e-Vaccination</title>
    <link rel="icon" href="material/logo1.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css?v=navy-2026">
</head>
<body>
    <?php require __DIR__ . '/includes/header.php'; ?>

    <header class="about-hero text-center">
        <div class="container py-5">
            <h1 class="fw-bold text-white">About e-Vaccination</h1>
            <p class="lead mb-0 text-white">Helping families and hospitals manage child immunization in one place.</p>
        </div>
    </header>

    <main class="container py-5">
        <div class="row g-4 mb-5">
            <section class="col-lg-6">
                <div class="card h-100 p-4">
                    <h2 class="h4 fw-bold">Our Purpose</h2>
                    <p>We help parents keep track of their children's vaccines and book appointments at registered hospitals.</p>
                    <p class=" mb-0">Hospitals can manage appointments while administrators review hospital requests.</p>
                </div>
            </section>
            <section class="col-lg-6">
                <div class="card h-100 p-4">
                    <h2 class="h4 fw-bold">Why Use the System?</h2>
                    <ul class=" mb-0">
                        <li>Keep children's vaccination records together.</li>
                        <li>Book appointments online.</li>
                        <li>Check appointment status in your portal.</li>
                    </ul>
                </div>
            </section>
        </div>

        <section class="row g-4 text-center mb-5" aria-label="System statistics">
            <div class="col-md-4">
                <div class="card p-4">
                    <i class="fas fa-hospital fs-2 text-primary mb-3"></i>
                    <h2 class="h3 fw-bold"><span class="counter" data-count="25">0</span>+</h2>
                    <p class=" mb-0">Partner Hospitals</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4">
                    <i class="fas fa-users fs-2 text-primary mb-3"></i>
                    <h2 class="h3 fw-bold"><span class="counter" data-count="1200">0</span>+</h2>
                    <p class=" mb-0">Registered Parents</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4">
                    <i class="fas fa-syringe fs-2 text-primary mb-3"></i>
                    <h2 class="h3 fw-bold"><span class="counter" data-count="3500">0</span>+</h2>
                    <p class=" mb-0">Vaccines Administered</p>
                </div>
            </div>
        </section>


    </main>


        <header class="about-hero text-center text-white">
        <div class="container py-5">
            <h1 class="fw-bold">Frequently Asked Questions</h1>
            <p class="lead mb-0">Quick answers about using e-Vaccination.</p>
        </div>
    </header>

    <main class="container py-5">
        <div class="accordion" id="faq">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#answer1">
                        How do I add my child?
                    </button>
                </h2>
                <div id="answer1" class="accordion-collapse collapse show" data-bs-parent="#faq">
                    <div class="accordion-body">Register and log in as a parent, then add your child from the parent dashboard.</div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#answer2">
                        How do I book an appointment?
                    </button>
                </h2>
                <div id="answer2" class="accordion-collapse collapse" data-bs-parent="#faq">
                    <div class="accordion-body">Open Hospitals & Booking from your parent dashboard and submit an appointment request.</div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#answer3">
                        Where can I check appointment status?
                    </button>
                </h2>
                <div id="answer3" class="accordion-collapse collapse" data-bs-parent="#faq">
                    <div class="accordion-body">Your parent dashboard lists appointments and their current status.</div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#answer4">
                        How can a hospital join the system?
                    </button>
                </h2>
                <div id="answer4" class="accordion-collapse collapse" data-bs-parent="#faq">
                    <div class="accordion-body">Use the Hospital Portal to submit a partnership request for administrator review.</div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.querySelectorAll('.counter').forEach(function (counter) {
            var target = Number(counter.dataset.count);
            var number = 0;
            var timer = setInterval(function () {
                number += Math.ceil(target / 50);
                if (number >= target) {
                    number = target;
                    clearInterval(timer);
                }
                counter.textContent = number.toLocaleString();
            }, 30);
        });
    </script>
    <?php require __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
