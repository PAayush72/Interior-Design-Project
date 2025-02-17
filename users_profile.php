<?php
session_start();
require_once 'connect.php';
require_once 'tcpdf/tcpdf.php';

$sql = mysqli_query($con, "SELECT * FROM login WHERE Login_id='{$_SESSION['id']}'");
$row = mysqli_fetch_array($sql);

$name = $row['Name'];
$email = $row['Email'];
$phone_no = $row['Phone_no'];

$sql1 = mysqli_query($con, "SELECT * FROM servicee WHERE Login_id='{$_SESSION['id']}'");
$sql2 = mysqli_query($con, "SELECT * FROM payment WHERE Login_id='{$_SESSION['id']}'");

function generateInvoicePDF($payments, $userName)
{
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Aayush Panchal');
    $pdf->SetTitle('Invoice');
    $pdf->SetSubject('Invoice');

    $pdf->AddPage();

    $pdf->SetFont('helvetica', '', 12);

    $html = '<h1><img src="images/logo2.jpeg" alt="Image placeholder" class="img-fluid" height="100px" width="100px"><br>Invoice Royal Estate Design</h1>';
    $html .= "<br><p>Hello {$userName},</p><p>This is your payment details:</p>";
    foreach ($payments as $payment) {
        $html .= "<p>Date: {$payment['Payment_date']}, Amount: {$payment['Amount']}</p>";
    }

    $pdf->writeHTML($html, true, false, true, false, '');

    $pdf->Output('invoice.pdf', 'D');
}

if (isset($_GET['download_invoice']) && $_GET['download_invoice'] == 1) {
    $payments = [];
    while ($row2 = mysqli_fetch_assoc($sql2)) {
        $payments[] = $row2;
    }
    generateInvoicePDF($payments, $name);
}

?>

<html>
<head>
    <title>User Profile</title>
</head>
<body>
<?php require_once "hfm/header.php"; ?>
<?php require_once "hfm/manu.php"; ?>

<div class="container">
    <h1 style="text-align: center;font-size: 40px;font-family: Monotype Corsiva;text-decoration: underline;padding-top: 13%">User Profile</h1>
    <div style="padding-left: 43%">
        <?php
        if (isset($_SESSION['success_message'])) {
            echo "<div style='color: green;'>{$_SESSION['success_message']}</div>";
            unset($_SESSION['success_message']);
        }
        ?>
        <table>
            <tr><td>Name:</td><td><?php echo $name ?></td></tr>
            <tr><td>Email:</td><td><?php echo $email ?></td></tr>
            <tr><td>Phone:</td><td><?php echo $phone_no ?></td></tr>
        </table>
        <br>
        <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>
    </div>
    <br>
    <h1 style="text-align: center;font-size: 40px;font-family: Monotype Corsiva;text-decoration: underline;">Service Data</h1>
    <table class="table table-hover" border="1px" align="center">
        <thead class="table-dark">
        <th>Design</th>
        <th>Query</th>
        <th>Actions</th>
        </thead>

        <?php
        while ($row1 = mysqli_fetch_array($sql1)) {
            ?>
            <tr>
                <td><?php echo $row1['Design'] ?></td>
                <td><?php echo $row1['Query'] ?></td>
                <td><a href="service_update.php"><img src="images/update.png"></a></td>
            </tr>
        <?php } ?>
    </table>
</div>

<br>
<h1 style="text-align: center;font-size: 40px;font-family: Monotype Corsiva;text-decoration: underline;">Payment Data</h1>
<table class="table table-hover" border="1px" align="center">
    <thead class="table-dark">
    <th>Payment Date</th>
    <th>Amount</th>
    <th>Acknowledge</th>
    <th>Invoice</th>
    </thead>

    <?php
    while ($row2 = mysqli_fetch_array($sql2)) {
        ?>
        <tr>
            <td><?php echo $row2['Payment_date'] ?></td>
            <td><?php echo $row2['Amount'] ?></td>
            <td><a href="accept_appointment.php?id=<?php echo $row['Login_id']; ?>"><u>Acknowledge Payment</u></a></td>
            <td> <a href="?download_invoice=1"><u>Download Invoice</u></a></td>
        </tr>
    <?php } ?>
</table>
</body>
</html>
