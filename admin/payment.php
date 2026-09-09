<?php
    require 'auth.php';

    $paymanttablesql = "SELECT * FROM payment ORDER BY id DESC";
    $paymantresult = mysqli_query($conn, $paymanttablesql);
    $payments = mysqli_fetch_all($paymantresult, MYSQLI_ASSOC);
    $totalRevenue = array_sum(array_column($payments, 'finaltotal'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PU SUITES - Admin</title>
    <!-- fontowesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
	<!-- css for table and search bar -->
	<link rel="stylesheet" href="css/roombook.css">
</head>
<body class="has-summary">
	<div class="roomsummary">
		<div class="stat"><strong><?php echo count($payments); ?></strong> Confirmed Bookings</div>
		<div class="stat"><strong>$<?php echo number_format($totalRevenue, 2); ?></strong> Total Revenue</div>
	</div>

	<div class="searchsection">
        <input type="text" name="search_bar" id="search_bar" placeholder="search..." onkeyup="searchFun()">
    </div>

    <div class="roombooktable">
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Room Type</th>
                    <th scope="col">Bed Type</th>
                    <th scope="col">Check In</th>
                    <th scope="col">Check Out</th>
					<th scope="col">No of Day</th>
                    <th scope="col">No of Room</th>
					<th scope="col">Meal Type</th>
                    <th scope="col">Room Rent</th>
                    <th scope="col">Bed Rent</th>
                    <th scope="col">Meals</th>
					<th scope="col">Total Bill</th>
                    <th scope="col" class="action">Action</th>
                </tr>
            </thead>

            <tbody>
            <?php if (empty($payments)): ?>
                <tr>
                    <td colspan="14" style="text-align: center; padding: 40px; color: var(--text-muted);">
                        No confirmed payments yet.
                    </td>
                </tr>
            <?php endif; ?>
            <?php foreach ($payments as $res): ?>
                <tr>
                    <td><?php echo htmlspecialchars($res['id']) ?></td>
                    <td><?php echo htmlspecialchars($res['Name']) ?></td>
                    <td><?php echo htmlspecialchars($res['RoomType']) ?></td>
                    <td><?php echo htmlspecialchars($res['Bed']) ?></td>
					<td><?php echo htmlspecialchars($res['cin']) ?></td>
                    <td><?php echo htmlspecialchars($res['cout']) ?></td>
					<td><?php echo htmlspecialchars($res['noofdays']) ?></td>
                    <td><?php echo htmlspecialchars($res['NoofRoom']) ?></td>
                    <td><?php echo htmlspecialchars($res['meal']) ?></td>
                    <td>$<?php echo number_format($res['roomtotal'], 2) ?></td>
					<td>$<?php echo number_format($res['bedtotal'], 2) ?></td>
					<td>$<?php echo number_format($res['mealtotal'], 2) ?></td>
					<td><strong>$<?php echo number_format($res['finaltotal'], 2) ?></strong></td>
                    <td class="action">
                        <a href="invoiceprint.php?id=<?php echo urlencode($res['id']) ?>" target="_blank"><button class="btn btn-primary"><i class="fa-solid fa-print"></i> Print</button></a>
						<a href="paymantdelete.php?id=<?php echo urlencode($res['id']) ?>" onclick="return confirm('Delete this payment record?')"><button class="btn btn-danger">Delete</button></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

<script>
    //search bar logic using js
    const searchFun = () =>{
        let filter = document.getElementById('search_bar').value.toUpperCase();

        let myTable = document.getElementById("table-data");

        let tr = myTable.getElementsByTagName('tr');

        for(var i = 0; i< tr.length;i++){
            let td = tr[i].getElementsByTagName('td')[1];

            if(td){
                let textvalue = td.textContent || td.innerHTML;

                if(textvalue.toUpperCase().indexOf(filter) > -1){
                    tr[i].style.display = "";
                }else{
                    tr[i].style.display = "none";
                }
            }
        }

    }

</script>

</html>
