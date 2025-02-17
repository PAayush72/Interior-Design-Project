<?php
  session_start();
  require_once("connect.php");
  if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
    $res = mysqli_query($con, "SELECT * FROM login WHERE Email='$email'");
    $userData = mysqli_fetch_array($res);
  }
?>

<header role="banner">
      <div class="container logo-wrap">
        <div class="row pt-5">
          <div class="col-12 text-center">
            <a class="absolute-toggle" ><span class="burger-lines"></span></a>
            <img src="images/logo2.jpeg" alt="Image placeholder" class="img-fluid" height="100px" width="100px">
         <h1 class="site-logo"><a href="index.php">Royal Estate Design</a></h1>
          </div>
        </div>
      </div>
      <nav class="navbar aayush navbar-expand-md navbar-light bg-light">
        <div class="container">
          <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav mx-auto">
              <li class="nav-item">
                <a class="nav-link " href="index.php">|Home|</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="interior.php">|Our Projects|</a>
              </li>
        <li class="nav-item">
                <a class="nav-link" href="servicerequest.php">|Service Request|</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="aboutus.php">|About Us|</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contactus.php">|Request Call-Back|</a>
              </li>
              
              <?php
                if(!isset($_SESSION['email']))
                {
                ?>
                  <li class="nav-item">
                    <a class="nav-link" href="registration.php">|Login|</a>
                  </li>
              <?php
                }
                else
                {
                ?>
                  <li class="nav-item">
                    <a class="nav-link" href="users_profile.php">|WELCOME <?php echo $userData['Name']; ?>|</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="logout.php">|Logout|</a>
                  </li>
              <?php
                }
              ?>
            </ul>
            <button id="book-appointment-btn" type="button" class="btn btn-lg btn-danger" data-bs-toggle="popover" title="Popover title">Book Appointment</button>
          </div>
        </div>
      </nav>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var bookAppointmentBtn = document.getElementById("book-appointment-btn");

    bookAppointmentBtn.addEventListener("click", function() {
        window.location.href = "booking.php";
    });
});
</script>
</header><br><br><br>