<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motorcycle Haven - Premium Second-Hand Motorcycles</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Motorcycle Haven</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#motorcycles">Motorcycles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
                <div class="auth-buttons">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <a href="dashboard/dashboard.php" class="btn btn-outline-light">Dashboard</a>
                        <a href="login/logout.php" class="btn btn-danger">Logout</a>
                    <?php else: ?>
                        <a href="login/login.php" class="btn btn-outline-light">Login</a>
                        <a href="register/register.php" class="btn btn-primary">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Find Your Perfect Second-Hand Motorcycle Today</h1>
                <p class="hero-subtitle">Quality pre-owned motorcycles at unbeatable prices. Easy financing and certified quality guaranteed.</p>
                <a href="#motorcycles" class="btn btn-primary btn-lg">Browse Motorcycles</a>
            </div>
        </div>
    </section>

    <!-- Featured Motorcycles Section -->
    <section id="motorcycles" class="featured-section">
        <div class="container">
            <h2 class="section-title">Featured Motorcycles</h2>
            <div id="motorcycleCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#motorcycleCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#motorcycleCarousel" data-slide-to="1"></li>
                    <li data-target="#motorcycleCarousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card feature-card">
                                    <div class="position-relative">
                                        <img src="https://images.unsplash.com/photo-1558981806-ec527fa84c39?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="card-img-top" alt="Sport Bike">
                                        <div class="price-tag">₱150,000</div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Honda CBR 600RR</h5>
                                        <p class="card-text">2019 Model • 15,000 km • Excellent Condition</p>
                                        <a href="#" class="btn btn-outline-primary">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card feature-card">
                                    <div class="position-relative">
                                        <img src="https://images.unsplash.com/photo-1558981806-ec527fa84c39?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="card-img-top" alt="Adventure Bike">
                                        <div class="price-tag">₱180,000</div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Kawasaki Versys 650</h5>
                                        <p class="card-text">2020 Model • 10,000 km • Like New</p>
                                        <a href="#" class="btn btn-outline-primary">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card feature-card">
                                    <div class="position-relative">
                                        <img src="https://images.unsplash.com/photo-1558981806-ec527fa84c39?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="card-img-top" alt="Naked Bike">
                                        <div class="price-tag">₱120,000</div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Yamaha MT-07</h5>
                                        <p class="card-text">2018 Model • 20,000 km • Well Maintained</p>
                                        <a href="#" class="btn btn-outline-primary">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#motorcycleCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#motorcycleCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose-section">
        <div class="container">
            <h2 class="section-title">Why Choose Us</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="benefit-item">
                        <i class="fas fa-check-circle benefit-icon"></i>
                        <h4 class="benefit-title">Certified Quality</h4>
                        <p>All motorcycles undergo thorough inspection</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="benefit-item">
                        <i class="fas fa-tags benefit-icon"></i>
                        <h4 class="benefit-title">Best Prices</h4>
                        <p>Competitive pricing with flexible payment options</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="benefit-item">
                        <i class="fas fa-shield-alt benefit-icon"></i>
                        <h4 class="benefit-title">Verified Sellers</h4>
                        <p>Trusted sellers with proven track records</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="benefit-item">
                        <i class="fas fa-tools benefit-icon"></i>
                        <h4 class="benefit-title">After-Sales Support</h4>
                        <p>Comprehensive warranty and maintenance support</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <h2 class="section-title">What Our Customers Say</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p class="testimonial-text">"Found my dream bike at an amazing price. The quality check process was thorough and transparent."</p>
                        <p class="testimonial-author">- John Doe, Honda CBR Owner</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p class="testimonial-text">"The team was professional and helped me find the perfect motorcycle within my budget."</p>
                        <p class="testimonial-author">- Jane Smith, Kawasaki Owner</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p class="testimonial-text">"Great experience from start to finish. The financing options made it easy to get my new ride."</p>
                        <p class="testimonial-author">- Mike Johnson, Yamaha Owner</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container text-center">
            <h3>Stay Updated with New Listings</h3>
            <p class="mb-4">Subscribe to our newsletter for the latest motorcycle listings and exclusive offers.</p>
            <form class="newsletter-form">
                <div class="input-group">
                    <input type="email" class="form-control" placeholder="Enter your email" required>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Subscribe</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="footer-title">Motorcycle Haven</h5>
                    <p>Your trusted source for quality pre-owned motorcycles.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <h5 class="footer-title">Contact Us</h5>
                    <ul class="footer-links">
                        <li><i class="fas fa-map-marker-alt mr-2"></i> Palawan, Philippines</li>
                        <li><i class="fas fa-phone mr-2"></i> 09123456789</li>
                        <li><i class="fas fa-envelope mr-2"></i> info@motorcyclehaven.com</li>
                    </ul>
                </div>
            </div>
            <hr class="bg-light">
            <div class="text-center">
                <p>&copy; 2024 Motorcycle Haven. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>