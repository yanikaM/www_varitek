<?php 
session_start();
error_reporting( error_reporting() & ~E_NOTICE );

$custid=$_SESSION['Customer_ID'];


if (isset($_SESSION['cart'])){
    $meQty = 0;
    foreach ($_SESSION['cart'] as $k => $meItem){
       
            $meQty +=  $meItem ;

    }
}else{
    $meQty = 0;
}

include("connect/conn.php");
?>
<!DOCTYPE html>

<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>
  <meta charset="utf-8">
  <title>Varitek</title>

  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <meta content="Metronic Shop UI description" name="description">
  <meta content="Metronic Shop UI keywords" name="keywords">
  <meta content="keenthemes" name="author">

  <meta property="og:site_name" content="-CUSTOMER VALUE-">
  <meta property="og:title" content="-CUSTOMER VALUE-">
  <meta property="og:description" content="-CUSTOMER VALUE-">
  <meta property="og:type" content="website">
  <meta property="og:image" content="-CUSTOMER VALUE-"><!-- link to image for socio -->
  <meta property="og:url" content="-CUSTOMER VALUE-">

  <link rel="shortcut icon" href="favicon.ico">

  <!-- Fonts START -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css"><!--- fonts for slider on the index page -->  
  <!-- Fonts END -->

  <!-- Global styles START -->          
  <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Global styles END --> 
   
  <!-- Page level plugin styles START -->
  <link href="assets/pages/css/animate.css" rel="stylesheet">
  <link href="assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
  <link href="assets/plugins/owl.carousel/assets/owl.carousel.css" rel="stylesheet">
  <!-- Page level plugin styles END -->

  <!-- Theme styles START -->
  <link href="assets/pages/css/components.css" rel="stylesheet">
  <link href="assets/pages/css/slider.css" rel="stylesheet">
  <link href="assets/pages/css/style-shop.css" rel="stylesheet" type="text/css">
  <link href="assets/corporate/css/style.css" rel="stylesheet">
  <link href="assets/corporate/css/style-responsive.css" rel="stylesheet">
  <link href="assets/corporate/css/themes/red.css" rel="stylesheet" id="style-color">
  <link href="assets/corporate/css/custom.css" rel="stylesheet">
  <!-- Theme styles END -->
</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body class="ecommerce">
  
<!-- BEGIN TOP BAR -->
<div class="pre-header">
        <div class="container">
            <div class="row">
                <!-- BEGIN TOP BAR LEFT PART -->
                <div class="col-md-6 col-sm-6 additional-shop-info">
                    <ul class="list-unstyled list-inline">
                        <li><i class="fa fa-phone"></i><span>0809153655</span></li>
                       
                    </ul>
                </div>
                <!-- END TOP BAR LEFT PART -->
                <!-- BEGIN TOP BAR MENU -->
                <div class="col-md-6 col-sm-6 additional-nav">
                    <ul class="list-unstyled list-inline pull-right">
                        <?php
                          if (!isset($_SESSION['LOGIN'])){
                          ?>
                          <li class="nav-item"><a class="nav-link" href="login.php"><i class="fa fa-user" aria-hidden="true"></i>เข้าสู่ระบบ</a></li>
                          <?php	
                            }else{
                          ?>
                          <li class="nav-item"><a class="nav-link" href="my-order.php">รายการสั่งซื้อ</a></li>
                          <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                            aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i><?php echo $_SESSION["cust_name"];?> </a>
                            <ul class="dropdown-menu">
                              <li class="nav-item"><a class="nav-link" href="my-profile.php">ข้อมูลของฉัน</a></li>
                              <li class="nav-item"><a class="nav-link" href="logout.php" onclick="return confirm('คุณต้องการออกจากระบบใช่ไหม?')">ออกจากระบบ</a></li>
                            </ul>
                          </li>
                          <?php	
                            }
                          ?>
                        
                    </ul>
                </div>
                <!-- END TOP BAR MENU -->
            </div>
        </div>        
    </div>
    <!-- END TOP BAR -->

