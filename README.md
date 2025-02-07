# Paypal-API-PaymentGateway
PayPal Payment Integration using PHP &amp; MySQL allows secure online transactions with PayPal, automatically storing transaction details in a MySQL database. This project ensures seamless payment processing with real-time validation, making it ideal for e-commerce platforms and online services.

## 📌 Features  
✅ Secure **PayPal Checkout** integration  
✅ Automatic **database transaction storage**  
✅ Real-time payment validation & status updates  
✅ **Easy setup** with XAMPP for local development  
✅ Error handling & debugging  

## 🛠️ Tech Stack  
- **PHP** – Backend Logic  
- **MySQL** – Stores transaction records  
- **JavaScript (PayPal SDK)** – Payment Processing  
- **XAMPP** – Local Development Server

## 📌 Installation Guide  

### **Step 1: Install XAMPP**  
1. Download & install XAMPP from [Apache Friends](https://www.apachefriends.org/).  
2. Start **Apache** and **MySQL** from the XAMPP Control Panel.  

### **Step 2: Set Up the Project**  
1. Copy the project folder (`ppp`) to:  C:\xampp\htdocs\
2. 2. Open **phpMyAdmin** (`http://localhost/phpmyadmin/`).  
3. Create a new database:  ```sql CREATE DATABASE paypal;
4. Click Import → Select transactions.sql from SQL folder → Click Go.

## 🛠️ Configure config.php

## Run the project 
1. Open your browser and visit: http://localhost/ppp/index.php
2. Click PayPal Checkout and complete the payment.
3. You’ll be redirected to payment-status.php after payment.
