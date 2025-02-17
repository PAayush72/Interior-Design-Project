<?php
require_once 'connect.php';

$id = $_GET['id'];
$delete_query = "DELETE FROM bookings WHERE id=" . $id;

if(mysqli_query($con, $delete_query)) {
    mysqli_close($con);
    header('location:admin_booking.php');
    exit;
} else {
    echo "Error deleting record: " . mysqli_error($con);
    exit;
}
?>
