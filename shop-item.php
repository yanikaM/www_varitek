
 <?php 
      include("header.php");

    ?>
    
<!-- Body BEGIN -->
<body class="ecommerce">

    
    <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="">Store</a></li>
            <li class="active">Name</li>
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
							<li class="list-group-item clearfix dropdown" <?php if(!isset($_GET["cate"])){echo "active" ;} ?>><a  href="shop-product-list.php"  aria-controls="ทั้งหมด"> <i class="fa fa-angle-right"></i> ทั้งหมด<span class="number">(<?php echo $number_all; ?>)</span></a>
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
          <?php 
            $getname = $_GET['prd'];
            $query_sprd = "SELECT *,SUBSTRING(p.Products_Code, 1, 16) AS 'prd_code' FROM products as p 
            INNER JOIN products_categorys as c
            ON p.Categorys_ID=c.Categorys_ID 
            WHERE p.Products_ID = '$getname' 
            GROUP BY prd_code ";

            $sprd = mysqli_query($con, $query_sprd) ;			
            $row_sprd = mysqli_fetch_assoc($sprd);
            $id = $row_sprd['Products_ID'];
            $code = $row_sprd['prd_code'];
            $name = $row_sprd['Products_Name'];
            $price = $row_sprd['Products_price'];
            ?>

          <!-- BEGIN CONTENT -->
          <form action="updatecart.php" method="post">
          <div class="col-md-9 col-sm-7">
            <div class="product-page">
              <div class="row">
                <div class="col-md-6 col-sm-6">
                <input type="hidden" name="itemId" id="itemId" value="<?php echo $row_sprd['Products_ID'];?>">
                <input type="hidden" name="sp" id="sp" value="sp">
                  <div class="product-main-image">
                    <img src="../varitek-admin1/<?php echo $row_sprd['Products_Image'];?>" alt="Cool green dress with red bell" class="img-responsive" data-BigImgsrc="../varitek-admin1/<?php echo $row_sprd['Products_Image'];?>">
                  </div>
                  <div class="product-other-images">
                    <a href="../varitek-admin1/<?php echo $row_sprd['Products_Image'];?>" class="fancybox-button" rel="photos-lib"><img alt="Berry Lace Dress" src="../varitek-admin1/<?php echo $row_sprd['Products_Image'];?>"></a>
                    <a href="../varitek-admin1/<?php echo $row_sprd['Products_Image'];?>" class="fancybox-button" rel="photos-lib"><img alt="Berry Lace Dress" src="../varitek-admin1/<?php echo $row_sprd['Products_Image'];?>"></a>
                    <a href="../varitek-admin1/<?php echo $row_sprd['Products_Image'];?>" class="fancybox-button" rel="photos-lib"><img alt="Berry Lace Dress" src="../varitek-admin1/<?php echo $row_sprd['Products_Image'];?>"></a>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <h1><?php echo $name;?></h1>
                  <div class="price-availability-block clearfix">
                    <div class="price">
                      <strong><?php echo number_format($price,2);?> <span>บาท</span></strong>
                      <!-- <em>$<span>62.00</span></em> -->
                    </div>
                    <div class="availability">
                      Availability: <strong>In Stock</strong>
                    </div>
                  </div>
                  <div class="description">
                    <p><?php echo $row_sprd['Products_Description'];?></p>
                  </div>
                  <!-- <div class="product-page-options">
                    <div class="pull-left">
                      <label class="control-label">Size:</label>
                      <select class="form-control input-sm">
                        <option>L</option>
                        <option>M</option>
                        <option>XL</option>
                      </select>
                    </div>
                    <div class="pull-left">
                      <label class="control-label">Color:</label>
                      <select class="form-control input-sm">
                        <option>Red</option>
                        <option>Blue</option>
                        <option>Black</option>
                      </select>
                    </div>
                  </div> -->
                  <div class="product-page-cart">
                    <div class="product-quantity">
                        <input id="qty" name="qty" type="text" value="1" readonly class="form-control input-sm">
                    </div>
                    <button class="btn btn-primary" type="submit">Add to cart</button>
                  </div>
                  <!-- <div class="review">
                    <input type="range" value="4" step="0.25" id="backing4">
                    <div class="rateit" data-rateit-backingfld="#backing4" data-rateit-resetable="false"  data-rateit-ispreset="true" data-rateit-min="0" data-rateit-max="5">
                    </div>
                    <a href="javascript:;">7 reviews</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:;">Write a review</a>
                  </div> -->
                  <!-- <ul class="social-icons">
                    <li><a class="facebook" data-original-title="facebook" href="javascript:;"></a></li>
                    <li><a class="twitter" data-original-title="twitter" href="javascript:;"></a></li>
                    <li><a class="googleplus" data-original-title="googleplus" href="javascript:;"></a></li>
                    <li><a class="evernote" data-original-title="evernote" href="javascript:;"></a></li>
                    <li><a class="tumblr" data-original-title="tumblr" href="javascript:;"></a></li>
                  </ul> -->
                </div>

                <!-- <div class="product-page-content">
                  <ul id="myTab" class="nav nav-tabs">
                    <li><a href="#Description" data-toggle="tab">Description</a></li>
                    <li><a href="#Information" data-toggle="tab">Information</a></li>
                    <li class="active"><a href="#Reviews" data-toggle="tab">Reviews (2)</a></li>
                  </ul>
                  <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade" id="Description">
                      <p>Lorem ipsum dolor ut sit ame dolore  adipiscing elit, sed sit nonumy nibh sed euismod laoreet dolore magna aliquarm erat sit volutpat Nostrud duis molestie at dolore. Lorem ipsum dolor ut sit ame dolore  adipiscing elit, sed sit nonumy nibh sed euismod laoreet dolore magna aliquarm erat sit volutpat Nostrud duis molestie at dolore. Lorem ipsum dolor ut sit ame dolore  adipiscing elit, sed sit nonumy nibh sed euismod laoreet dolore magna aliquarm erat sit volutpat Nostrud duis molestie at dolore. </p>
                    </div>
                    <div class="tab-pane fade" id="Information">
                      <table class="datasheet">
                        <tr>
                          <th colspan="2">Additional features</th>
                        </tr>
                        <tr>
                          <td class="datasheet-features-type">Value 1</td>
                          <td>21 cm</td>
                        </tr>
                        <tr>
                          <td class="datasheet-features-type">Value 2</td>
                          <td>700 gr.</td>
                        </tr>
                        <tr>
                          <td class="datasheet-features-type">Value 3</td>
                          <td>10 person</td>
                        </tr>
                        <tr>
                          <td class="datasheet-features-type">Value 4</td>
                          <td>14 cm</td>
                        </tr>
                        <tr>
                          <td class="datasheet-features-type">Value 5</td>
                          <td>plastic</td>
                        </tr>
                      </table>
                    </div>
                    <div class="tab-pane fade in active" id="Reviews">
                      
                      <div class="review-item clearfix">
                        <div class="review-item-submitted">
                          <strong>Bob</strong>
                          <em>30/12/2013 - 07:37</em>
                          <div class="rateit" data-rateit-value="5" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                        </div>                                              
                        <div class="review-item-content">
                            <p>Sed velit quam, auctor id semper a, hendrerit eget justo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Duis vel arcu pulvinar dolor tempus feugiat id in orci. Phasellus sed erat leo. Donec luctus, justo eget ultricies tristique, enim mauris bibendum orci, a sodales lectus purus ut lorem.</p>
                        </div>
                      </div>
                      <div class="review-item clearfix">
                        <div class="review-item-submitted">
                          <strong>Mary</strong>
                          <em>13/12/2013 - 17:49</em>
                          <div class="rateit" data-rateit-value="2.5" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                        </div>                                              
                        <div class="review-item-content">
                            <p>Sed velit quam, auctor id semper a, hendrerit eget justo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Duis vel arcu pulvinar dolor tempus feugiat id in orci. Phasellus sed erat leo. Donec luctus, justo eget ultricies tristique, enim mauris bibendum orci, a sodales lectus purus ut lorem.</p>
                        </div>
                      </div>

                      
                      <form action="#" class="reviews-form" role="form">
                        <h2>Write a review</h2>
                        <div class="form-group">
                          <label for="name">Name <span class="require">*</span></label>
                          <input type="text" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="text" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                          <label for="review">Review <span class="require">*</span></label>
                          <textarea class="form-control" rows="8" id="review"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="email">Rating</label>
                          <input type="range" value="4" step="0.25" id="backing5">
                          <div class="rateit" data-rateit-backingfld="#backing5" data-rateit-resetable="false"  data-rateit-ispreset="true" data-rateit-min="0" data-rateit-max="5">
                          </div>
                        </div>
                        <div class="padding-top-20">                  
                          <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                      </form>
                       
                    </div>
                  </div>
                </div> -->

                <div class="sticker sticker-new"></div>
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        </form>
        <!-- END SIDEBAR & CONTENT -->

        <!-- BEGIN SIMILAR PRODUCTS -->
        <div class="row margin-bottom-40">
          <div class="col-md-12 col-sm-12">
            <h2>Most popular products</h2>
            <div class="owl-carousel owl-carousel4">
            <?php 
              
              $query = "
                  SELECT Products_price,p.Products_ID,p.Products_Name, SUM(d.Products_Qty*p.Products_price) AS total ,p.Products_Image
                  FROM orders_detail as d
                  INNER JOIN products as p ON p.Products_ID=d.Products_ID
                  GROUP BY d.Products_ID ORDER BY  total DESC LIMIT 4 
                  ";
                  $result = mysqli_query($con, $query);
                  while($row = mysqli_fetch_array($result)) {
                                ?>
                <form action="updatecart.php" method="post">
                <input type="hidden" name="itemId" id="itemId" value="<?php echo $row['Products_ID'];?>">
               <input type="hidden" name="qty" id="qty" value="1">
                <div>
                  <div class="product-item">
                    <div class="pi-img-wrapper">
                      <img src="../varitek-admin1/<?php echo $row['Products_Image'];?>" class="img-responsive" alt="<?php echo $row['Products_Name'];?>">
                      <div>
                        <a href="../varitek-admin1/<?php echo $row['Products_Image'];?>" class="btn btn-default fancybox-button">Zoom</a>
                        <a href="shop-item.php?prd=<?php echo $row['Products_ID'];?>" class="btn btn-default fancybox-fast-view">View</a>
                      </div>
                    </div>
                    <h3><a href="shop-item.php?prd=<?php echo $row['Products_ID'];?>"><?php echo $row['Products_Name'];?></a></h3>
                    <div class="pi-price"><?php echo number_format($row['Products_price'],2);?> บาท</div>
                    <button class="btn btn-default add2cart" type="submit">Add to cart</button>
                   
                  </div>
                </div>
              </form>
              
              <?php
              }
              ?>
             
            </div>
          </div>
        </div>
        <!-- END SIMILAR PRODUCTS -->
      </div>
    </div>

    <?php 
    include("footer.php");
    ?>