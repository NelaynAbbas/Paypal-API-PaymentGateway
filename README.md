# **PayPal-API-PaymentGateway**  

**PayPal Payment Integration using PHP & MySQL** allows secure online transactions with **PayPal**, automatically storing transaction details in a **MySQL database**. This project ensures **seamless payment processing** with real-time validation, making it ideal for **e-commerce platforms** and **online services**.  

## **📌 Features**  
✅ Secure **PayPal Checkout** integration  
✅ Automatic **database transaction storage**  
✅ Real-time **payment validation & status updates**  
✅ **Easy setup** with XAMPP for local development  
✅ **Error handling** & debugging  

## **🛠️ Tech Stack**  
![CSS3](https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white)  
![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white)  
![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)  
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)  
![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)  
![GitHub](https://img.shields.io/badge/github-%23121011.svg?style=for-the-badge&logo=github&logoColor=white)  
![Git](https://img.shields.io/badge/git-%23F05033.svg?style=for-the-badge&logo=git&logoColor=white)  

---

## **📌 Installation Guide**  

### **Step 1: Install XAMPP**  
1. Download & install **XAMPP** from [Apache Friends](https://www.apachefriends.org/).  
2. Start **Apache** and **MySQL** from the **XAMPP Control Panel**.  

### **Step 2: Set Up the Project**  
1. Copy the project folder (`ppp`) to:  
   ```
   C:\xampp\htdocs\
   ```
2. Open **phpMyAdmin** by visiting:  
   ```
   http://localhost/phpmyadmin/
   ```
3. **Create a new database** by running the following SQL command:  
   ```sql
   CREATE DATABASE paypal;
   ```
4. **Import the database**:  
   - Click **Import** → Select `transactions.sql` from the **SQL folder** → Click **Go**.  

---

## **🛠️ Configure config.php**  
Edit the `config.php` file and update the **PayPal API keys** with your **PayPal Client ID** and **Secret Key**.  

```php
<?php
define('PAYPAL_CLIENT_ID', 'your-client-id-here');
define('PAYPAL_SECRET', 'your-secret-key-here');
define('PAYPAL_MODE', 'sandbox'); // Change to 'live' for production
?>
```
To obtain PayPal credentials:  
1. Log in to **[PayPal Developer](https://developer.paypal.com/)**.  
2. Go to **Dashboard → My Apps & Credentials**.  
3. Copy the **Client ID** and **Secret Key**.  

---

## **🚀 Run the Project**  
1. Open your browser and visit:  
   ```
   http://localhost/ppp/index.php
   ```
2. Click **PayPal Checkout** and complete the payment.  
3. After payment, you will be **redirected** to `payment-status.php`.  

---

## **📜 License**  
This project is licensed under the **MIT License** – feel free to use and modify it as needed.  

---

## **📩 Connect With Me**  

👤 **Nelayn Abbas**  
🌐 [GitHub Profile](https://github.com/NelaynAbbas)  
📧 **Email:** nelaynabbas@example.com  

<p align="right">(<a href="#readme-top">back to top</a>)</p>  

---

This **updated README** ensures that everything is structured well and **easy to follow** for developers setting up the PayPal Payment Gateway. Let me know if you need further improvements! 🚀
