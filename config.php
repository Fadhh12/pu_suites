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

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    die('Database connection failed. Please try again shortly.');
}
