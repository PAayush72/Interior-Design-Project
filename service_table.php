<?php
require_once 'hfm/header.php';
require_once 'hfm/manu1.php';
require_once 'connect.php'; 

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM servicee";

$result = mysqli_query($con, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}
?>

<br><br><br><br><br><br>
<html>
<head></head>
<body>
    <h1 style="text-align: center; font-size: 50px; font-family: Monotype Corsiva; text-decoration: underline;">Service Requests</h1>
    
    <table class="table table-hover" border="1px" align="center">
        <thead class="table-dark">
            <th>Design</th>
            <th>Query</th>
            <th>User Id</th>
            <th>Actions</th>
        </thead>

        <?php
       
        while ($row = mysqli_fetch_assoc($result)) {
        ?>

            <tr>
                <td><?php echo $row['Design'] ?></td>
                <td><?php echo $row['Query'] ?></td>
                <td><?php echo $row['Login_id'] ?></td>
                <td><a href="service_delete.php?id=<?php echo $row['Service_id']?>"><img src="images/delete.png"></a></td>
            </tr>

        <?php } ?>

    </table>

</body>
</html>

<?php
require_once "hfm/footer1.php";
?>
