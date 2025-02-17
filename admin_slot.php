<?php
$date_error = "";
$time_error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $is_validate = true;
    $date = $_POST['date'];
    $time = $_POST['time'];

    if (empty($date)) {
        $date_error = 'Date is required';
        $is_validate = false;
    }
    if (empty($time)) {
        $time_error = 'Time is required';
        $is_validate = false;
    }

    if ($is_validate) {
        require_once 'connect.php';

        if (isset($_POST['add_availability'])) {
            $insert_query = "INSERT INTO availability (date, time) VALUES ('$date', '$time')";
            if (mysqli_query($con, $insert_query)) {
                header('Location: admin_slot.php');
                exit;
            } else {
                echo "Error: " . $insert_query . "<br>" . mysqli_error($con);
            }
        } elseif (isset($_POST['delete_availability'])) {
            $id = $_POST['id'];
            $delete_query = "DELETE FROM availability WHERE id = $id";
            if (mysqli_query($con, $delete_query)) {
                header('Location: admin_slot.php');
                exit;
            } else {
                echo "Error: " . $delete_query . "<br>" . mysqli_error($con);
            }
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
    .error {
        color: red;
    }
</style>
<div style="padding-top: 18%; text-align: center;">
    <h1 style="text-align: center; font-size: 40px; font-family: Monotype Corsiva; text-decoration: underline;">Add Availability</h1><br>
    <form name="frmavailability" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        Date: <input type="date" name="date" value="<?php echo !empty($_POST['date']) ? $_POST['date'] : ""; ?>"><span class="error">* <?php echo $date_error ?></span>
        <br /><br />
        Time: <input type="time" name="time" value="<?php echo !empty($_POST['time']) ? $_POST['time'] : ""; ?>"><span class="error">* <?php echo $time_error ?></span>
        <br /><br />
        <input type="submit" name="add_availability" value="Add Availability">
    </form>
</div>
<div style="text-align: center; padding-top: 5%;">
    <h1 style="text-align: center; font-size: 40px; font-family: Monotype Corsiva; text-decoration: underline;">Current Availability</h1><br>
    <?php
    require_once 'connect.php';
    $sql = "SELECT * FROM availability WHERE available = TRUE ORDER BY date, time";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        echo '<table class="table table-hover" border="1px" align="center">';
        echo '<thead class="table-dark"><tr><th>Date</th><th>Time</th><th>Action</th></tr></thead>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row["date"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["time"]) . '</td>';
            echo '<td>';
            echo '<a href="update_availability.php?id=' . $row["id"] . '">Update</a> | ';
            echo '<form method="POST" action="" style="display:inline;">';
            echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
            echo '<input type="submit" name="delete_availability" value="Delete">';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "No availability found.";
    }

    mysqli_close($con);
    ?>
</div>
</body>
</html>

<?php
require_once "hfm/footer1.php";
?>
