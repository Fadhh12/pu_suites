<?php
require 'auth.php';

if (isset($_POST['addroom'])) {
    $typeofroom = $_POST['troom'];
    $typeofbed = $_POST['bed'];

    $sql = "INSERT INTO room(type, bedding) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $typeofroom, $typeofbed);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        header("Location: room.php");
        exit();
    }
}

// Room icon + accent per type, reused for both the summary strip and cards.
$roomMeta = [
    'Superior Room' => ['class' => 'roomboxsuperior', 'icon' => 'fa-crown'],
    'Deluxe Room'   => ['class' => 'roomboxdelux',    'icon' => 'fa-star'],
    'Guest House'   => ['class' => 'roomboguest',     'icon' => 'fa-house'],
    'Single Room'   => ['class' => 'roomboxsingle',   'icon' => 'fa-bed'],
];

$rooms = [];
$counts = ['Superior Room' => 0, 'Deluxe Room' => 0, 'Guest House' => 0, 'Single Room' => 0];
$re = mysqli_query($conn, "SELECT * FROM room ORDER BY type, id");
while ($row = mysqli_fetch_assoc($re)) {
    $rooms[] = $row;
    if (isset($counts[$row['type']])) {
        $counts[$row['type']]++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PU SUITES - Admin</title>
    <!-- fontowesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/room.css">
</head>

<body>
    <div class="addroomsection">
        <form action="" method="POST">
            <label for="troom">Type of Room</label>
            <select name="troom" id="troom" required>
                <option value="" selected disabled>Choose room type</option>
                <option value="Superior Room">Superior Room</option>
                <option value="Deluxe Room">Deluxe Room</option>
                <option value="Guest House">Guest House</option>
                <option value="Single Room">Single Room</option>
            </select>

            <label for="bed">Bedding</label>
            <select name="bed" id="bed" required>
                <option value="" selected disabled>Choose bedding</option>
                <option value="Single">Single</option>
                <option value="Double">Double</option>
                <option value="Triple">Triple</option>
                <option value="Quad">Quad</option>
                <option value="None">None</option>
            </select>

            <button type="submit" name="addroom"><i class="fa-solid fa-plus"></i> Add Room</button>
        </form>
    </div>

    <div class="roomsummary">
        <?php foreach ($counts as $type => $count): ?>
            <div class="stat"><strong><?php echo $count; ?></strong> <?php echo htmlspecialchars($type); ?></div>
        <?php endforeach; ?>
        <div class="stat"><strong><?php echo count($rooms); ?></strong> Total Rooms</div>
    </div>

    <div class="room">
        <?php if (empty($rooms)): ?>
            <div class="empty-state">
                <i class="fa-solid fa-bed"></i>
                <p>No rooms yet. Add your first room above.</p>
            </div>
        <?php else: ?>
            <?php foreach ($rooms as $row):
                $meta = $roomMeta[$row['type']] ?? ['class' => 'roomboxsingle', 'icon' => 'fa-bed'];
            ?>
                <div class="roombox <?php echo $meta['class']; ?>">
                    <div class="room-icon"><i class="fa-solid <?php echo $meta['icon']; ?>"></i></div>
                    <h3><?php echo htmlspecialchars($row['type']); ?></h3>
                    <span class="room-id">Room #<?php echo htmlspecialchars($row['id']); ?></span>
                    <span class="bedding-badge"><?php echo htmlspecialchars($row['bedding']); ?> bed</span>
                    <button class="btn-danger" onclick="if(confirm('Delete this room?')) window.location.href='roomdelete.php?id=<?php echo urlencode($row['id']); ?>'">
                        <i class="fa-solid fa-trash"></i> Delete
                    </button>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</body>

</html>
