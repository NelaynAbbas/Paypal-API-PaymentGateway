<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'paypal');

// PayPal configuration
define('PAYPAL_SANDBOX', true); // Set to false for live environment
define('PAYPAL_SANDBOX_CLIENT_ID', 'AXLKCyAn6WpdGAKDSzkp_obh2LZWtDZrLulvlfSsHXrSe8wvjiBBAL8MH-Sdl-rdPmUdFN8dO508JkYd');
define('PAYPAL_SANDBOX_SECRET', 'ED2C8DdEANH9Pp5PozlFFzLnGd1WPB3-QRUsCF58uKtZy8I0pQHHQTCxweb3jkblMzhZ-mLNcRh51uyl');
define('PAYPAL_PROD_CLIENT_ID', 'Ae1');
define('PAYPAL_PROD_SECRET', 'Ae1');

// Connect to the database
$db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

?>