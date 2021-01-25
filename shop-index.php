
    <?php 
    include("header.php");
  //echo '<pre>' . print_r($_SESSION['cart']). '</pre>' ?>.
    

        

    
        

    <!-- BEGIN SLIDER -->
    <div class="page-slider margin-bottom-35">
        <div id="carousel-example-generic" class="carousel slide carousel-slider">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <!-- First slide -->
                <div class="item carousel-item-four active">
                   
                </div>
                
                <!-- Second slide -->
                <div class="item carousel-item-five">
                    
                </div>

                
            </div>

            <!-- Controls -->
            <a class="left carousel-control carousel-control-shop" href="#carousel-example-generic" role="button" data-slide="prev">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
            </a>
            <a class="right carousel-control carousel-control-shop" href="#carousel-example-generic" role="button" data-slide="next">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    <!-- END SLIDER -->

    <div class="main">
      <div class="container">
        <!-- BEGIN SALE PRODUCT & NEW ARRIVALS -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SALE PRODUCT -->
          <div class="col-md-12 sale-product">
            <h2>New Arrivals</h2>
            <div class="owl-carousel owl-carousel5">
            <?php
                $sql_prd2= "SELECT * FROM `products` as p 
                INNER JOIN products_categorys as c ON p.Categorys_ID=c.Categorys_ID WHERE Products_Status = '1' ORDER BY p.LastUpdate DESC Limit 5 ";
                $query_prd2 = mysqli_query($con, $sql_prd2);
                while ($row_prd2 = mysqli_fetch_assoc($query_prd2)) { 
            ?>
            <!-- เริ่ม -->
            <form action="updatecart.php" method="post">
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <input type="hidden" name="itemId" id="itemId" value="<?php echo $row_prd2['Products_ID'];?>">
                    <input type="hidden" name="qty" id="qty" value="1">
                    <img src="../varitek-admin1/<?php echo $row_prd2['Products_Image'];?>" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="../varitek-admin1/<?php echo $row_prd2['Products_Image'];?>" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="shop-item.php?prd=<?php echo $row_prd2['Products_ID'];?>" class="btn btn-default fancybox-fast-view view_data">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.html"><?php echo $row_prd2['Products_Name'];?></a></h3>
                  <div class="pi-price"><?php echo number_format($row_prd2['Products_price'],2);?> บาท</div>
                  
                  <button class="btn btn-default add2cart" type="submit"><i class="fa fa-shopping-cart"></i></button>
                  <!-- <div class="sticker sticker-sale"></div> ป้ายเซลล์-->
                </div>
              </div>
              </form>
              <?php
              }
              ?>
              
              <!-- สิ้นสุด -->  
              
            </div>
          </div>
          <!-- END SALE PRODUCT -->
            
        </div>
        <!-- END SALE PRODUCT & NEW ARRIVALS -->
        <div class="row margin-bottom-40">
          <div class="col-md-12 shop-news">    
            <h2>Latest News</h2>
            <div class="owl-carousel owl-carousel3">
            <?php
                $sql_n= "SELECT * FROM `news`  ORDER BY LastUpdate DESC Limit 3 ";
                $query_n = mysqli_query($con, $sql_n);
                while ($row_n = mysqli_fetch_assoc($query_n)) { 
            ?>
              <div>
                <a href="shop-news.php?news=<?php echo $row_n['News_ID']; ?>">
                <img src="../varitek-admin1/<?php echo $row_n['news_photo'];?>" class="img-responsive" alt="">
                </a>
              </div> 
              <?php } ?>
            </div>  
          </div>  
        </div> 

        

        
    </div>

    <?php 
    include("footer.php");
    ?>