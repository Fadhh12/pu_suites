<?php

// Harden the session cookie before any session is started. config.php is
// included before every session_start() call in the app (public pages
// never start a session at all, so this is a no-op cost for them), so
// this is the one place to set it that's guaranteed to run early enough.
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.use_strict_mode', '1');
    ini_set('session.cookie_httponly', '1'); // JS (and any injected XSS payload) can't read the session cookie
    ini_set('session.cookie_samesite', 'Lax'); // blocks the cookie being sent on cross-site form posts (CSRF)
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        ini_set('session.cookie_secure', '1'); // only send the cookie over HTTPS once the site is served on it
    }
}

/*
 * Local development uses the defaults below (XAMPP/Laragon style: root, no
 * password, localhost). When you deploy to real hosting, either:
 *   1) edit the 4 values directly with what your host's MySQL panel gives
 *      you (simplest on shared hosting like InfinityFree/Hostinger), or
 *   2) set DB_HOST/DB_USER/DB_PASS/DB_NAME as environment variables if your
 *      host supports it -- they'll be picked up automatically below.
 * Either way, never commit real production credentials to this file.
 */
$server   = getenv('DB_HOST') ?: 'localhost';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: '';
$database = getenv('DB_NAME') ?: 'PU_SUITES';

// PHP 8.1+ makes mysqli throw an exception on connection failure by default
// instead of just returning false, which turns a wrong password/host into a
// blank HTTP 500 instead of the friendly message below. Turn that reporting
// off so a bad connection behaves the same on every PHP version.
mysqli_report(MYSQLI_REPORT_OFF);
$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}

// Base nightly rate per room type (USD), before the bed/meal add-ons applied
// at booking-confirm time. Single source of truth -- the public site reads
// this to show prices on the room cards/detail pages, and
// admin/roomconfirm.php reads the same constant to total up a booking, so
// the advertised price and the billed price can never drift apart.
define('ROOM_RATES', [
    'Superior Room' => 3000,
    'Deluxe Room'   => 2000,
    'Guest House'   => 1500,
    'Single Room'   => 1000,
]);
