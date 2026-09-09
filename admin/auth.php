<?php
// Shared login guard -- require this at the very top of every admin page
// (before any HTML output). Several pages used to skip this check
// entirely, so visiting them directly by URL (edit/confirm/delete actions,
// the guest data export) worked without ever logging in.
session_start();
include __DIR__ . '/../config.php';

if (empty($_SESSION['usermail'])) {
    header('Location: ../login.php');
    exit();
}
