<?php
$date_error = "";
session_start();
require_once "check_login.php";
if(isset($_POST['btn_submit'])){
    require_once 'connect.php';

    $date = $_POST['date'];
    $service_name = $_POST['service_name'];
    $address = $_POST['address'];

    $insert_query = "INSERT INTO `appointment` (date, service_name, address, user_id) VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($con, $insert_query);

    if($stmt === false) {
        echo "Error: " . mysqli_error($con);
    } else {
        mysqli_stmt_bind_param($stmt, "sssi", $date, $service_name, $address, $_SESSION['id']);

        
        if(mysqli_stmt_execute($stmt)){
            header('location:index.php');
            exit;
        } else {
            echo "Error: " . mysqli_error($con);
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($con);
}
?>
<?php
require_once "hfm/header.php";
require_once "hfm/manu.php";
?>
<br><br>
<div class="container">
    <div class="row centered-form" style="padding-top: 10%;">
        <div class="col-md-12 col-lg-8 main-content" style="text-align: center;">
            <div class="panel panel-primary">
                <div class="panel-heading" style="margin-left: 50%">
                    <h3 class="panel-title">Meet Our Expert</h3>
                </div>
                <div class="panel-body" style="margin-left: 50%">
                    <form role="form" method="POST" >
                        Payment_date: <input type="datetime-local" name="date" value="<?php echo !empty($_POST['date'])? $_POST['date']:""; ?>" ><span class="error">* <?php echo $date_error ?></span>
                        <br />
                        <br />
                        <div class="form-group">
                            Chose Service:
                            <select  name="service_name">
                                <option value="Interior">Interior</option>
                                <option value="Architecture">Architecture</option>
                                <option value="Installation art">Installation art</option>
                            </select>
                            <div class="form-group">
                            <br /><input type="text" name="address" id="address" class="form-control input-sm" placeholder="Add Address" required>
                                </div>
                        </div>
                        <input type="submit" name="btn_submit" class="btn btn-info btn-block" value="Book Appointment">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<?php
require_once "hfm/footer.php";
?>

<a href="bot.php" class="chatbox-icon" title="Chat with us">
  <img src="images/chat.png" alt="Chat Icon" style="width: 50px; height: 50px;">
</a>

<style>
.chatbox-icon {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 1000;
}

.chatbox-icon img {
  width: 50px;
  height: 50px;
}
</style>
