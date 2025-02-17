
<?php
    $pwd_error="";
    
    if(isset($_POST['btn_submit']))
    {
        $is_validate=true;
        $password=$_POST['password'];
        $confirm_password=$_POST['confirm_password'];

        if($password!=$confirm_password)
        {
            $pwd_error = 'confirm password does not match';
            $is_validate = false;
        }
        if($is_validate)
        {
            require_once 'connect.php';
            $name=$_POST['name'];
            $email=$_POST['email'];
            $password=$_POST['password']; 
            $phone_no=$_POST['phone_no'];

            $insert_query = $con->prepare("INSERT INTO `login` (Name, Email, Password, Phone_no) VALUES (?, ?, ?, ?)");
            $insert_query->bind_param("ssss", $name, $email, $password, $phone_no);

            if($insert_query->execute())
            {
                header('location:index.php');
                exit;
            }
            else
            {
                echo "Error: " . $insert_query->error;
            }

            $con->close();
        }
    }

?>
<?php
  require_once "hfm/header.php";
  require_once "hfm/manu.php";
?>
        <style>
            .error{
                color: red;
            }
        </style>
        <br><br>
        <div class="container">
            <div class="row centered-form" style="padding-top: 15%;">
                <div class="col-md-12 col-lg-8 main-content" style="text-align: center;">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="margin-left: 50%">
                            <h3 class="panel-title">Registration</h3>
                        </div>
                        <div class="panel-body" style="margin-left: 50%">
                            <form role="form" method="post" action="" >
                                    <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Name" required>
                                </div>
			                    <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" required>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="password" name="confirm_password" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password" required><span class="error"><?php echo $pwd_error ?></span>
                                        </div>
                                    </div>
                                </div>
								<div class="form-group">
                                <input type="text" name="phone_no" id="phone_no" class="form-control input-sm" placeholder="Phone_no" maxlength="10" required>
                                </div>
                                <input type="submit" name="btn_submit" class="btn btn-info btn-block" value="Register">
                            </form>
                            <br>
                            <h4>Already a User?</h4><a href="login.php"><h6>Login</h6></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<br><br>
        <!--registration end-->
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