<!-- BEGIN HEADER -->
<div class="header">
      <div class="container">
        <a class="site-logo" href="shop-index.php"><img src="assets/corporate/img/logos/9vmid30h-logo.jpg" alt="Metronic Shop UI" width="100" height="60"></a>

        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

        <!-- BEGIN CART -->
        <div class="top-cart-block">
          <div class="top-cart-info">

							

            <a href="javascript:void(0);" class="top-cart-info-count"><span  id="meQty" ><?php echo $meQty;?></span>  ชิ้น</a>
          </div>
          <i class="fa fa-shopping-cart"></i>
          <input id = "counting" type="hidden" value="<?echo $meQty;?>">
        
                      
          <div class="top-cart-content-wrapper">
            <div class="top-cart-content">
              <ul class="scroller" style="height: 250px;">
              <?php
                if($meQty>0){
                $total_price = 0;
                $num = 0;
                foreach ($_SESSION['cart'] as $itemId => $itemValue) {
                    
                        
                        $meSql = "SELECT * FROM products as p 
                        WHERE Products_ID = '$itemId'";
                        
                            $meQuery = mysqli_query($con,$meSql);
                            $meResult = mysqli_fetch_assoc($meQuery);
            ?>
                <li>
                  <a href="shop-item.html"><img src="../varitek-admin1/<?php echo $meResult['Products_Image'];?>" alt="Rolex Classic Watch" width="37" height="34"></a>
                  <span class="cart-content-count" id="meQty2" > <?php echo $itemValue;?></span>
                  <strong><a href="shop-item.html"><?php echo $meResult['Products_Name'];?></a></strong>
                  <em id ="price2"><?php echo number_format($meResult['Products_price'],2);?></em>
                  <a href="removecart.php?itemId=<?php echo $meResult['Products_ID']; ?>" onclick="return confirm('ต้องการลบสินค้าใช่หรือไม่?')" class="del-goods">&nbsp;</a>
                </li>
                <?php
                  }
                }
                ?>
              </ul>
              <div class="text-right">
                <a href="shop-shopping-cart.php" class="btn btn-default">View Cart</a>
              </div>
            </div>
          </div>            
        </div>
        <!--END CART -->
        <!-- BEGIN NAVIGATION -->
        <div class="header-navigation">
          <ul>
            <li><a href="shop-index.php">หน้าหลัก</a></li>
            <li><a href="shop-product-list.php">สินค้า</a></li>
            <li class="dropdown dropdown-megamenu">
              <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="shop-product-list.php">
                หมวดหมู่
                
              </a>
              <ul class="dropdown-menu">
                <li>
                  <div class="header-navigation-content">
                    <div class="row">
                     
                      <?php 
							$query_typeprd = "SELECT * FROM products_types   ORDER BY Types_ID ASC";
							$typeprd = mysqli_query($con, $query_typeprd) ;			
							while($row_typeprd = mysqli_fetch_assoc($typeprd)){
								$type= $row_typeprd['Types_Name'];
								$type_id= $row_typeprd['Types_ID'];

								$query_numprd = "SELECT SUBSTRING(Products_Code, 1, 16) AS 'prd_code'  FROM `products` as p 
								INNER JOIN products_categorys as c ON p.Categorys_ID = c.Categorys_ID
								INNER JOIN products_types as t ON c.Types_ID = t.Types_ID
								WHERE  t.Types_ID = '$type_id' AND Products_Status = 1 
								GROUP BY prd_code
								";
								$numprd = mysqli_query($con,$query_numprd) ;
								$row_numprd = mysqli_fetch_assoc($numprd);
								$number_type = mysqli_num_rows($numprd);
								
								if($number_type > 0) {
                                ?>
                         <div class="col-md-4 header-navigation-col">        
                        <h4><?php echo $row_typeprd['Types_Name']; ?></h4>
                        <ul>
                        <?php 
										$query_cateprd = "SELECT * FROM products_categorys  WHERE Types_ID = '$type_id' ORDER BY Categorys_ID ASC ";
										$cateprd = mysqli_query($con, $query_cateprd) ;		
												
										while($row_cateprd = mysqli_fetch_assoc($cateprd)){
											$cate_id = $row_cateprd['Categorys_ID'];

											$query_numcateprd =" SELECT SUBSTRING(Products_Code, 1, 16) AS 'prd_code'  FROM `products` as p 
											INNER JOIN products_categorys as c ON p.Categorys_ID = c.Categorys_ID
											WHERE  p.Categorys_ID = '$cate_id' AND  p.Products_Status =1 GROUP BY prd_code ";
											$numcateprd = mysqli_query($con,$query_numcateprd) ;
											$row_numcateprd = mysqli_fetch_assoc($numcateprd);
											$number_cate = mysqli_num_rows($numcateprd);

											$cname= $row_cateprd['Categorys_Name'];
											if($number_cate>0){
										?>
                          <li><a href="shop-product-list.php?cate=<?php echo $cate_id; ?>"><?php echo $row_cateprd['Categorys_Name']; ?></a></li>
                          <?php 
											}
									}
									?>
                        </ul>

                      </div>
                      <?php 
								}
							}
							?>
                      
                      
                    </div>
                  </div>
                </li>
              </ul>
            </li>
            <li><a href="shop-brands.php">แบรนด์</a></li>
            <li><a href="shop-contact-us.php">ติดต่อเรา</a></li>
            <li><a href="shop-news.php">ข่าวสาร</a></li>
            

            <!-- BEGIN TOP SEARCH -->
            <!-- <li class="menu-search">
              <span class="sep"></span>
              <i class="fa fa-search search-btn"></i>
              <div class="search-box">
                <form action="#">
                  <div class="input-group">
                    <input type="text" placeholder="Search" class="form-control">
                    <span class="input-group-btn">
                      <button class="btn btn-primary" type="submit">Search</button>
                    </span>
                  </div>
                </form>
              </div> 
            </li> -->
            <!-- END TOP SEARCH -->
          </ul>
        </div>
        <!-- END NAVIGATION -->
      </div>
    </div>
    <!-- Header END -->
