<?php
require_once 'connect.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $status = 'Declined';
    $query = "UPDATE appointment SET status='$status' WHERE `user_id`=$user_id";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<script>alert('Appointment Declined Successfully');</script>";
        echo "<script>setTimeout(function(){ window.location.href = 'appointment_table.php'; }, 1000);</script>";
        exit();
    } else {
        echo "Error declining appointment: " . mysqli_error($con);
    }
}
?>
