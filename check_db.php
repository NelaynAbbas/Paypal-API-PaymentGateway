<?php
$servername = "localhost"; 
$username = "root"; // Change if needed
$password = ""; // Default is empty in XAMPP
$database = "paypal"; // Ensure this is your actual PayPal database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection to PayPal database failed: " . $conn->connect_error);
} else {
    echo "PayPal database connected successfully!<br>";
}

// Check if 'transactions' table exists
$query = "SHOW TABLES LIKE 'transactions'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "✅ 'transactions' table found!";
} else {
    echo "❌ 'transactions' table not found. Check if the database is imported correctly.";
}

$conn->close();
?>
