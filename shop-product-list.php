
<?php 
include("connect/conn.php");

?>

<!-- Body BEGIN -->
<body class="ecommerce">
    <?php 
      include("header.php");
      
        $start = (isset($_GET['start']) ? intval($_GET['start']) : 0);
        if ($start < 0) {
          $start = 0;
        }

        $limit = 9;// แสดงหน้าละ 9 รายการ
        $offset = $start;	
     ?>

    <!-- <div class="title-wrapper">
      <div class="container"><div class="container-inner">
        <h1><span>MEN</span> CATEGORY</h1>
        <em>Over 4000 Items are available here</em>
      </div></div>
    </div> -->

    <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li class="active"><a href="">Store</a></li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-5">
            <ul class="list-group margin-bottom-25 sidebar-menu">
            
              <?php
							$query_numall= "SELECT SUBSTRING(Products_Code, 1, 16) AS 'prd_code'  FROM `products` as p  
							 INNER JOIN products_categorys as c ON p.Categorys_ID = c.Categorys_ID
							 WHERE Products_Status =1  GROUP BY prd_code ";
							$numall = mysqli_query($con,$query_numall) ;
							$row_numall = mysqli_fetch_assoc($numall);
							$number_all = mysqli_num_rows($numall);
							
							?>
							<li class="list-group-item clearfix dropdown <?php if(!isset($_GET["cate"])){echo "active" ;} ?>" ><a  href="shop-product-list.php"  aria-controls="ทั้งหมด"> <i class="fa fa-angle-right"></i> ทั้งหมด<span class="number">(<?php echo $number_all; ?>)</span></a>
							</li>		
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
								<li class="list-group-item clearfix dropdown" ><i class="fa fa-angle-right"></i> <?php echo $row_typeprd['Types_Name']; ?><span class="number">(<?php echo $number_type; ?>)</span>
                  <ul class="dropdown-menu" style="display:block;">
        
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
											<li class="list-group-item dropdown clearfix  <?php if(isset($_GET["cate"]) && $_GET["cate"]== $row_cateprd['Categorys_ID']) { echo "active"; }?>"><a href="?cate=<?php echo $cate_id; ?>"><i class="fa fa-angle-right"></i> <?php echo $row_cateprd['Categorys_Name']; ?><span class="number">(<?php echo $number_cate; ?>)</span></a></li>
									<?php 
											}
									}
									?>
								</ul>
							</li>
							<?php 
								}
							}
							?>
            </ul>

           

            <!-- <div class="sidebar-products clearfix">
              <h2>Bestsellers</h2>
              <div class="item">
                <a href="shop-item.html"><img src="assets/pages/img/products/k1.jpg" alt="Some Shoes in Animal with Cut Out"></a>
                <h3><a href="shop-item.html">Some Shoes in Animal with Cut Out</a></h3>
                <div class="price">$31.00</div>
              </div>
              <div class="item">
                <a href="shop-item.html"><img src="assets/pages/img/products/k4.jpg" alt="Some Shoes in Animal with Cut Out"></a>
                <h3><a href="shop-item.html">Some Shoes in Animal with Cut Out</a></h3>
                <div class="price">$23.00</div>
              </div>
              <div class="item">
                <a href="shop-item.html"><img src="assets/pages/img/products/k3.jpg" alt="Some Shoes in Animal with Cut Out"></a>
                <h3><a href="shop-item.html">Some Shoes in Animal with Cut Out</a></h3>
                <div class="price">$86.00</div>
              </div>
            </div> -->
          </div>
          <!-- END SIDEBAR -->
          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-7">
            
            <!-- BEGIN PRODUCT LIST -->
            <div class="row product-list">
              <!-- PRODUCT ITEM START -->
              <?php
               $query_prd = "SELECT *,Products_Code,SUBSTRING(p.Products_Code, 1, 16) AS 'prd_code' FROM products as p 
               INNER JOIN products_categorys as c ON p.Categorys_ID=c.Categorys_ID 
               WHERE 1 AND  Products_Status =1 
               
               
               ";
               if(isset($_GET['cate'])){
                 $catename= $_GET['cate'];
                 $query_prd .= " AND c.Categorys_ID = '$catename' ";
               }
                   
               $cnt_page = mysqli_query($con, $query_prd) ;
               $number_prd  = mysqli_num_rows($cnt_page);
               $total_records= $number_prd ;	
 
               $query_prd .= " GROUP BY prd_code ORDER BY p.products_ID ASC LIMIT ".$limit." OFFSET ".$offset;
               //echo $query_prd;
                $query_prd2 = mysqli_query($con, $query_prd);
                while ($row_prd2 = mysqli_fetch_assoc($query_prd2)) { 
            ?>
            <form action="updatecart.php" method="post">
              <div class="col-md-4 col-sm-6 col-xs-12">
              <input type="hidden" name="itemId" id="itemId" value="<?php echo $row_prd2['Products_ID'];?>">
               <input type="hidden" name="qty" id="qty" value="1">
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="../varitek-admin1/<?php echo $row_prd2['Products_Image'];?>" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="../varitek-admin1/<?php echo $row_prd2['Products_Image'];?>" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="shop-item.php?prd=<?php echo $row_prd2['Products_ID'];?>" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.html"><?php echo $row_prd2['Products_Name'];?></a></h3>
                  <div class="pi-price"><?php echo number_format($row_prd2['Products_price'],2);?> บาท</div>
                  <button class="btn btn-default add2cart" type="submit">Add to cart</button>

                </div>
              </div>
            </form>
              <?php
              }
              ?>    

              <!-- PRODUCT ITEM END -->
              
            </div>
            <!-- END PRODUCT LIST -->
            <!-- BEGIN PAGINATOR -->
            <!-- <div class="row">
              <div class="col-md-4 col-sm-4 items-info">Items 1 to 9 of 10 total</div>
              <div class="col-md-8 col-sm-8">
                <ul class="pagination pull-right">
                  <li><a href="javascript:;">&laquo;</a></li>
                  <li><a href="javascript:;">1</a></li>
                  <li><span>2</span></li>
                  <li><a href="javascript:;">3</a></li>
                  <li><a href="javascript:;">4</a></li>
                  <li><a href="javascript:;">5</a></li>
                  <li><a href="javascript:;">&raquo;</a></li>
                </ul>
              </div>
            </div> -->
            <!-- END PAGINATOR -->
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
    </div>
    
    <?php 
    include("footer.php");
    ?>