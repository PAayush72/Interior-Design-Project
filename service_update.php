<?php
session_start();
require_once "check_login.php";
require_once "connect.php";

if (isset($_POST['btn_submit_update'])) {
    $design = $_POST['design'];
    $query = $_POST['query'];

    $update_query = "UPDATE servicee SET Design=?, Query=? WHERE Login_id=?";

    $stmt = mysqli_prepare($con, $update_query);

    mysqli_stmt_bind_param($stmt, "sss", $design, $query, $_SESSION['id']);

    if(mysqli_stmt_execute($stmt)){
        header('location:index.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
}

$select_query = "SELECT * FROM servicee WHERE Login_id=?";
$stmt = mysqli_prepare($con, $select_query);
mysqli_stmt_bind_param($stmt, "s", $_SESSION['id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_assoc($result);

require_once "hfm/header.php";
require_once "hfm/manu.php";
?>
<br><br>
<div class="container">
    <div class="row centered-form" style="padding-top: 10%;">
        <div class="col-md-12 col-lg-8 main-content" style="text-align: center;">
            <div class="panel panel-primary">
                <div class="panel-heading" style="margin-left: 50%">
                    <h3 class="panel-title">Update Service Request</h3>
                </div>
                <div class="panel-body" style="margin-left: 50%">
                    <form role="form" method="POST">
                        <div class="form-group">
                            <label for="design">Design:</label>
                            <select name="design" class="form-control">
                                <option value="Interior" <?php if ($row['Design'] === 'Interior') echo 'selected'; ?>>Interior</option>
                                <option value="Architecture" <?php if ($row['Design'] === 'Architecture') echo 'selected'; ?>>Architecture</option>
                                <option value="Installation art" <?php if ($row['Design'] === 'Installation art') echo 'selected'; ?>>Installation art</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="query">Query:</label>
                            <input type="text" name="query" id="query" class="form-control input-sm" placeholder="Query" value="<?php echo $row['Query']; ?>" required>
                        </div>
                        <input type="submit" name="btn_submit_update" class="btn btn-info btn-block" value="Update">
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
