<?php
require_once 'hfm/header.php';
require_once 'hfm/manu1.php';
require_once "connect.php";

$result = mysqli_query($con, "SELECT * FROM contact");

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}
?>
<br><br><br><br><br><br>
<html>
<head></head>
<body>
<h1 style="text-align: center;font-size: 50px;font-family: Monotype Corsiva;text-decoration: underline;">Customer Contact Requests</h1>
<table class="table table-hover" border="1px" align="center">
    <thead class="table-dark">
        <th>Name</th>
        <th>Email</th>
        <th>Phone no</th>
        <th>Message</th>
        <th>Actions</th>
    </thead>


    <?php
   
    while($row = mysqli_fetch_array($result))
    {
    ?>

    <tr>
       
        <td><?php echo $row['Name'] ?></td>
        <td><?php echo $row['Email'] ?></td>
        <td><?php echo $row['Phone_no'] ?></td>
        <td><?php echo $row['Message'] ?></td>
        <td><a href="contact_delete.php?id=<?php echo $row['Contact_id']?>"><img src="images/delete.png"></a></td>
    </tr>

    <?php } ?>

</table>

</body>
</html>
<?php
require_once "hfm/footer1.php";
?>
