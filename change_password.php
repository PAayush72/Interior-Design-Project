<?php
include 'connect.php';
// session_start();
if (isset($_POST['xyz'])) {
    // Retrieve the email address, OTP, and new password from the POST request
    // $email = $_POST['email'];
    // $otp = $_POST['otp'];
    $new_password = $_POST['new_pass'];
    session_start();

    // OTP is valid, update the password in the database
    // $_SESSION['email'] = $email;
    $email = $_SESSION['email'];
    $hashed_password = $new_password; // Hash the new password
    $update_query = "UPDATE login SET password='$hashed_password' WHERE email='$email'";
    if (mysqli_query($con, $update_query)) {
        echo "Password updated successfully.";
        header('location:login.php');
    } else {
        echo "Failed to update password. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .card {
            margin-top: 50px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            border-bottom: none;
            border-radius: 10px 10px 0 0;
            padding: 15px;
        }

        .card-body {
            padding: 20px;
        }

        .form-outline {
            text-align: center;
        }

        .form-control {
            border-radius: 20px;
        }

        .btn-primary {
            border-radius: 20px;
            width: 150px;
        }

        .password-toggle {
            position: relative;
        }

        .password-toggle input[type="password"] {
            padding-right: 30px;
        }

        .password-toggle .eye-icon {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 1;
        }
    </style>
</head>

<body>
    <div class="py-s">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Reset Your Password</h5>
                        </div>
                        <form action="" method="post">
                            <!-- <div class="form-group mb-3">
                                <label for="">email</label><br>
                                <input type="email" name="email" id="">
                            </div> -->
                            <div class="form-outline my-4 text-center w-100 m-auto">
                                New Password:
                                <input type="password" class="form-control w-50 m-auto" name="new_pass" id="password">
                            </div>
                            <div class="form-outline my-4 text-center w-100 m-auto">
                                <div class="password-toggle">
                                    Confirm Password:
                                    <input type="password" id="confirm_password" class="form-control w-50 m-auto" name="confirm_pass" oninput="checkPasswordMatch()">
                                    <span id="password_message"></span>
                                    <span class="eye-icon" onclick="togglePassword()">
                                        Show
                                    </span>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="xyz" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var eyeIcon = document.querySelector(".eye-icon");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.textContent = "Show";
            } else {
                passwordField.type = "password";
                eyeIcon.textContent = "Show";
            }
        }

        function checkPasswordMatch() {
            var password = document.getElementById("password").value;
            var confirm_password = document.getElementById("confirm_password").value;
            var message = document.getElementById("password_message");

            if (password === confirm_password) {
                message.textContent = "Passwords match";
                message.style.color = "green";
            } else {
                message.textContent = "Passwords do not match";
                message.style.color = "red";
            }
        }
    </script>
</body>

</html>
