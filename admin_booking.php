<?php
require_once 'hfm/header.php';
require_once 'hfm/manu1.php';
require_once "connect.php";

$query = "SELECT * FROM bookings";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}
?>
<br><br><br><br><br><br>
<html>
<head>
</head>
<body>
<h1 style="text-align: center;font-size: 50px;font-family: Monotype Corsiva;text-decoration: underline;">Appointment Information</h1>

<table class="table table-hover" border="1px" align="center">
    <thead class="table-dark">
       
        <th>Name</th>
        <th>Email</th>
        <th>Phone No</th>
        <th>Date</th>
        <th>Time</th>
        <th>Message</th>
        <th>Address</th>
        <th>Action</th>
    </thead>

    <?php
    
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <tr>
           
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['phone'] ?></td>
            <td><?php echo $row['date'] ?></td>
            <td><?php echo $row['time'] ?></td>
            <td><?php echo $row['message'] ?></td>
            <td><?php echo $row['address'] ?></td>
            <td><a href="booking_delete.php?id=<?php echo $row['id'];?>"><img src="images/delete.png"></a></td>

        </tr>
    <?php 
    } 
    ?>
</table>

</body>
</html>
<p style="text-align: center;">
    <a href="admin_slot.php"><h5 align="center"><u>Add New Slot</u></h5></a>
</p>
<?php
require_once "hfm/footer1.php";
?>