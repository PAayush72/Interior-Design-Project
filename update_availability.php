<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $con->prepare("SELECT * FROM availability WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $date = $row['date'];
        $time = $row['time'];

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Update Availability</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #fff;
                    color: #000;
                }
                h1 {
                    color: #000;
                }
                form {
                    margin-bottom: 20px;
                }
                label {
                    display: block;
                    margin-bottom: 5px;
                    color: #000;
                }
                input[type="date"],
                input[type="time"],
                input[type="submit"] {
                    padding: 5px;
                    margin-bottom: 10px;
                    border: 1px solid #000;
                    border-radius: 3px;
                }
                input[type="submit"] {
                    background-color: #000;
                    color: #fff;
                    cursor: pointer;
                }
                input[type="submit"]:hover {
                    background-color: #444;
                }
            </style>
        </head>
        <body>
            <h1>Update Availability</h1>
            <form method="POST" action="process_update.php">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label for="date">Date:</label><br>
                <input type="date" id="date" name="date" value="<?php echo $date; ?>" required><br>
                <label for="time">Time:</label><br>
                <input type="time" id="time" name="time" value="<?php echo $time; ?>" required><br>
                <input type="submit" name="update_availability" value="Update Availability">
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "Availability record not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}
?>
