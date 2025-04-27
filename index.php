<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furfect Match</title>
    <!-- Font Awesome for burger icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Rammetto+One&display=swap" rel="stylesheet">
    <!-- CSS -->

    <link rel="stylesheet" href="assets/css/index.css">

</head>
<body>
    <?php include "views/components/header.php"; ?>
    
    <main>
        <!-- Home Section -->
        <section id="home" class="section home-section">
            <div class="container">
                <div class="content-wrapper">
                    <div class="image-container">
                        <img src="assets/images/home-pets.jpg" alt="Happy pets together">
                    </div>
                    <div class="text-content">
                        <h1>Find Your <span>Furfect Match</span> </h1>
                        <p class="subtitle">Connecting loving pets with caring owners since 2023</p>
                        <p>Our platform helps you find the ideal pet companion tailored to your lifestyle and preferences.</p>
                        <a href="auth.php" class="btn-primary">Get Started</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="section about-section">
            <div class="container">
                <div class="content-wrapper">
                    <div class="image-container">
                        <img src="assets/images/about-pets.jpg" alt="About our mission">
                    </div>
                    <div class="text-content">
                        <h2>Our Story</h2>
                        <p class="subtitle">Why we do what we do</p>
                        <p>Founded by pet lovers for pet lovers, Furfect Match was born out of a desire to create meaningful connections between animals and humans. We believe every pet deserves a loving home, and every person deserves the joy of pet companionship.</p>
                        <ul class="about-features">
                            <li><i class="fas fa-paw"></i> 1000+ successful matches</li>
                            <li><i class="fas fa-heart"></i> Verified pet profiles</li>
                            <li><i class="fas fa-home"></i> Shelter partnerships nationwide</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="section services-section">
            <div class="container">
                <div class="content-wrapper">
                    <div class="image-container">
                        <img src="assets/images/services-pets.jpg" alt="Our services">
                    </div>
                    <div class="text-content">
                        <h2>Our Services</h2>
                        <p class="subtitle">How we help you find your match</p>
                        <div class="service-cards">
                            <div class="service-card">
                                <i class="fas fa-dog"></i>
                                <h3>Pet Matching</h3>
                                <p>Our advanced algorithm matches you with pets based on your lifestyle and preferences.</p>
                            </div>
                            <div class="service-card">
                                <i class="fas fa-hand-holding-heart"></i>
                                <h3>Adoption Support</h3>
                                <p>Guidance through every step of the adoption process from application to homecoming.</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stories Section -->
        <section id="stories" class="section stories-section">
            <div class="container">
                <div class="content-wrapper">
                    <div class="image-container">
                        <img src="assets/images/stories-pets.jpg" alt="Success stories">
                    </div>
                    <div class="text-content">
                        <h2>Share Your Story</h2>
                        <p class="subtitle">Meet some of our happy matches</p>
                        <div class="testimonials">
                            <div class="testimonial">
                                <p>"Furfect Match helped me find my best friend Max. The process was so easy and the support team was amazing!"</p>
                                <div class="author">- Sarah J.</div>
                            </div>
                            <div class="testimonial">
                                <p>"After months of searching, I finally found the perfect cat through Furfect Match. Couldn't be happier!"</p>
                                <div class="author">- Michael T.</div>
                            </div>
                        </div>
                        <a href="#" class="btn-secondary">Share Your Story</a>
                    </div>
                </div>
            </div>
        </section>

    </main>
    
            <?php include "views/components/footer.php"; ?>
    

</body>
</html>