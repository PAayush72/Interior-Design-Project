<?php
   
    if(isset($_POST['btn_submit'])){
        require_once 'connect.php';

        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone_no = $_POST['phone_no'];
        $message = $_POST['message'];
        
        $insert_query = "INSERT INTO contact (Name, Email, Phone_no, Message) VALUES ('$name', '$email', '$phone_no', '$message')";

        if(mysqli_query($con, $insert_query)){
            mysqli_close($con);
            header('Location: index.php');
            exit;
        } else{
            echo "Error: " . mysqli_error($con);
        }
    }

?>
<?php
  require_once "hfm/header.php";
  require_once "hfm/manu.php";
?>
<br><br>
        <div class="container">
            <div class="row centered-form" style="padding-top: 15%;">
                <div class="col-md-12 col-lg-8 main-content" style="text-align: center;">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="margin-left: 50%">
                            <h3 class="panel-title">Contact Us</h3>
                        </div>
                        <div class="panel-body" style="margin-left: 50%">
                            <form role="form" method="post" action="" >
                                    <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" required>
                                </div>
								<div class="form-group">
                                    <input type="text" name="phone_no" id="phone_no" class="form-control input-sm" placeholder="Phone_no" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="message" id="message" class="form-control input-sm" placeholder="Write Messege" required>
                                </div>
                                <input type="submit" name="btn_submit" class="btn btn-info btn-block" value="Contact Us">
                            </form>
                        </div>
                        <div class="panel-heading" style="margin-left: 50%">
                            <h5 class="panel-title">Our Team Will Contact You Within 24hrs To Solve Your Queries.</h5>
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
