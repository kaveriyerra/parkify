# Parkify

Smart Vehicle Parking Reservation Platform.

## Setup Instructions

1. **Database Setup**
   - Create a MySQL database named `parkify`.
   - Import `database/parkify.sql` into the database. This script includes tables and seed data.
   - Update `config/db.php` if your local MySQL user/password differs from the defaults (`root` / empty string).

2. **Running the App**
   - Option A: Use XAMPP/WAMP. Move this directory to `htdocs` or `www` and navigate to `o`.
   - Option B: Use PHP built-in server. In the terminal:
     ```bash
     cd path/to/parkify
     php -S localhost:8000
     ```
     Then open `http://localhost:8000` in your browser.

## Default Credentials
- **Admin**: `admin@parkify.com` / `password`
- **User**: `john@example.com` / `password` (and others in the seed data)

## Key Technologies
- Frontend: HTML5, CSS3, JS, Bootstrap 5, Leaflet.js (maps), Chart.js
- Backend: PHP 8+, MySQL 8 (PDO)
