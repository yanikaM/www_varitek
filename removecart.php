<?php
session_start();
// session_destroy();
//  exit();

    
        $itemId = isset($_GET['itemId']) ? $_GET['itemId'] : "";
        // echo $itemId."</br>";
        // echo $option_d."</br>";


        unset($_SESSION['cart']["$itemId"]);

        // echo "<pre>";
        // print_r($_SESSION['cart']);
        echo "<script>";
        echo "window.history.go (-1);";
        echo "</script>";

       
    
?>


 
