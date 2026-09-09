<?php
include 'config.php';
session_start();

function prepareAndExecute($conn, $sql, $params)
{
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('mysqli error: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param(str_repeat('s', count($params)), ...$params);
    $stmt->execute();
    return $stmt;
}

// Brute-force throttle: lock an IP out for 15 minutes after 5 failed
// attempts. There was no limit at all before, so the login form could be
// hammered by a script indefinitely. Fails open (skips throttling instead
// of breaking login) if the login_attempts table hasn't been created yet
// -- see the migration note in PU_SUITES.sql -- so this doesn't lock
// everyone out on a site that hasn't run it.
const LOGIN_MAX_ATTEMPTS = 5;
const LOGIN_LOCKOUT_MINUTES = 15;

function recentFailedAttempts($conn, $ip)
{
    $sql = "SELECT COUNT(*) AS c FROM login_attempts WHERE ip = ? AND attempted_at > (NOW() - INTERVAL " . LOGIN_LOCKOUT_MINUTES . " MINUTE)";
    $stmt = @mysqli_prepare($conn, $sql);
    if (!$stmt) {
        return 0;
    }
    mysqli_stmt_bind_param($stmt, "s", $ip);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    return (int) ($row['c'] ?? 0);
}

function recordFailedAttempt($conn, $ip)
{
    $stmt = @mysqli_prepare($conn, "INSERT INTO login_attempts (ip) VALUES (?)");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $ip);
        mysqli_stmt_execute($stmt);
    }
    // Housekeeping: drop attempts old enough to no longer matter, so the
    // table doesn't grow forever.
    @mysqli_query($conn, "DELETE FROM login_attempts WHERE attempted_at < (NOW() - INTERVAL " . (LOGIN_LOCKOUT_MINUTES * 4) . " MINUTE)");
}

function clearFailedAttempts($conn, $ip)
{
    $stmt = @mysqli_prepare($conn, "DELETE FROM login_attempts WHERE ip = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $ip);
        mysqli_stmt_execute($stmt);
    }
}

if (isset($_POST['Emp_login_submit'])) {
    $email = $_POST['Emp_Email'];
    $password = $_POST['Emp_Password'];
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

    if (recentFailedAttempts($conn, $ip) >= LOGIN_MAX_ATTEMPTS) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                swal({ title: 'Too many attempts', text: 'Please wait a few minutes before trying again.', icon: 'warning' });
            });
        </script>";
    } else {
        // Look the account up by email only, then verify the password
        // against its bcrypt hash with password_verify() -- previously
        // this compared the submitted password to Emp_Password in plain
        // text (BINARY =), which meant every staff password was stored in
        // the database completely unencrypted.
        $sql = "SELECT Emp_Password FROM emp_login WHERE Emp_Email = ?";
        $stmt = prepareAndExecute($conn, $sql, [$email]);
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row && password_verify($password, $row['Emp_Password'])) {
            clearFailedAttempts($conn, $ip);
            session_regenerate_id(true); // rotate the session ID on login so a pre-login session can't be hijacked (session fixation)
            $_SESSION['usermail'] = $email;
            header("Location: admin/admin.php");
            exit();
        } else {
            recordFailedAttempt($conn, $ip);
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    swal({ title: 'Invalid Credentials', text: 'Please check your email and password.', icon: 'error' });
                });
            </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" href="./image/President_University_Logo.png">
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <title>Admin Portal - PU SUITES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js" defer></script>
    <style>
        body { 
            background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            display: flex; justify-content: center; align-items: center; 
            height: 100vh; font-family: 'Poppins', sans-serif; color: white; margin: 0; 
        }
        .login-box { 
            background: rgba(30, 41, 59, 0.8); 
            backdrop-filter: blur(15px);
            padding: 50px 40px; border-radius: 20px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.5); 
            width: 100%; max-width: 420px; text-align: center; 
            border: 1px solid rgba(255,255,255,0.1);
        }
        .login-box img { width: 90px; margin-bottom: 25px; filter: drop-shadow(0px 4px 6px rgba(0,0,0,0.3)); }
        .login-box h2 { font-weight: 600; margin-bottom: 35px; letter-spacing: 2px; color: #f8fafc; font-size: 24px; text-transform: uppercase;}
        .form-floating { margin-bottom: 25px; }
        .form-control { background: rgba(51, 65, 85, 0.6); border: 1px solid rgba(255,255,255,0.1); color: white; border-radius: 12px; padding: 1rem 0.75rem;}
        .form-control:focus { background: rgba(51, 65, 85, 0.9); color: white; box-shadow: 0 0 0 0.25rem rgba(56, 189, 248, 0.25); border-color: #38bdf8; }
        .form-floating label { color: #cbd5e1; }
        .form-control:-webkit-autofill { -webkit-box-shadow: 0 0 0 30px #334155 inset !important; -webkit-text-fill-color: white !important; }
        .btn-login { 
            background: linear-gradient(to right, #0ea5e9, #3b82f6);
            border: none; padding: 14px; width: 100%; 
            border-radius: 12px; font-weight: 600; color: white; 
            transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        }
        .btn-login:hover { background: linear-gradient(to right, #0284c7, #2563eb); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(59, 130, 246, 0.6); }
        .btn-login:active { transform: translateY(0); }
    </style>
</head>
<body>
    <div class="login-box">
        <img src="./image/President_University_Logo.png" alt="PU Logo">
        <h2>Admin Portal</h2>
        <form action="" method="POST">
            <div class="form-floating">
                <input type="email" class="form-control" name="Emp_Email" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput">Staff Email</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="Emp_Password" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
            </div>
            <button type="submit" name="Emp_login_submit" class="btn-login mt-2">Secure Login</button>
        </form>
        <a href="index.php" style="display: inline-block; margin-top: 20px; color: #94a3b8; font-size: 13px; text-decoration: none;">&larr; Back to website</a>
    </div>
</body>
</html>
