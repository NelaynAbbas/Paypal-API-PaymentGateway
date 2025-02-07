<?php
require_once 'config.php';

$checkout_ref_id = isset($_GET['checkout_ref_id']) ? $_GET['checkout_ref_id'] : '';

if (empty($checkout_ref_id)) {
    header("Location: index.php");
    exit;
}

// Fetch transaction details from the database
$stmt = $db->prepare("SELECT * FROM transactions WHERE checkout_ref_id = ?");
$stmt->bind_param("s", $checkout_ref_id);
$stmt->execute();
$result = $stmt->get_result();
$transaction = $result->fetch_assoc();
$stmt->close();

if (!$transaction) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Payment Status</h1>
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Payment Successful</h3>
            </div>
            <div class="panel-body">
                <p><strong>Transaction ID:</strong> <?php echo $transaction['txn_id']; ?></p>
                <p><strong>Amount:</strong> $<?php echo $transaction['payment_amount']; ?> <?php echo $transaction['currency_code']; ?></p>
                <p><strong>Status:</strong> <?php echo $transaction['payment_status']; ?></p>
                <p><strong>Date:</strong> <?php echo $transaction['created']; ?></p>
                <a href="index.php" class="btn">Back to Home</a>
            </div>
        </div>
    </div>
</body>
</html>