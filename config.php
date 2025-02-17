<?php
    $con = mysqli_connect('localhost', 'root','','intdesign');
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>