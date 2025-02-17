<?php
  session_start();
  
  if(isset($_POST['btn_submit'])) {
      require_once 'connect.php';
  
      $email = mysqli_real_escape_string($con, $_POST['email']);
      $password = mysqli_real_escape_string($con, $_POST['password']);
  
      $query = "SELECT * FROM login WHERE Email = ? AND Password = ?";
      $stmt = mysqli_prepare($con, $query);
      mysqli_stmt_bind_param($stmt, "ss", $email, $password);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
  
      if(mysqli_num_rows($result) == 1) {
          $row = mysqli_fetch_array($result);
          $_SESSION['id'] = $row['Login_id'];
          $_SESSION['email'] = $email;
  
          if ($_SESSION['email'] === "admin@gmail.com") 
            {
              header('location: login_table.php');
              exit;
            } 
            else
            {
              header('location: index.php');
              exit;
            }
      } else {
          echo "<script>alert('Login Failed');</script>"; 
          exit;
      }
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
                            <h3 class="panel-title">Login</h3>
                        </div>
                        <div class="panel-body" style="margin-left: 50%">
                            <form role="form" action="" method="post">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control input-sm" placeholder="Email Address" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control input-sm" placeholder="Password" required>
                                </div>
                                 <input type="submit" name="btn_submit" class="btn btn-info btn-block" value="Login"><br>
                                 <a href="forgot.php"><h5><u>Forgot password</u></h5></a>
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