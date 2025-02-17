<?php
require_once 'hfm/header.php';
require_once 'hfm/manu1.php';
require_once "connect.php";

$query = "SELECT payment.*, login.name FROM payment JOIN login ON payment.Login_id = login.Login_id";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}
?>

<br><br><br><br><br><br>
<html>
<head></head>
<body>
<h1 style="text-align: center;font-size: 50px;font-family: Monotype Corsiva;text-decoration: underline;">Payment Data</h1>
<table class="table table-hover" border="1px" align="center">
<thead class="table-dark">
        <th>Payment No</th>
        <th>Payment Date</th>
        <th>Amount</th>
        <th>User ID</th>
        <th>User Name</th>
        <th>User Verification</th>
        <th colspan="2">Actions</th>
</thead>

    <?php
    $k = 1;
    while ($row = mysqli_fetch_array($result)) {
        ?>

        <tr>
            <td><?php echo $k++ ?></td>
            <td><?php echo $row['Payment_date'] ?></td>
            <td><?php echo $row['Amount'] ?></td>
            <td><?php echo $row['Login_id'] ?></td>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['acknowledge'] ?></td>
            <td><a href="payment_update.php?id=<?php echo $row['Payment_no']?>"><img src="images/update.png"></a></td>
            <td><a href="payment_delete.php?id=<?php echo $row['Payment_no'];?>"><img src="images/delete.png"></a></td>
        </tr>

    <?php } ?>

</table>
<br>
<p style="text-align: center;">
    <a href="payment_add.php"><h5 align="center"><u>Add New Payment</u></h5></a>
</p>
</body>
</html>
<?php
require_once "hfm/footer1.php";
?>
