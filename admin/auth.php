<?php
// Shared login guard -- require this at the very top of every admin page
// (before any HTML output). Several pages used to skip this check
// entirely, so visiting them directly by URL (edit/confirm/delete actions,
// the guest data export) worked without ever logging in.
//
// config.php is included *before* session_start() -- it hardens the
// session cookie flags (HttpOnly/SameSite/Secure), which only take effect
// if set before the session is opened.
include __DIR__ . '/../config.php';
session_start();

if (empty($_SESSION['usermail'])) {
    header('Location: ../login.php');
    exit();
}
