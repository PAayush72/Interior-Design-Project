
<?php
  session_start();
  
  if(isset($_POST['btn_submit'])) {
      require_once 'connect.php';
      $name = mysqli_real_escape_string($con, $_POST['name']); 
      $password = mysqli_real_escape_string($con, $_POST['password']);
  
      $query = "SELECT * FROM `admin` WHERE `name` = ? AND `password` = ?"; 
      $stmt = mysqli_prepare($con, $query);
      mysqli_stmt_bind_param($stmt, "ss", $name, $password);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
  
      if(mysqli_num_rows($result) == 1) {
          $row = mysqli_fetch_array($result);
          $_SESSION['id'] = $row['Admin_id'];
          $_SESSION['name'] = $name;
  
          header('location: service_table.php');
          exit;
      } else {
          echo "<script>alert('Login Failed');</script>"; 
          exit;
      }
  }
  ?>
<?php
  require_once "hfm/header.php";
?>
<header role="banner">
      <div class="container logo-wrap">
        <div class="row pt-5">
          <div class="col-12 text-center">
            <img src="images/logo2.jpeg" alt="Image placeholder" class="img-fluid" height="100px" width="100px">
         <h1 class="site-logo"><a href="index.php">Royal Estate Design</a></h1>
          </div>
        </div>
      </div>
            <div class="container">
            <div class="row centered-form" style="padding-top: 5%;">
                <div class="col-md-12 col-lg-8 main-content" style="text-align: center;">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="margin-left: 50%">
                            <h3 class="panel-title">Admin Login</h3>
                        </div>
                        <div class="panel-body" style="margin-left: 50%">
                            <form role="form" action="" method="post">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control input-sm" placeholder="Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control input-sm" placeholder="Password" required>
                                </div>
                                 <input type="submit" name="btn_submit" class="btn btn-info btn-block" value="Login">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       