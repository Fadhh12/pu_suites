<?php
require 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" href="../image/President_University_Logo.png">
    <link rel="stylesheet" href="./css/admin.css">
    <!-- fontowesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>PU SUITES - Admin</title>
</head>

<body>
    <!-- mobile view -->
    <div id="mobileview">
        <i class="fa-solid fa-desktop"></i>
        <h5>This dashboard is built for a bigger screen</h5>
        <p>Please open the admin panel on a tablet or desktop to manage bookings, rooms, and staff.</p>
    </div>

    <!-- nav bar -->
    <nav class="uppernav">
        <div class="logo">
            <img class="bluebirdlogo" src="../image/President_University_Logo.png" alt="logo">
            <p>PU SUITES <span>Admin</span></p>
        </div>
        <div class="navright">
            <div class="whoami">
                <i class="fa-solid fa-circle-user"></i>
                <span><?php echo htmlspecialchars($_SESSION['usermail']); ?></span>
            </div>
            <a href="../logout.php" class="logoutbtn"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>
    </nav>
    <nav class="sidenav">
        <ul>
            <li class="pagebtn active"><img src="../image/icon/dashboard.png" alt=""><span>Dashboard</span></li>
            <li class="pagebtn"><img src="../image/icon/bed.png" alt=""><span>Room Booking</span></li>
            <li class="pagebtn"><img src="../image/icon/wallet.png" alt=""><span>Payments</span></li>
            <li class="pagebtn"><img src="../image/icon/bedroom.png" alt=""><span>Rooms</span></li>
            <li class="pagebtn"><img src="../image/icon/staff.png" alt=""><span>Staff</span></li>
        </ul>
    </nav>

    <!-- main section -->
    <div class="mainscreen">
        <iframe class="frames active" title="Dashboard" src="./dashboard.php" frameborder="0"></iframe>
        <iframe class="frames" title="Room Booking" src="./roombook.php" frameborder="0"></iframe>
        <iframe class="frames" title="Payments" src="./payment.php" frameborder="0"></iframe>
        <iframe class="frames" title="Rooms" src="./room.php" frameborder="0"></iframe>
        <iframe class="frames" title="Staff" src="./staff.php" frameborder="0"></iframe>
    </div>
</body>

<script src="./javascript/script.js"></script>

</html>
