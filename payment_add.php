<?php
$date_error="";
$amount_error ="";
$sid_error ="";

if( !empty($_POST['btn_submit']) ){
    $is_validate = true;
    $payment_date = $_POST['payment_date'];
    $amount = $_POST['amount'];
    $login_id = $_POST['login_id'];

    if( empty($payment_date) ){
        $date_error = 'payment date is required';
        $is_validate = false;
    }
    if( empty($amount) ){
        $amount_error = 'payment amount is required';
        $is_validate = false;
    }
    if( empty($login_id) ){
        $sid_error = 'login id is required';
        $is_validate = false;
    } 

    if($is_validate)
    {
        require_once 'connect.php';
        
        $insert_query = "INSERT INTO payment (Payment_date, Amount, Login_id) VALUES ('$payment_date','$amount','$login_id')";
        
        if(mysqli_query($con, $insert_query)) {
            header('location:payment_table.php');
            exit;
        } else {
            echo "Error: " . $insert_query . "<br>" . mysqli_error($con);
        }

        mysqli_close($con);
    }
}
?>

<?php
require_once 'hfm/header.php';
require_once 'hfm/manu1.php';
?>

<html>
<head></head>
<body>
<style>
    .error{
        color: red;
    }
</style>
<div style="padding-top: 18%;text-align: center;">
    <h1 style="text-align: center;font-size: 40px;font-family: Monotype Corsiva;text-decoration: underline;">Add Payment Data</h1><br>
    <form  name="frmpayment" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
        Payment_date: <input type="datetime-local" name="payment_date" value="<?php echo !empty($_POST['payment_date'])? $_POST['payment_date']:""; ?>" ><span class="error">* <?php echo $date_error ?></span>
        <br />
        <br />
        Amount: <input type="text" name="amount" value="<?php echo !empty($_POST['amount'])? $_POST['amount']:""; ?>" ><span class="error">* <?php echo $amount_error ?></span>
        <br />
        <br />
        User id: 
        <select name="login_id">
            <option value="">Select User ID</option>
            <?php
            require_once 'connect.php';
            $result = mysqli_query($con, "SELECT login_id FROM login");
            while ($row = mysqli_fetch_assoc($result)) {
                $selected = (!empty($_POST['login_id']) && $_POST['login_id'] == $row['login_id']) ? 'selected' : '';
                echo "<option value='{$row['login_id']}' $selected>{$row['login_id']}</option>";
            }
            mysqli_close($con);
            ?>
        </select>
        <span class="error">* <?php echo $sid_error ?></span>
        <br />
        <br />
        <input type="submit" name="btn_submit" value="Add New Payment">
    </form>
</div>
</body>
</html>

<?php
  require_once "hfm/footer1.php";
?>
