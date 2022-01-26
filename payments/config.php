
<?php 
/* 
 * PayPal and database configuration 
 */ 
  
// PayPal configuration 
define('PAYPAL_ID', 'sb-gp3fg4808343@business.example.com');//define('PAYPAL_ID', 'Insert_PayPal_Business_Email'); 
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 
 
define('PAYPAL_RETURN_URL', 'http://skylineautoservices.co/admin/payments/success.php'); 
define('PAYPAL_CANCEL_URL', 'http://skylineautoservices.co/admin/payments/cancel.php'); 
define('PAYPAL_NOTIFY_URL', 'http://skylineautoservices.co/admin/payments/ipn.php'); 
define('PAYPAL_CURRENCY', 'USD'); 
 
// Database configuration 
define('DB_HOST', 'jeanpierre009400390.ipagemysql.com'); 
define('DB_USERNAME', 'skylineadmin'); 
define('DB_PASSWORD', 'Skyline@12345678'); 
define('DB_NAME', 'skylinedb'); 
 
// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");