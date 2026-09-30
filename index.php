<?php
// index.php
require_once __DIR__ . '/includes/header.php';

// Fetch stats for the home page
$totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$totalLocations = $pdo->query("SELECT COUNT(*) FROM parking_areas")->fetchColumn();
$totalBookings = $pdo->query("SELECT COUNT(*) FROM bookings")->fetchColumn();

$feedbacks = $pdo->query("SELECT f.rating, f.comment, u.name FROM feedback f JOIN users u ON f.user_id = u.id ORDER BY f.created_at DESC LIMIT 3")->fetchAll();
?>

<!-- Hero Section -->
<section class="hero-section py-5 bg-light-section position-relative overflow-hidden">
    <div class="container py-5 position-relative z-1">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4 text-primary">Reserve Your Parking Space Before You Arrive</h1>
                <p class="lead mb-4 text-muted">Smart, seamless, and secure parking reservations. Find the best spots in the city with real-time availability and guaranteed entry.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="<?php echo $baseUrl; ?>/pages/search.php" class="btn btn-primary btn-lg px-4 shadow">Book Parking <i class="bi bi-arrow-right ms-2"></i></a>
                    <a href="<?php echo $baseUrl; ?>/pages/search.php" class="btn btn-outline-secondary btn-lg px-4">Explore Locations</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1573348722427-f1d6819fdf98?w=800&auto=format&fit=crop" alt="Smart Parking" class="img-fluid rounded-4 shadow-lg skeleton-img" style="object-fit: cover;">
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-5 border-bottom border-top">
    <div class="container">
        <div class="row text-center gy-4">
            <div class="col-md-4">
                <h2 class="display-5 fw-bold text-primary"><?php echo number_format($totalUsers + 500); ?>+</h2>
                <p class="text-muted mb-0">Happy Users</p>
            </div>
            <div class="col-md-4">
                <h2 class="display-5 fw-bold text-secondary"><?php echo number_format($totalLocations); ?></h2>
                <p class="text-muted mb-0">Prime Locations</p>
            </div>
            <div class="col-md-4">
                <h2 class="display-5 fw-bold text-accent"><?php echo number_format($totalBookings + 1200); ?>+</h2>
                <p class="text-muted mb-0">Successful Bookings</p>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-light-section">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Why Choose Parkify?</h2>
            <p class="text-muted">Designed for a frictionless parking experience.</p>
        </div>
        <div class="row gy-4">
            <!-- Feature 1 -->
            <div class="col-md-4">
                <div class="glass-card p-4 h-100 text-center">
                    <div class="fs-1 text-primary mb-3"><i class="bi bi-clock-history"></i></div>
                    <h5 class="fw-bold">Real-time Availability</h5>
                    <p class="text-muted small">See exactly which slots are open in real-time before you arrive.</p>
                </div>
            </div>
            <!-- Feature 2 -->
            <div class="col-md-4">
                <div class="glass-card p-4 h-100 text-center">
                    <div class="fs-1 text-secondary mb-3"><i class="bi bi-qr-code-scan"></i></div>
                    <h5 class="fw-bold">QR Entry pass</h5>
                    <p class="text-muted small">Scan your digital pass at the gate for seamless, touchless entry.</p>
                </div>
            </div>
            <!-- Feature 3 -->
            <div class="col-md-4">
                <div class="glass-card p-4 h-100 text-center">
                    <div class="fs-1 text-accent mb-3"><i class="bi bi-magic"></i></div>
                    <h5 class="fw-bold">Smart Recommendations</h5>
                    <p class="text-muted small">AI-powered suggestions based on your destination and preferences.</p>
                </div>
            </div>
            <!-- Feature 4 -->
            <div class="col-md-4">
                <div class="glass-card p-4 h-100 text-center">
                    <div class="fs-1 text-danger mb-3"><i class="bi bi-heart-fill"></i></div>
                    <h5 class="fw-bold">Favorites</h5>
                    <p class="text-muted small">Save your go-to parking spots for quick and easy re-booking.</p>
                </div>
            </div>
            <!-- Feature 5 -->
            <div class="col-md-4">
                <div class="glass-card p-4 h-100 text-center">
                    <div class="fs-1 text-info mb-3"><i class="bi bi-map-fill"></i></div>
                    <h5 class="fw-bold">Live Map</h5>
                    <p class="text-muted small">Interactive maps to guide you directly to the best parking areas.</p>
                </div>
            </div>
            <!-- Feature 6 -->
            <div class="col-md-4">
                <div class="glass-card p-4 h-100 text-center">
                    <div class="fs-1 text-success mb-3"><i class="bi bi-calculator-fill"></i></div>
                    <h5 class="fw-bold">Cost Calculator</h5>
                    <p class="text-muted small">Transparent pricing. Know exactly what you'll pay upfront.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-5">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold">What Our Users Say</h2>
        </div>
        <div class="row gy-4 justify-content-center">
            <?php foreach ($feedbacks as $feedback): ?>
            <div class="col-md-4">
                <div class="glass-card p-4 h-100">
                    <div class="mb-3 text-warning">
                        <?php for($i=1; $i<=5; $i++): ?>
                            <i class="bi bi-star-fill <?php echo $i <= $feedback['rating'] ? '' : 'text-muted'; ?>"></i>
                        <?php endfor; ?>
                    </div>
                    <p class="fst-italic text-muted">"<?php echo htmlspecialchars($feedback['comment']); ?>"</p>
                    <h6 class="fw-bold mt-3 mb-0">- <?php echo htmlspecialchars($feedback['name']); ?></h6>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5 bg-light-section">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Frequently Asked Questions</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion shadow-sm rounded-3" id="faqAccordion">
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                How does the QR entry work?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Once your booking is confirmed, you'll receive a unique QR code. Simply scan this code at the parking scanner to enter and exit.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Can I cancel my reservation?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Yes, you can cancel your reservation up to 30 minutes before your scheduled entry time for a full refund to your wallet.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                What happens if I overstay my booking time?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                If you overstay, the additional time will be automatically calculated at the location's hourly rate and billed to your saved payment method or wallet upon exit.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
