<?php
    require 'auth.php';

    // roombook
    $roombooksql = "SELECT * FROM roombook";
    $roombookre = mysqli_query($conn, $roombooksql);
    $roombookrow = mysqli_num_rows($roombookre);

    // pending confirmations -- bookings the admin still needs to act on
    $pendingsql = "SELECT COUNT(*) AS c FROM roombook WHERE stat = 'NotConfirm'";
    $pendingrow = mysqli_fetch_assoc(mysqli_query($conn, $pendingsql));
    $pendingcount = $pendingrow['c'];

    // staff
    $staffsql = "SELECT * FROM staff";
    $staffre = mysqli_query($conn, $staffsql);
    $staffrow = mysqli_num_rows($staffre);

    // room
    $roomsql = "SELECT * FROM room";
    $roomre = mysqli_query($conn, $roomsql);
    $roomrow = mysqli_num_rows($roomre);

    // roombook counts per room type, for the doughnut chart
    $roomTypes = ['Superior Room', 'Deluxe Room', 'Guest House', 'Single Room'];
    $roomTypeCounts = [];
    foreach ($roomTypes as $type) {
        $stmt = mysqli_prepare($conn, "SELECT COUNT(*) AS c FROM roombook WHERE RoomType = ?");
        mysqli_stmt_bind_param($stmt, "s", $type);
        mysqli_stmt_execute($stmt);
        $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
        $roomTypeCounts[] = (int) $row['c'];
    }

    // revenue per checkout date, for the profit chart
    $query = "SELECT cout, finaltotal FROM payment ORDER BY cout ASC";
    $result = mysqli_query($conn, $query);
    $profitLabels = [];
    $profitData = [];
    $tot = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $profit = $row["finaltotal"] * 10 / 100;
        $profitLabels[] = $row["cout"];
        $profitData[] = round($profit, 2);
        $tot += $profit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/dashboard.css">
    <!-- chart.js (also replaces the old jQuery + Raphael + Morris.js stack
         that used to power just the profit bar chart) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>PU SUITES - Admin</title>
</head>
<body>
   <div class="databox">
        <div class="box roombookbox">
          <h2>Total Reservations</h2>
          <h1><?php echo $roombookrow ?> <span>/ <?php echo $roomrow ?> rooms</span></h1>
        </div>
        <div class="box pendingbox">
          <h2>Pending Confirmation</h2>
          <h1><?php echo $pendingcount ?></h1>
        </div>
        <div class="box guestbox">
          <h2>Total Staff</h2>
          <h1><?php echo $staffrow ?></h1>
        </div>
        <div class="box profitbox">
          <h2>Profit</h2>
          <h1><span>$</span><?php echo number_format($tot, 2) ?></h1>
        </div>
    </div>
    <div class="chartbox">
        <div class="bookroomchart">
            <h3>Bookings by Room Type</h3>
            <canvas id="bookroomchart"></canvas>
        </div>
        <div class="profitchart">
            <h3>Profit by Checkout Date</h3>
            <canvas id="profitchart"></canvas>
        </div>
    </div>
</body>

<script>
    const doughnutChart = new Chart(document.getElementById('bookroomchart'), {
        type: 'doughnut',
        data: {
            labels: ['Superior Room', 'Deluxe Room', 'Guest House', 'Single Room'],
            datasets: [{
                backgroundColor: ['#6366f1', '#ec4899', '#10b981', '#0ea5e9'],
                borderWidth: 0,
                data: <?php echo json_encode($roomTypeCounts); ?>,
            }]
        },
        options: {
            plugins: { legend: { position: 'bottom' } }
        }
    });

    const profitChart = new Chart(document.getElementById('profitchart'), {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($profitLabels); ?>,
            datasets: [{
                label: 'Profit ($)',
                backgroundColor: '#0ea5e9',
                borderRadius: 4,
                data: <?php echo json_encode($profitData); ?>,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>

</html>
