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

if (isset($_POST['Emp_login_submit'])) {
    $email = $_POST['Emp_Email'];
    $password = $_POST['Emp_Password'];
    $sql = "SELECT * FROM emp_login WHERE Emp_Email = ? AND Emp_Password = BINARY ?";
    $stmt = prepareAndExecute($conn, $sql, [$email, $password]);
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['usermail'] = $email;
        header("Location: admin/admin.php");
        exit();
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                swal({ title: 'Invalid Credentials', text: 'Please check your email and password.', icon: 'error' });
            });
        </script>";
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
    <title>Admin Portal - PU SUITES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
