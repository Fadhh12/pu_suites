<?php
require 'auth.php';

if (isset($_POST['addstaff'])) {
    $name = trim($_POST['Name']);
    $work = $_POST['Work'];

    if ($name !== '' && $work !== '') {
        $sql = "INSERT INTO staff(name, work) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $name, $work);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    swal({ title: 'Staff added', icon: 'success' }).then(function() {
                        window.location = 'staff.php';
                    });
                });
            </script>";
        }
    } else {
        echo "<script>swal({ title: 'Please fill in both fields', icon: 'warning' });</script>";
    }
}

$sql = "SELECT staff.id, staff.name, staff.work, emp_login.Emp_Email
        FROM staff
        LEFT JOIN emp_login ON emp_login.staff_id = staff.id
        ORDER BY staff.id DESC";
$result = mysqli_query($conn, $sql);
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
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="./css/roombook.css">
    <style>
        /* Staff's add form is one column (just name + role), unlike the
           two-column guest reservation panel this shell was built for. */
        #guestdetailpanel .guestdetailpanelform { max-width: 420px; }
        #guestdetailpanel .middle { flex-direction: column; }
        .role-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            background-color: #eef2ff;
            color: #4338ca;
        }
        .no-login {
            color: var(--text-muted);
            font-style: italic;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <!-- add staff panel -->
    <div id="guestdetailpanel">
        <form action="" method="POST" class="guestdetailpanelform">
            <div class="head">
                <h3>ADD STAFF</h3>
                <i class="fa-solid fa-circle-xmark" onclick="adduserclose()"></i>
            </div>
            <div class="middle">
                <div class="guestinfo" style="width: 100%;">
                    <h4>Staff Details</h4>
                    <input type="text" name="Name" placeholder="Full name" required>
                    <select name="Work" class="selectinput" required>
                        <option value="" selected disabled>Select role</option>
                        <option value="Manager">Manager</option>
                        <option value="Receptionist">Receptionist</option>
                        <option value="Housekeeping">Housekeeping</option>
                        <option value="Maintenance">Maintenance</option>
                        <option value="Security">Security</option>
                    </select>
                </div>
            </div>
            <div class="footer">
                <button class="btn-success" name="addstaff">Add Staff</button>
            </div>
        </form>
    </div>

    <div class="searchsection">
        <input type="text" name="search_bar" id="search_bar" placeholder="search staff..." onkeyup="searchFun()">
        <button id="adduser" onclick="adduseropen()"><i class="fa-solid fa-user-plus"></i> Add Staff</button>
    </div>

    <div class="roombooktable">
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Login Email</th>
                    <th scope="col" class="action">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><span class="role-badge"><?php echo htmlspecialchars($row['work']); ?></span></td>
                        <td>
                            <?php if ($row['Emp_Email']): ?>
                                <?php echo htmlspecialchars($row['Emp_Email']); ?>
                            <?php else: ?>
                                <span class="no-login">No login account</span>
                            <?php endif; ?>
                        </td>
                        <td class="action">
                            <a href="staffdelete.php?id=<?php echo urlencode($row['id']); ?>" onclick="return confirm('Delete this staff member?')"><button class="btn btn-danger">Delete</button></a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
<script src="./javascript/roombook.js"></script>

</html>
