
<?php
require_once 'hfm/header.php';
require_once 'hfm/manu1.php';
require_once "connect.php";

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM login";
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
<h1 style="text-align: center;font-size: 50px;font-family: Monotype Corsiva;text-decoration: underline;">User Information</h1>

<table class="table table-hover" border="1px" align="center">
    <thead class="table-dark">
        <th>User Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Mobile</th>
        <th>Actions</th>
    </thead>

    <?php
    $k = 1;
    while ($row = mysqli_fetch_array($result)) {
        ?>

        <tr>
            <td><?php echo $row['Login_id'] ?></td>
            <td><?php echo $row['Name'] ?></td>
            <td><?php echo $row['Email'] ?></td>
            <td><?php echo $row['Password'] ?></td>
            <td><?php echo $row['Phone_no'] ?></td>
            <td><a href="login_delete.php?id=<?php echo $row['Login_id']; ?>"><img src="images/delete.png"></a></td>
        </tr>

    <?php } ?>

</table>

</body>
</html>

<?php
require_once "hfm/footer1.php";
?>
