<?php
if(empty($_POST["btn_submit"]))
{
    require_once "connect.php";
    $id = $_GET['id'];
    $result = mysqli_query($con, "SELECT * FROM payment WHERE Payment_no=" . $id);
    $row = mysqli_fetch_array($result);
} 
else
{
    require_once "connect.php";
    $id = $_POST['id'];
    $payment_date = $_POST['payment_date'];
    $amount = $_POST['amount'];
    $login_id = $_POST['login_id'];

    $result = mysqli_query($con, "UPDATE payment SET Payment_date='$payment_date', Amount='$amount', Login_id='$login_id' WHERE Payment_no='$id'");
    
    if($result) {
        header('location:payment_table.php');
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }

    mysqli_close($con);
}
?>
<?php
require_once 'hfm/header.php';
require_once 'hfm/manu1.php';
?>
<html>
<head></head>
<body>
    <div style="text-align: center;padding-top: 18%">
    <h1 style="text-align: center;font-size: 40px;font-family: Monotype Corsiva;text-decoration: underline;">Update Payment Data</h1>
    <form name="frmpayment" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
        <input type="hidden" name="id" value="<?php echo $row['Payment_no']?>">
        <br>
        Payment_date: <input type="datetime-local" name="payment_date" value="<?php echo $row['Payment_date']?>" >
        <br />
        <br />
        Amount: <input type="text" name="amount" value="<?php echo $row['Amount']?>">
        <br />
        <br />
        User id: 
        <select name="login_id">
            <option value="">Select User ID</option>
            <?php
            require_once 'connect.php';
            $login_result = mysqli_query($con, "SELECT login_id FROM login");
            while ($login_row = mysqli_fetch_assoc($login_result)) {
                $selected = ($row['Login_id'] == $login_row['login_id']) ? 'selected' : '';
                echo "<option value='{$login_row['login_id']}' $selected>{$login_row['login_id']}</option>";
            }
            mysqli_close($con);
            ?>
        </select>
        <br />
        <br />
        <input type="submit" name="btn_submit" value="Update">   
    </form>
    </div>
</body>
</html>
<?php
require_once "hfm/footer1.php";
?>
