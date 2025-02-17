<?php
include 'connect.php';
session_start();
if (isset($_SESSION['otp'])) {
    if (isset($_POST['xyz'])) {
        $otp = $_POST['otp'];
        if (isset($_SESSION['otp']) && $_SESSION['otp'] == $otp) {
            echo "Password updated successfully.";
            header('location:change_password.php');
        } else {
            echo "Invalid OTP.";
        }
    }
} else {
    echo "Invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm OTP</title>
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
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Confirm OTP</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-outline my-4">
                                <input type="text" class="form-control" name="otp" maxlength="6" placeholder="Enter OTP">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="xyz" class="btn btn-primary">Verify</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
