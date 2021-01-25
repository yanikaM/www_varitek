<?php
	session_start();
	include("connect/conn.php");
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		  
	$strSQL = "SELECT * FROM customers WHERE Customer_Username = '".$username."' AND Customer_Password = '".$password."'";
	$objQuery = mysqli_query($con,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	
	
	if(!$objResult)
	{
		echo "<script language='javascript'> alert('ไม่มีข้อมูลในระบบ กรุณาลองใหม่');window.location='login.php';</script>";
	}
	else
	{
			$_SESSION["cust"] = $objResult["Customer_ID"];
			$_SESSION["cust_name"] = $objResult["Customer_Name"];
			$_SESSION["cust_email"] = $objResult["Customer_Email"];
			$_SESSION["cust_Employees_ID"] = $objResult["Employee_ID"];
			$_SESSION["cust_phone"] = $objResult["Customer_Phone"];
			
			$_SESSION['LOGIN'] = "login";
			
			header('location: shop-index.php'); 
	}

?>