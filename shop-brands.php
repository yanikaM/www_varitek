

<!-- Body BEGIN -->
<body class="ecommerce">
     <?php 
      include("header.php");

    ?>
    
    <div class="main">
      <div class="container">
        <div class="row margin-bottom-40">
            <!-- BEGIN CONTENT -->

            <div class="col-md-12 col-sm-12">
              <h1>แบรนด์</h1>
              <div class="sidebar col-md-3 col-sm-5">
            <ul class="list-group margin-bottom-25 sidebar-menu">
         
							<li class="list-group-item clearfix dropdown <?php if(!isset($_GET["brand"])){echo "active" ;} ?>" ><a  href="shop-brands.php"  aria-controls="ทั้งหมด"> <i class="fa fa-angle-right"></i> ทั้งหมด<span class="number"></span></a>
							</li>		
							<?php 
							$query_typeprd = "SELECT * FROM brand  ORDER BY brand_ID ASC";
							$typeprd = mysqli_query($con, $query_typeprd) ;			
							while($row_typeprd = mysqli_fetch_assoc($typeprd)){


                                ?>
                                
								<li class="list-group-item clearfix dropdown <?php if(isset($_GET["brand"]) && $_GET["brand"]==$row_typeprd['brand_ID']){echo "active" ;} ?>" ><i class="fa fa-angle-right"></i> <a href="shop-brands.php?brand=<?php echo $row_typeprd['brand_ID'];?>"><?php echo $row_typeprd['brand_name']; ?></a>

                            </li>
                            <?php 
											
									}
									?>
						
            </ul>

           

            
          </div>
            <!-- BEGIN CONTENT -->
            <div class="col-md-9 col-sm-7">          
                <!-- BEGIN PRODUCT LIST -->
                <div class="row product-list">
                    <?php
                    if(isset($_GET['brand'])){
                        $brandname= $_GET['brand'];
                        $query_prd = "SELECT * FROM products as p 
                        INNER JOIN brand as b ON b.brand_ID=p.brand_ID 
                        WHERE 1 AND b.brand_ID = '$brandname' ";
                        
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
                      }else{
                     ?>
                    <?php
                      
                     $query_prd = "SELECT * FROM `brand` WHERE 1 ";
                     
                     
                     
                      $query_prd .= " ORDER BY brand_ID  ASC ";
                      $query_prd2 = mysqli_query($con, $query_prd);
                      while ($row_prd2 = mysqli_fetch_assoc($query_prd2)) { 
                    ?>
                    

                    <div class="col-md-4 col-sm-6 col-xs-12">


                        <div class="product-item">
                            <a href="shop-brands.php?brand=<?php echo $row_prd2['brand_ID'];?>">
                        <img src="../varitek-admin1/<?php echo $row_prd2['brand_img'];?>" class="img-responsive" alt="">
                        </a>
                    </div>
                    </div>
                    
                    <?php
                      }
                    }
                      
                    ?>

                </div>
            </div>   
          


            </div>
          </div>   
      </div>
    </div>

    <?php 
    include("footer.php");
    ?>