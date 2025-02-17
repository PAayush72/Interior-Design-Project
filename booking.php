<?php
include 'connect.php';
require 'smtp/PHPMailerAutoload.php';

function sendConfirmationEmail($email, $name, $date, $time, $message, $address)
{
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->Username = "panchalaayush72@gmail.com"; 
    $mail->Password = "cydvqkgpmpoetkvx"; 
    $mail->setFrom("$email", "name"); 
    $mail->addAddress($email); 
    $mail->isHTML(true);
    $mail->Subject = "Appointment Confirmation";
    $mail->Body = "
        <h1>Appointment Confirmation From Royal Estate Design</h1>
        <p>Dear $name,</p>
        <p>Your appointment has been confirmed with the following details:</p>
        <p>Date: $date<br>Time: $time<br>Message: $message<br>Address: $address</p>
        <p>Thank you for booking with us.</p>
    ";

    if ($mail->send()) {
        return true; 
    } else {
        return false; 
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $availability_id = $_POST['availability_id'];
    $message = $_POST['message'];
    $address = $_POST['address'];

    $availability_sql = "SELECT date, time FROM availability WHERE id = $availability_id AND available = TRUE";
    $availability_result = $con->query($availability_sql);

    if ($availability_result->num_rows == 1) {
        $availability_row = $availability_result->fetch_assoc();
        $date = $availability_row['date'];
        $time = $availability_row['time'];

        $sql = "INSERT INTO bookings (name, email, phone, date, time, message, address) VALUES ('$name', '$email', '$phone', '$date', '$time', '$message', '$address')";
        if ($con->query($sql) === TRUE) {
            $update_sql = "UPDATE availability SET available = FALSE WHERE id = $availability_id";
            $con->query($update_sql);

            if (sendConfirmationEmail($email, $name, $date, $time, $message, $address)) {
                echo "Booking successful! A confirmation email has been sent to your email address.";
            } else {
                echo "Booking successful, but failed to send confirmation email.";
            }
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    } else {
        echo "Selected availability is no longer available.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .chatbox-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .chatbox-icon img {
            width: 50px;
            height: 50px;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
   

<body>
    <div class="container">
        <h1>Book a Consultation</h1>
        <form method="POST" action="">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>
            <label for="phone">Phone:</label><br>
            <input type="text" id="phone" name="phone"><br>
            <label for="availability">Select Date and Time:</label><br>
            <select id="availability" name="availability_id" required>
                <?php
                $sql = "SELECT * FROM availability WHERE available = TRUE ORDER BY date, time";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["id"]. "'>" . $row["date"]. " " . $row["time"]. "</option>";
                    }
                } else {
                    echo "<option value=''>No availability</option>";
                }
                ?>
            </select><br>
            <label for="message">Message:</label><br>
            <textarea id="message" name="message"></textarea><br>
            <label for="address">Address:</label><br>
            <textarea id="address" name="address"></textarea><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
