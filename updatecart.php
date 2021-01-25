<?php
 
 session_start();
//session_destroy();
//  exit();
//  echo "<pre>";
//  print_r($_POST);

    
        $itemId = $_POST['itemId'];
        $sp = isset($_POST['sp']);
        $qty = $_POST['qty'];

        


    if (!isset($_SESSION['cart'][$itemId])){
            //ไม่มี สร้างใหม่เลยยยยย
            
        $_SESSION['cart'][$itemId] = $qty;
        

        echo "<script>";
        echo "window.history.go (-1);";
        echo "</script>";
        
    }else{
            //มีเเล้ว บวกไปเรื่อยๆๆๆๆๆๆๆๆๆๆๆๆๆ
        $_SESSION['cart'][$itemId]  = ($_SESSION['cart'][$itemId]+$qty);
        

        echo "<script>";
        echo "window.history.go (-1);";
        echo "</script>";
    }

//     echo "<pre>";
// print_r($_SESSION['cart']);


?>
