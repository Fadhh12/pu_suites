<?php

require 'auth.php';

$id = (int) $_GET['id'];

$sql = "SELECT * FROM roombook WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$re = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($re);

if ($row && $row['stat'] === 'NotConfirm') {
    $Name = $row['Name'];
    $Email = $row['Email'];
    $RoomType = $row['RoomType'];
    $Bed = $row['Bed'];
    $NoofRoom = $row['NoofRoom'];
    $Meal = $row['Meal'];
    $cin = $row['cin'];
    $cout = $row['cout'];
    $noofday = $row['nodays'];

    $st = "Confirm";
    $sql = "UPDATE roombook SET stat = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $st, $id);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        $roomRates = ROOM_RATES; // shared with the public site -- see config.php
        $bedRates = ['Single' => 1, 'Double' => 2, 'Triple' => 3, 'Quad' => 4, 'None' => 0];
        $mealMultipliers = ['Room only' => 0, 'Breakfast' => 2, 'Half Board' => 3, 'Full Board' => 4];

        $type_of_room = $roomRates[$RoomType] ?? 0;
        $type_of_bed = $type_of_room * ($bedRates[$Bed] ?? 0) / 100;
        $type_of_meal = $type_of_bed * ($mealMultipliers[$Meal] ?? 0);

        $ttot = $type_of_room * $noofday * $NoofRoom;
        $mepr = $type_of_meal * $noofday;
        $btot = $type_of_bed * $noofday;
        $fintot = $ttot + $mepr + $btot;

        $psql = "INSERT INTO payment(id,Name,Email,RoomType,Bed,NoofRoom,cin,cout,noofdays,roomtotal,bedtotal,meal,mealtotal,finaltotal) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $pstmt = mysqli_prepare($conn, $psql);
        mysqli_stmt_bind_param($pstmt, "isssssssiddsdd", $id, $Name, $Email, $RoomType, $Bed, $NoofRoom, $cin, $cout, $noofday, $ttot, $btot, $Meal, $mepr, $fintot);
        mysqli_stmt_execute($pstmt);
    }
}

header("Location:roombook.php");

?>
