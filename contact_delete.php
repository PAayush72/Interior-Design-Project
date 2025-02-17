<?php
require_once 'connect.php';

$id = $_GET['id'];
$delete_query = "DELETE FROM contact WHERE Contact_id=" . $id;

$res = mysqli_query($con, $delete_query);

if (!$res) {
    echo mysqli_error($con);
    exit;
}

mysqli_close($con);

header('location:contact_table.php');
exit;
?>
