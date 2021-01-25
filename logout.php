<html lang="en">
  <head>
  <META http-equiv="expires" content="0">
  <meta charset="UTF-8">
 
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
  </head>

<?php

session_start();

// clear session
unset($_SESSION['cust']);
unset($_SESSION['cust_name']);
unset($_SESSION['cust_email']);
unset($_SESSION['cust_Employees_ID']);
unset($_SESSION['cust_phone']);
unset($_SESSION['LOGIN']);

echo "<script language=\"javascript\" type=\"text/javascript\">parent.location.href='login.php';</script>";

?>
