<?php
session_start();
require_once 'connect.php';

$sql = mysqli_query($con, "SELECT * FROM login WHERE Login_id='{$_SESSION['id']}'");
$row = mysqli_fetch_array($sql);

$name = $row['Name'];
$email = $row['Email'];
$phone_no = $row['Phone_no'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_name = $_POST['name'];
    $new_email = $_POST['email'];
    $new_phone_no = $_POST['phone_no'];

    $update_sql = "UPDATE login SET Name='$new_name', Email='$new_email', Phone_no='$new_phone_no' WHERE Login_id='{$_SESSION['id']}'";
    if (mysqli_query($con, $update_sql)) {
        $_SESSION['success_message'] = "Profile updated successfully!";
        header("Location: users_profile.php");
        exit();
    } else {
        $error_message = "Error updating profile: " . mysqli_error($con);
    }
}
?>

<html>
<head>
    <title>Edit Profile</title>
</head>
<body>
<?php require_once "hfm/header.php"; ?>
<?php require_once "hfm/manu.php"; ?>

<div class="container">
    <h1 style="text-align: center;font-size: 40px;font-family: Monotype Corsiva;text-decoration: underline;padding-top: 13%">Edit Profile</h1>
    <div style="padding-left: 43%">
        <?php
        if (isset($error_message)) {
            echo "<div style='color: red;'>{$error_message}</div>";
        }
        ?>
        <form method="post" action="edit_profile.php">
            <table>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="name" value="<?php echo $name ?>" required></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" value="<?php echo $email ?>" required></td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td><input type="text" name="phone_no" value="<?php echo $phone_no ?>" required></td>
                </tr>
            </table>
            <br>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</div>
</body>
</html>
