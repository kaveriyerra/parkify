#!/bin/bash
# startup.sh - Runs when Railway container starts
# Initializes the database schema if tables don't exist yet

echo "Starting Parkify..."

# Wait for MySQL to be ready (Railway MySQL may take a few seconds)
echo "Waiting for MySQL..."
until php -r "
\$host = getenv('MYSQLHOST') ?: '127.0.0.1';
\$port = getenv('MYSQLPORT') ?: '3306';
\$user = getenv('MYSQLUSER') ?: 'root';
\$pass = getenv('MYSQLPASSWORD') ?: '';
\$db   = getenv('MYSQLDATABASE') ?: 'parkify';
try {
    new PDO(\"mysql:host=\$host;port=\$port;dbname=\$db\", \$user, \$pass);
    echo 'ok';
} catch(Exception \$e) { exit(1); }
" 2>/dev/null | grep -q "ok"; do
  echo "MySQL not ready, retrying in 3 seconds..."
  sleep 3
done

echo "MySQL is ready!"

# Run SQL seed only if 'users' table doesn't exist (first run)
php -r "
\$host = getenv('MYSQLHOST') ?: '127.0.0.1';
\$port = getenv('MYSQLPORT') ?: '3306';
\$user = getenv('MYSQLUSER') ?: 'root';
\$pass = getenv('MYSQLPASSWORD') ?: '';
\$db   = getenv('MYSQLDATABASE') ?: 'parkify';
\$pdo = new PDO(\"mysql:host=\$host;port=\$port;dbname=\$db\", \$user, \$pass);
\$result = \$pdo->query(\"SHOW TABLES LIKE 'users'\")->fetch();
if (!\$result) {
    echo 'Initializing database schema...' . PHP_EOL;
    \$sql = file_get_contents('/var/www/html/database/parkify.sql');
    // Remove CREATE DATABASE and USE statements (Railway already has a DB)
    \$sql = preg_replace('/CREATE DATABASE.*?;/i', '', \$sql);
    \$sql = preg_replace('/USE.*?;/i', '', \$sql);
    \$pdo->exec(\$sql);
    echo 'Database initialized!' . PHP_EOL;
} else {
    echo 'Database already initialized, skipping.' . PHP_EOL;
}
"

echo "Starting Apache..."
apache2-foreground
