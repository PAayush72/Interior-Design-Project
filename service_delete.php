
<?php
require_once 'connect.php';

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    
    $delete_query = "DELETE FROM servicee WHERE Service_id = $id";
    
    $res = mysqli_query($con, $delete_query);
    
    if(!$res) {
        echo "Error: " . mysqli_error($con);
        exit;
    }

    mysqli_close($con);

    header('location: service_table.php');
    exit;
} else {
    echo "Invalid request!";
    exit;
}
?>
