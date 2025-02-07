<?php
require_once 'config.php';

// Set item details (you can fetch these from a database if needed)
$itemName = "Example Product";
$itemNumber = "PROD001";
$itemPrice = 25.99;
$currency = "USD";

// Fetch previous transactions
$stmt = $db->prepare("SELECT * FROM transactions ORDER BY created DESC LIMIT 5");
$stmt->execute();
$result = $stmt->get_result();
$transactions = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayPal Payment Integration</title>
    <link rel="stylesheet" href="css/style.css">
    <script
        src="https://www.paypal.com/sdk/js?client-id=<?php echo PAYPAL_SANDBOX ? PAYPAL_SANDBOX_CLIENT_ID : PAYPAL_PROD_CLIENT_ID ?>&buyer-country=US&currency=USD&components=buttons&enable-funding=card&disable-funding=venmo,paylater"
        data-sdk-integration-source="developer-studio"> 
    </script>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <i class="fas fa-shield-alt"></i>
                    <span>SecurePay Gateway</span>
                </div>
                <nav>
                    <a href="#dashboard">Dashboard</a>
                    <a href="#transactions">Transactions</a>
                    <a href="#settings">Settings</a>
                </nav>
                <div class="header-actions">
                    <button class="theme-toggle">
                        <i class="fas fa-moon"></i>
                    </button>
                    <button class="btn-primary">Sign In</button>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <h1 style = "padding-top:15px" >Secure Payment Gateway</h1>
            <section class="payment-section">
                <div class="payment-card">
                    <div class="card-header">
                        <h2><i class="fas fa-lock"></i> Secure Payment</h2>
                        <p>Complete your payment using our secure payment gateway</p>
                    </div>

                    <div class="card-body"> 

                        <!-- Credit Card Form -->
                        <div class="panel" >
                            <div class="overlay hidden"><div class="overlay-content"></div></div>

                            <div class="panel-heading" style = "padding-top:15px; margin-bottom:20px; align-items:center;background:#0f172a; color:white; padding-bottom:15px; border-radius:10px; padding-left:20px">
                                <h3 class="panel-title" >Charge <?php echo '$'.$itemPrice; ?> with PayPal</h3>
                                
                                <!-- Product Info -->
                                <p><b>Item Name:</b> <?php echo $itemName; ?></p>
                                <p><b>Price:</b> <?php echo '$'.$itemPrice.' '.$currency; ?></p>
                            </div>
                            <div class="panel-body">
                                <!-- Display status message -->
                                <div id="paymentResponse" class="hidden"></div>
                                
                                <!-- Set up a container element for the button -->
                                <div id="paypal-button-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>




        
        <div class="panel transactions-section">
            <div class="panel-heading">
                <h3 class="panel-title">Previous Transactions</h3>
            </div>
            <div class="panel-body table-container">
                <?php if (empty($transactions)): ?>
                    <p>No previous transactions found.</p>
                <?php else: ?>
                    <table class="transactions-table">
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transactions as $transaction): ?>
                                <tr>
                                    <td><?php echo $transaction['txn_id']; ?></td>
                                    <td><?php echo '$' . $transaction['payment_amount'] . ' ' . $transaction['currency_code']; ?></td>
                                    <td><?php echo $transaction['payment_status']; ?></td>
                                    <td><?php echo $transaction['created']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <h3>About SecurePay</h3>
                    <p>Secure payment gateway with integrated fraud detection for safe online transactions.</p>
                </div>
                <div class="footer-section">
                    <h3>Security</h3>
                    <ul>
                        <li>PCI DSS Compliant</li>
                        <li>SSL/TLS Encryption</li>
                        <li>Fraud Protection</li>
                        <li>Data Security</li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Legal</h3>
                    <ul>
                        <li>Privacy Policy</li>
                        <li>Terms of Service</li>
                        <li>GDPR Compliance</li>
                        <li>Cookie Policy</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                © 2024 SecurePay Gateway. All rights reserved.
            </div>
        </div>
    </footer>

<script>
paypal.Buttons({
    // Sets up the transaction when a payment button is clicked
    createOrder: (data, actions) => {
        return actions.order.create({
            "purchase_units": [{
                "custom_id": "<?php echo $itemNumber; ?>",
                "description": "<?php echo $itemName; ?>",
                "amount": {
                    "currency_code": "<?php echo $currency; ?>",
                    "value": <?php echo $itemPrice; ?>,
                    "breakdown": {
                        "item_total": {
                            "currency_code": "<?php echo $currency; ?>",
                            "value": <?php echo $itemPrice; ?>
                        }
                    }
                },
                "items": [
                    {
                        "name": "<?php echo $itemName; ?>",
                        "description": "<?php echo $itemName; ?>",
                        "unit_amount": {
                            "currency_code": "<?php echo $currency; ?>",
                            "value": <?php echo $itemPrice; ?>
                        },
                        "quantity": "1",
                        "category": "DIGITAL_GOODS"
                    },
                ]
            }]
        });
    },
    // Finalize the transaction after payer approval
    onApprove: (data, actions) => {
        return actions.order.capture().then(function(orderData) {
            setProcessing(true);

            var postData = {paypal_order_check: 1, order_id: orderData.id};
            fetch('paypal_checkout_validate.php', {
                method: 'POST',
                headers: {'Accept': 'application/json'},
                body: encodeFormData(postData)
            })
            .then((response) => response.json())
            .then((result) => {
                if(result.status == 1){
                    window.location.href = "payment-status.php?checkout_ref_id="+result.ref_id;
                }else{
                    const messageContainer = document.querySelector("#paymentResponse");
                    messageContainer.classList.remove("hidden");
                    messageContainer.textContent = result.msg;
                    
                    setTimeout(function () {
                        messageContainer.classList.add("hidden");
                        messageText.textContent = "";
                    }, 5000);
                }
                setProcessing(false);
            })
            .catch(error => console.log(error));
        });
    }
}).render('#paypal-button-container');

const encodeFormData = (data) => {
  var form_data = new FormData();

  for ( var key in data ) {
    form_data.append(key, data[key]);
  }
  return form_data;   
}

// Show a loader on payment form processing
const setProcessing = (isProcessing) => {
    if (isProcessing) {
        document.querySelector(".overlay").classList.remove("hidden");
    } else {
        document.querySelector(".overlay").classList.add("hidden");
    }
}    
</script>

</body>
</html>

