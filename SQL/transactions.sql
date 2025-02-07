USE paypal;

CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    checkout_ref_id VARCHAR(50) NOT NULL,
    txn_id VARCHAR(50) NOT NULL,
    payment_amount DECIMAL(10, 2) NOT NULL,
    currency_code VARCHAR(5) NOT NULL,
    payment_status VARCHAR(20) NOT NULL,
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);