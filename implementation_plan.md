# Parkify Implementation Plan

This document outlines the architecture, database schema, and implementation plan for **Parkify** — a smart vehicle parking reservation platform. 

## Goal Description

Build a complete, production-ready, full-stack web application. Users can search for parking, view live slot availability, reserve a specific slot, pay online, and get a QR-code entry pass. Admins can manage locations, slots, bookings, payments, and view analytics.

The application will use HTML5, CSS3, JavaScript (ES6+), Bootstrap 5, and vanilla PHP 8+ with MySQL 8.

## User Review Required

> [!IMPORTANT]
> The database schema requires a MySQL server. Ensure you have XAMPP, WAMP, or a dedicated MySQL server installed to import the `parkify.sql` file.

> [!NOTE]
> The payment processing is simulated as requested. If a real gateway is needed in the future, the architecture will support dropping in Razorpay or Stripe.

## Open Questions

1. **Email Sending:** For the "Forgot Password" flow, do you want to use PHP's native `mail()` function, PHPMailer, or just keep it as a simulated UI toast?
2. **Web Server Environment:** Are you running this locally with XAMPP (Apache) or PHP's built-in server? This will help us ensure the routing and base URLs are set up correctly.

## Proposed Changes

We will create the following directory structure and files in `d:\project\parkify`:

### Configuration & Database
Setup the core database connection and schema.
- [NEW] `parkify/config/db.php`: PDO database connection.
- [NEW] `parkify/database/parkify.sql`: The complete database schema with seed data.

### Includes (Shared Components)
Reusable PHP components for layout and authentication.
- [NEW] `parkify/includes/header.php`: Navigation, CSS includes, dark mode toggle.
- [NEW] `parkify/includes/footer.php`: Footer, JS includes.
- [NEW] `parkify/includes/auth.php`: Session validation helpers.

### Assets (Frontend)
CSS, JavaScript, and Images.
- [NEW] `parkify/assets/css/style.css`: Custom CSS, dark mode variables, glassmorphism.
- [NEW] `parkify/assets/js/main.js`: Global JS, dark mode logic, interactive components.
- [NEW] `parkify/assets/images/`: Placeholder images/icons.

### Public Pages
User-facing frontend pages.
- [NEW] `parkify/index.php`: Home page with hero, live stats, feature cards.
- [NEW] `parkify/pages/login.php`: User/Admin login form.
- [NEW] `parkify/pages/register.php`: User registration.
- [NEW] `parkify/pages/dashboard.php`: User dashboard overview.
- [NEW] `parkify/pages/search.php`: Parking search with Leaflet.js map.
- [NEW] `parkify/pages/slot-selection.php`: Slot grid selection.
- [NEW] `parkify/pages/booking.php`: Booking confirmation and details.
- [NEW] `parkify/pages/payment.php`: Simulated payment gateway & QR generation.
- [NEW] `parkify/pages/booking-history.php`: User's past bookings.
- [NEW] `parkify/pages/profile.php`: User profile and vehicle management.
- [NEW] `parkify/pages/static/`: Static pages like Contact, About, FAQ, Privacy, Terms.

### Admin Panel
Pages for administrators.
- [NEW] `parkify/admin/dashboard.php`: Admin overview with Chart.js charts.
- [NEW] `parkify/admin/users.php`: Manage users.
- [NEW] `parkify/admin/locations.php`: Manage parking locations.
- [NEW] `parkify/admin/slots.php`: Manage parking slots.
- [NEW] `parkify/admin/bookings.php`: View and manage bookings.
- [NEW] `parkify/admin/payments.php`: View transactions.
- [NEW] `parkify/admin/reports.php`: Export reports.

### API Endpoints
RESTful PHP endpoints returning JSON for AJAX calls.
- [NEW] `parkify/api/search.php`: Handle search and filtering.
- [NEW] `parkify/api/book.php`: Process bookings.
- [NEW] `parkify/api/pay.php`: Process simulated payments.
- [NEW] `parkify/api/slot-status.php`: Fetch live slot availability.

### Documentation
- [NEW] `parkify/README.md`: Setup instructions and overview.

## Verification Plan

### Automated Tests
Due to the procedural PHP nature, we will rely on manual testing for end-to-end flows, verifying HTTP status codes and JSON responses for API endpoints.

### Manual Verification
1. Import `parkify.sql` into MySQL.
2. Configure `db.php` with credentials.
3. Start local PHP server (`php -S localhost:8000 -t parkify`).
4. Register a new user and log in.
5. Search for a parking spot, select a slot, and complete a booking flow (including simulated payment).
6. Verify the generated QR code.
7. Log in as an admin and verify dashboard charts and CRUD operations.
