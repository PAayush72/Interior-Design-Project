<?php
session_start();
require_once "check_login.php";
if(isset($_POST['btn_submit'])){
    require_once 'connect.php';

    $design = $_POST['design'];
    $query = $_POST['query'];

    $insert_query = "INSERT INTO `servicee` (Design, Query, Login_id) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($con, $insert_query);

    mysqli_stmt_bind_param($stmt, "sss", $design, $query, $_SESSION['id']);

    if(mysqli_stmt_execute($stmt)){
        header('location:index.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);

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
                    <h3 class="panel-title">Service Request</h3>
                </div>
                <div class="panel-body" style="margin-left: 50%">
                    <form role="form" method="POST" >
                        <div class="form-group">
                            <select  name="design">
                                <option value="Interior">Interior</option>
                                <option value="Architecture">Architecture</option>
                                <option value="Installation art">Installation art</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="query" id="query" class="form-control input-sm" placeholder="Query" required>
                        </div>
                        <input type="submit" name="btn_submit" class="btn btn-info btn-block" value="Submit">
                    </form>
                    <h5>Get A Estimated Service</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<?php
require_once "hfm/footer.php";
?>
