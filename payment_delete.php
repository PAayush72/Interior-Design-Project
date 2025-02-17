<?php
require_once 'connect.php';

$id = $_GET['id'];
$delete_query = "DELETE FROM payment WHERE Payment_no=" . $id;

if(mysqli_query($con, $delete_query)) {
    mysqli_close($con);
    header('location:payment_table.php');
    exit;
} else {
    echo "Error deleting record: " . mysqli_error($con);
    exit;
}
?>
