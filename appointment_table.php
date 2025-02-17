
<?php
require_once 'hfm/header.php';
require_once 'hfm/manu1.php';
require_once "connect.php";

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM appointment";
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
        <th>Appointment Id</th>
        <th>Requested Date</th>
        <th>Service Name</th>
        <th>Address</th>
        <th>User Id</th>
        <th>Applied Date</th>
        <th colspan="2">Actions</th>
    </thead>

    <?php
    $k = 1;
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <tr>
            <td><?php echo $k++ ?></td>
            <td><?php echo $row['date'] ?></td>
            <td><?php echo $row['service_name'] ?></td>
            <td><?php echo $row['address'] ?></td>
            <td><?php echo $row['user_id'] ?></td>
            <td><?php echo $row['created_at'] ?></td>
            <td><a href="accept_appointment.php?id=<?php echo $row['user_id']; ?>"><u>Accept</u></a></td>
            <td><a href="decline_appointment.php?id=<?php echo $row['user_id'] ?>"><u>Decline</u></a></td>
        </tr>
    <?php 
    } 
    ?>
</table>

</body>
</html>

<?php
require_once "hfm/footer1.php";
?>
