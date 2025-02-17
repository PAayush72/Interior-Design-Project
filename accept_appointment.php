<?php
require_once 'connect.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $status = 'Acknowledged';
    $query = "UPDATE payment SET acknowledge ='$status' WHERE `Login_id`=$user_id";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<script>alert('Acknowledgement Accepted Successfully');</script>";
        echo "<script>window.location.href = 'users_profile.php';</script>";
        exit();
    } else {
        echo "Error accepting Acknowledgement: " . mysqli_error($con);
    }
}
?>
