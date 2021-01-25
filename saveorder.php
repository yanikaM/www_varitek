<?php
session_start();
include("connect/conn.php");

if (($_SESSION['LOGIN']) != 'login'){
    echo "<script>";
    echo "alert('กรุณาเข้าสู่ระบบ');";
    echo "window.location ='login.php';";
    echo "</script>";
    exit();
  }
$status =1;
if (isset($_SESSION['cart'])){
    $meQty = 0;
    foreach ($_SESSION['cart'] as $k => $meItem){

            $meQty +=  $meItem ;
        
    }
}else{
    $meQty = 0;
}

$sqlo	= "SELECT * FROM `orders` WHERE date_format( `Orders_Date` , '%Y' ) = date_format( NOW( ) , '%Y' ) AND date_format( `Orders_Date` , '%m' ) = date_format( NOW( ) , '%m' )";
$queryo = mysqli_query($con, $sqlo);
$counto=mysqli_num_rows($queryo);
$ordernum = str_pad($counto+1, 4, "0", STR_PAD_LEFT);
$cust = $_SESSION['cust'];
$add = $_POST['radio_address'];


$ornumber =  "ORD".date("Ym")."-".$ordernum ;

$order_date = date("Y-m-d");
$today = date("Y-m-d H:i:s");

$sql1 = "INSERT  INTO orders
	(Orders_No,Customer_ID,Admin_ID,Orders_Date,Orders_Status,Orders_TAG,DateCreate,LastUpdate,ca_ID) VALUES
	(
	'$ornumber',  
	'$cust',
	NULL,
	'$order_date ',
	'$status ',
	'',
	'$today',
	'$today',
    '$add'
    )";

    $query1 = mysqli_query($con, $sql1);


if($query1==TRUE){

    $total_price = 0;
    $num = 0;

    foreach ($_SESSION['cart'] as $itemId => $itemValue){
       

            $query_cartd = "SELECT * FROM products as p 
            WHERE Products_ID = '$itemId'";
            $cartd = mysqli_query($con,$query_cartd);
            $row = mysqli_fetch_assoc($cartd);
            $price= $row['Products_price'];
        


            $sql_od= "INSERT INTO  orders_detail (Orders_No,Products_ID,Products_Qty) VALUE ('$ornumber','$itemId','$meItem')";
            $query_od = mysqli_query($con, $sql_od) ;
            $num++; 

        
    }
    if($query_od==TRUE){
        unset($_SESSION['cart']);
       
        echo "<script>";
        echo "alert('บันทึกข้อมูลเรียบร้อยแล้ว');";
        echo "window.location ='order.php?order_no=".$ornumber."'";
        echo "</script>";

    }else{
        echo $query_cartd;
        echo $sql_od;
      
        // echo "<script>";
        // echo "alert('บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่');";
        // echo "window.location ='order.php'; ";
        // echo "</script>";	
    }

}
?>

<script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery.sticky.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
