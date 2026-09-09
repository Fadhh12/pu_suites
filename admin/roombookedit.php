<?php

require 'auth.php';

// fetch room data
$id = (int) $_GET['id'];

$sql = "SELECT * FROM roombook WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$re = mysqli_stmt_get_result($stmt);
$booking = mysqli_fetch_assoc($re) ?: [];

$Name = $booking['Name'] ?? '';
$Email = $booking['Email'] ?? '';
$Country = $booking['Country'] ?? '';
$Phone = $booking['Phone'] ?? '';
$RoomType = $booking['RoomType'] ?? '';
$Bed = $booking['Bed'] ?? '';
$NoofRoom = $booking['NoofRoom'] ?? '';
$Meal = $booking['Meal'] ?? '';
$cin = $booking['cin'] ?? '';
$cout = $booking['cout'] ?? '';

if (isset($_POST['guestdetailedit'])) {
    $EditName = $_POST['Name'];
    $EditEmail = $_POST['Email'];
    $EditCountry = $_POST['Country'];
    $EditPhone = $_POST['Phone'];
    $EditRoomType = $_POST['RoomType'];
    $EditBed = $_POST['Bed'];
    $EditNoofRoom = $_POST['NoofRoom'];
    $EditMeal = $_POST['Meal'];
    $Editcin = $_POST['cin'];
    $Editcout = $_POST['cout'];

    $sql = "UPDATE roombook SET Name=?,Email=?,Country=?,Phone=?,RoomType=?,Bed=?,NoofRoom=?,Meal=?,cin=?,cout=?,nodays=datediff(?,?) WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssssssssi", $EditName, $EditEmail, $EditCountry, $EditPhone, $EditRoomType, $EditBed, $EditNoofRoom, $EditMeal, $Editcin, $Editcout, $Editcout, $Editcin, $id);
    mysqli_stmt_execute($stmt);

    // Recompute the linked payment row (if this booking has already been
    // confirmed) so the invoice/ledger stays in sync with the edit.
    $roomRates = ['Superior Room' => 3000, 'Deluxe Room' => 2000, 'Guest House' => 1500, 'Single Room' => 1000];
    $bedRates = ['Single' => 1, 'Double' => 2, 'Triple' => 3, 'Quad' => 4, 'None' => 0];
    $mealMultipliers = ['Room only' => 0, 'Breakfast' => 2, 'Half Board' => 3, 'Full Board' => 4];

    $type_of_room = $roomRates[$EditRoomType] ?? 0;
    $type_of_bed = $type_of_room * ($bedRates[$EditBed] ?? 0) / 100;
    $type_of_meal = $type_of_bed * ($mealMultipliers[$EditMeal] ?? 0);

    $psql = "SELECT nodays FROM roombook WHERE id = ?";
    $pstmt = mysqli_prepare($conn, $psql);
    mysqli_stmt_bind_param($pstmt, "i", $id);
    mysqli_stmt_execute($pstmt);
    $presult = mysqli_stmt_get_result($pstmt);
    $prow = mysqli_fetch_assoc($presult);
    $Editnoofday = $prow['nodays'] ?? 0;

    $editttot = $type_of_room * $Editnoofday * $EditNoofRoom;
    $editmepr = $type_of_meal * $Editnoofday;
    $editbtot = $type_of_bed * $Editnoofday;
    $editfintot = $editttot + $editmepr + $editbtot;

    $psql = "UPDATE payment SET Name=?,Email=?,RoomType=?,Bed=?,NoofRoom=?,Meal=?,cin=?,cout=?,noofdays=?,roomtotal=?,bedtotal=?,mealtotal=?,finaltotal=? WHERE id=?";
    $pstmt = mysqli_prepare($conn, $psql);
    mysqli_stmt_bind_param($pstmt, "ssssssssiddddi", $EditName, $EditEmail, $EditRoomType, $EditBed, $EditNoofRoom, $EditMeal, $Editcin, $Editcout, $Editnoofday, $editttot, $editbtot, $editmepr, $editfintot, $id);
    mysqli_stmt_execute($pstmt);

    header("Location: roombook.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- fontowesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/roombook.css">
    <title>PU SUITES - Admin</title>
</head>
<body>
    <div id="guestdetailpanel" style="display: flex;">
        <form method="POST" class="guestdetailpanelform">
            <div class="head">
                <h3>EDIT RESERVATION</h3>
                <a href="./roombook.php"><i class="fa-solid fa-circle-xmark"></i></a>
            </div>
            <div class="middle">
                <div class="guestinfo">
                    <h4>Guest information</h4>
                    <input type="text" name="Name" placeholder="Enter Full name" value="<?php echo htmlspecialchars($Name) ?>" required>
                    <input type="email" name="Email" placeholder="Enter Email" value="<?php echo htmlspecialchars($Email) ?>" required>

                    <?php
                    $countries = array("Indonesia", "Malaysia", "Singapore", "Australia", "United States", "United Kingdom", "Japan", "South Korea", "China", "India", "Germany", "France", "Others");
                    ?>
                    <select name="Country" class="selectinput" required>
                        <option value="" disabled>Select your country</option>
                        <?php foreach($countries as $value): ?>
                            <option value="<?php echo $value ?>" <?php echo $value === $Country ? 'selected' : ''; ?>><?php echo $value ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="text" name="Phone" placeholder="Enter Phoneno" value="<?php echo htmlspecialchars($Phone) ?>" required>
                </div>

                <div class="line"></div>

                <div class="reservationinfo">
                    <h4>Reservation information</h4>
                    <select name="RoomType" class="selectinput" required>
                        <option value="" disabled>Type Of Room</option>
                        <?php foreach (['Superior Room', 'Deluxe Room', 'Guest House', 'Single Room'] as $type): ?>
                            <option value="<?php echo $type ?>" <?php echo $type === $RoomType ? 'selected' : ''; ?>><?php echo strtoupper($type) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="Bed" class="selectinput" required>
                        <option value="" disabled>Bedding Type</option>
                        <?php foreach (['Single', 'Double', 'Triple', 'Quad', 'None'] as $bed): ?>
                            <option value="<?php echo $bed ?>" <?php echo $bed === $Bed ? 'selected' : ''; ?>><?php echo $bed ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="NoofRoom" class="selectinput" required>
                        <option value="" disabled>No of Room</option>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <option value="<?php echo $i ?>" <?php echo (string) $i === (string) $NoofRoom ? 'selected' : ''; ?>><?php echo $i ?></option>
                        <?php endfor; ?>
                    </select>
                    <select name="Meal" class="selectinput" required>
                        <option value="" disabled>Meal</option>
                        <?php foreach (['Room only', 'Breakfast', 'Half Board', 'Full Board'] as $meal): ?>
                            <option value="<?php echo $meal ?>" <?php echo $meal === $Meal ? 'selected' : ''; ?>><?php echo $meal ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="datesection">
                        <span>
                            <label for="cin">Check-In</label>
                            <input name="cin" type="date" value="<?php echo htmlspecialchars($cin) ?>" required>
                        </span>
                        <span>
                            <label for="cout">Check-Out</label>
                            <input name="cout" type="date" value="<?php echo htmlspecialchars($cout) ?>" required>
                        </span>
                    </div>
                </div>
            </div>
            <div class="footer">
                <button class="btn-success" name="guestdetailedit">Save Changes</button>
            </div>
        </form>
    </div>
</body>
</html>
