<?php

require 'auth.php';

$id = (int) $_GET['id'];

$deletesql = "DELETE FROM roombook WHERE id = ?";
$stmt = mysqli_prepare($conn, $deletesql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

header("Location:roombook.php");

?>
