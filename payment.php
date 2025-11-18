<?php
include 'db_connect.php';

// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

$status = "";
$total_paid = 0;
$m = 0;

// Check installment status
if (isset($_POST['check'])) {
    $student_id = $_POST['student_id'];

    // Total paid amount
    $query = mysqli_query($conn, "SELECT SUM(amount) AS total FROM payments WHERE student_id='$student_id'");
    $data = mysqli_fetch_assoc($query);
    $total_paid = $data['total'] ?? 0;

    // Count distinct months
    $months_query = mysqli_query($conn, "SELECT COUNT(DISTINCT month) AS total_months FROM payments WHERE student_id='$student_id'");
    $m = mysqli_fetch_assoc($months_query)['total_months'];

    // Monthly fee
    $monthly_fee = 1500;
    $required = $m * $monthly_fee;

    // Month-wise Paid/Due check
    $status = "❌ INCOMPLETE"; // default
    $color = "red";

    $months_result = mysqli_query($conn, "SELECT month, status FROM payments WHERE student_id='$student_id'");
    $all_paid = true;

    while($row = mysqli_fetch_assoc($months_result)){
        if($row['status'] != "Paid"){
            $all_paid = false;
            break;
        }
    }

    if($all_paid && $m > 0){
        $status = "✔ COMPLETE";
        $color = "green";
    }
}

// Add payment
if (isset($_POST['add'])) {
    $student_id2 = $_POST['student_id2'];
    $month = $_POST['month'];
    $amount = $_POST['amount'];
    $status2 = $_POST['status'];
    $method = $_POST['method'];
    $date = $_POST['date'];
    $trx_id = $_POST['trx_id'];

    $insert = "INSERT INTO payments(student_id, month, amount, status, method, date, trx_id)
               VALUES ('$student_id2','$month','$amount','$status2','$method','$date','$trx_id')";
    mysqli_query($conn, $insert);
}

// Delete payment
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM payments WHERE id=$id");
}

// Search payments
$search_query = "";
if(isset($_POST['search'])){
    $search = trim($_POST['search_text']);

    if(is_numeric($search)){
        $search_query = "WHERE student_id='$search'";
    } else {
        $search_query = "WHERE month LIKE '%$search%' OR method LIKE '%$search%'";
    }
}

// Fetch payments
$payments = mysqli_query($conn, "SELECT * FROM payments $search_query ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Payment & Installment Status</title>
<style>
body {font-family:Arial; background:#f2f2f2; padding:20px;}
h2 {color:#333;}
form {background:#fff; padding:15px; border-radius:8px; margin-bottom:20px;}
input, select {padding:8px; width:98%; margin:5px 0;}
button {padding:10px 15px; background:#5563DE; color:#fff; border:none; cursor:pointer; margin-top:10px;}
table {width:100%; background:#fff; border-collapse:collapse; margin-top:20px;}
th, td {padding:12px; border:1px solid #ccc; text-align:center;}
th {background:#5563DE; color:white;}
a.delete {color:red; font-weight:bold;}
.status-box {background:#fff; padding:15px; border-radius:8px; margin-top:20px;}
</style>
</head>
<body>

<h2>💳 Payment Management & Installment Status</h2>

<!-- Check Installment Status -->
<form method="POST">
    <input type="number" name="student_id" placeholder="Enter Student ID to check status" required>
    <button name="check">Check Installment Status</button>
</form>

<?php if($status != ""){ ?>
<div class="status-box">
    <h3>Status: <span style="color:<?= $color ?>"><?= $status ?></span></h3>
    <p><b>Total Paid:</b> <?= $total_paid ?> BDT</p>
    <p><b>Total Months Counted:</b> <?= $m ?></p>
    <p><b>Required Amount:</b> <?= $required ?> BDT</p>
</div>
<?php } ?>

<hr>

<!-- ADD PAYMENT FORM -->
<form method="POST">
    <h3>Add Payment</h3>
    <input type="number" name="student_id2" placeholder="Student ID" required>
    <input type="text" name="month" placeholder="Month (e.g. January)" required>
    <input type="number" name="amount" placeholder="Amount" required>

    <select name="status">
        <option value="Paid">Paid</option>
        <option value="Due">Due</option>
        <option value="Partial">Partial</option>
    </select>

    <select name="method">
        <option value="Cash">Cash</option>
        <option value="Bkash">bKash</option>
        <option value="Nagad">Nagad</option>
        <option value="Bank">Bank</option>
    </select>

    <input type="date" name="date" required>
    <input type="text" name="trx_id" placeholder="Transaction ID">
    <button type="submit" name="add">Add Payment</button>
</form>

<!-- Search Payments -->
<form method="POST">
    <input type="text" name="search_text" placeholder="Search by Student ID / Month / Method">
    <button name="search">Search</button>
</form>

<!-- Payment List Table -->
<table>
    <tr>
        <th>ID</th>
        <th>Student ID</th>
        <th>Month</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Method</th>
        <th>Date</th>
        <th>Transaction ID</th>
        <th>Action</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($payments)){ ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['student_id'] ?></td>
        <td><?= $row['month'] ?></td>
        <td><?= $row['amount'] ?></td>
        <td><?= $row['status'] ?></td>
        <td><?= $row['method'] ?></td>
        <td><?= $row['date'] ?></td>
        <td><?= $row['trx_id'] ?></td>
        <td><a href="?delete=<?= $row['id'] ?>" class="delete" onclick="return confirm('Are you sure?')">Delete</a></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
