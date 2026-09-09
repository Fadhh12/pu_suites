<?php

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
