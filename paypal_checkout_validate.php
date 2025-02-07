<?php
require_once 'config.php';

if (isset($_POST['paypal_order_check']) && $_POST['paypal_order_check'] == 1) {
    $order_id = $_POST['order_id'];
    
    // Validate the PayPal order (you should implement proper validation here)
    $valid_order = true;
    
    if ($valid_order) {
        // Generate a unique reference ID
        $checkout_ref_id = uniqid('PAYPAL_');
        
        // Insert transaction details into the database
        $stmt = $db->prepare("INSERT INTO transactions (checkout_ref_id, txn_id, payment_amount, currency_code, payment_status) VALUES (?, ?, ?, ?, ?)");
        $payment_amount = 25.99; // Replace with actual amount
        $currency_code = 'USD';
        $payment_status = 'Completed';
        $stmt->bind_param("ssdss", $checkout_ref_id, $order_id, $payment_amount, $currency_code, $payment_status);
        $stmt->execute();
        $stmt->close();
        
        echo json_encode(array('status' => 1, 'msg' => 'Payment successful!', 'ref_id' => $checkout_ref_id));
    } else {
        echo json_encode(array('status' => 0, 'msg' => 'Payment validation failed.'));
    }
    exit;
}

echo json_encode(array('status' => 0, 'msg' => 'Invalid request.'));
exit;