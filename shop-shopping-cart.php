

<!-- Body BEGIN -->
<body class="ecommerce">
     <?php 
      include("header.php");
      if (isset($_SESSION['cart'])){
        $meQty = 0;
        foreach ($_SESSION['cart'] as $k => $meItem){
    
                $meQty +=  $meItem ;
            
        }
    }else{
        $meQty = 0;
    }

    ?>

    <div class="main">
      <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->

          <div class="col-md-12 col-sm-12">
            <h1>Shopping cart</h1>
            <?php
                  if ($meQty == 0){
                    echo "<div class=\"alert alert-warning\">ไม่มีสินค้าอยู่ในตะกร้า</div>";
                }else{
               ?>
            <div class="goods-page">
              <div class="goods-data clearfix">
                <div class="table-wrapper-responsive">
              
                <table summary="Shopping cart">
                  <tr>
                    <th class="goods-page-image"></th>
                    <th class="goods-page-description">สินค้า</th>

                    <th class="goods-page-quantity">จำนวน</th>
                    <th class="goods-page-price">ราคา</th>
                    <th class="goods-page-total" colspan="2">ราคารวม</th>
                  </tr>
                  <?php
                            $total_price = 0;
                            $num = 0;
                            foreach ($_SESSION['cart'] as $itemId => $itemValue) {
                                
                             
                                    
                                    $meSql = "SELECT * FROM products as p WHERE Products_ID = '$itemId'";
                                    
                                     $meQuery = mysqli_query($con,$meSql);
                                     $meResult = mysqli_fetch_assoc($meQuery);
                                     $total_price = $total_price + ($meResult['Products_price'] * $itemValue);
                                     
                        ?>
                  <tr>
                    <input type="hidden" name="itemId" id ="itemId[<?php echo $num; ?>]" value="<?php echo $meResult['Products_ID'];?>">
                    <td class="goods-page-image">
                      <a href="javascript:;"><img src="../varitek-admin1/<?php echo $meResult['Products_Image'];?>" alt="Berry Lace Dress"></a>
                    </td>
                    <td class="goods-page-description">
                      <h3><a href="javascript:;"><?php echo $meResult['Products_Name'];?></a></h3>

                      <em>ดูเพิ่มเติม...</em>
                    </td>
                    <input type="hidden" name="price" id ="price[<?php echo $num; ?>]" value="<?php echo $meResult['Products_price']; ?>">
                    <td class="goods-page-quantity">
                      <div class="row">
                        <div class="col-md-1">
                        <button class= "form-control" onclick="
                                            var itemId = document.getElementById('itemId[<?php echo $num; ?>]').value;
                                            
                                            var result = document.getElementById('sst[<?php echo $num; ?>]'); 
                                            var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;
                                            var s = parseFloat(sst)-1;
                                            var price = document.getElementById('price[<?php echo $num; ?>]').value;
                                            var p =  parseFloat(price);
                                            var total = document.getElementById('totalprice[<?php echo $num; ?>]');
                                            var sum = s*p;   
                                            var qty = -1;
                                            var cnt = document.getElementById('counting').value;

                                            if(sum<=0){
                                                var r = confirm('ต้องการลบสินค้าใช่หรือไม่?');
                                                if(r == true){
                                                    get(itemId);
                                                }else{
                                                    window.location ='shop-shopping-cart.php';
                                                }
                                                
                                            }else{
                                                total.innerHTML = sum.toFixed(2).replace(/./g, function(c, i, a) {
                                                return i > 0 && c !== '.' && (a.length - i) % 3 === 0 ? ',' + c : c;
                                                });

                                                var int_cnt = parseInt(cnt)-1;
                                                document.getElementById('counting').value = int_cnt;
                                                document.getElementById('meQty').innerHTML=int_cnt;

                                               
                                                post(itemId,qty);
                                            }


                                            return false;" 
                                            class="reduced items-count" type="button">
                                        <
                                    </button>  
                        </div>
                        <div class="col-md-2">
                       
                        <input class= "form-control" type="text" name="qty[<?php echo $num; ?>]" id="sst[<?php echo $num; ?>]" value="<?php echo $itemValue; ?>" title="Quantity:"class="input-text qty" disabled>
                        <input type="hidden" name="arr_key_<?php echo $num; ?>" value="<?php echo $itemValue; ?>">
                        </div>
                        <div class="col-md-1">
                        <button class= "form-control" onclick="
                                            var result = document.getElementById('sst[<?php echo $num; ?>]'); 
                                            var sst = result.value; if( !isNaN( sst )) result.value++;
                                            var s = parseFloat(sst)+1;
                                            var price = document.getElementById('price[<?php echo $num; ?>]').value;
                                            var p =  parseFloat(price);
                                            var total = document.getElementById('totalprice[<?php echo $num; ?>]');
                                            var sum = s*p;        
                                            total.innerHTML = sum.toFixed(2).replace(/./g, function(c, i, a) {
                                                return i > 0 && c !== '.' && (a.length - i) % 3 === 0 ? ',' + c : c;
                                            });

                                            var em = document.getElementById('price2');
                                            em.innerHTML = sum.toFixed(2).replace(/./g, function(c, i, a) {
                                                return i > 0 && c !== '.' && (a.length - i) % 3 === 0 ? ',' + c : c;
                                            });

                                           

                                            var itemId = document.getElementById('itemId[<?php echo $num; ?>]').value;
                                           
                                            var qty = 1;
                                            var cnt = document.getElementById('counting').value;
                                            var int_cnt = parseInt(cnt)+1;

                                            //var ss = document.getElementById('subtotalinput').value;
                                            //var sb = parseFloat(ss);
                                            //var tt = ss+p;
                                            
                                           
                         

                                            document.getElementById('counting').value = int_cnt;
                                            document.getElementById('meQty2').innerHTML=int_cnt;
                                            document.getElementById('meQty').innerHTML=int_cnt;


                                            
                                            post(itemId,qty);
                                            
                                            return false;
                                            
                                            " 
                                            class="increase items-count" type="button">
                                            >
                                        </button>
                       
                        </div>
                          
                          
                       
                        </div>
                    </td>


                    <td class="goods-page-price">
                      <strong><?php echo number_format($meResult['Products_price'],2);?> <span>บาท</span></strong>
                      
                    </td>
                    <td class="goods-page-total">
                    <h4><strong id="totalprice[<?php echo $num; ?>]"> <?php echo number_format(($meResult['Products_price'] * $itemValue ),2); ?>
                                    <span> บาท</span></strong></h4>

                    </td>
                    <td class="del-goods-col">
                    <a href="removecart.php?itemId=<?php echo $meResult['Products_ID']; ?>" onclick="return confirm('ต้องการลบสินค้าใช่หรือไม่?')" class="del-goods">&nbsp;</a>
                    </td>
                  </tr>
                 <?php 
                $num ++;
                } ?>
                </table>
                
                </div>

                <!-- <div class="shopping-total">
                  <ul>
                    <li>
                      <em>Sub total</em>
                      <strong  id="subtotal"><?php //echo number_format($total_price,2);?><span> บาท</span></strong>
                      <input type="hidden" name="subtotalinput" value ="<?php// echo $total_price;?>"  >
                    
                    </li>
                    <li>
                      <em>ค่าขนส่ง</em>
                      <strong class="price"><?php// echo number_format(100,2);?><span> บาท</span></strong>
                    </li>
                    <li class="shopping-total-price">
                      <em>Total</em>
                      <strong class="price"><?php //echo number_format($total_price+100,2);?><span> บาท</span></strong>
                    </li>
                  </ul>
                </div> -->
              </div>
              <a href="shop-product-list.php"><button class="btn btn-default" type="submit">Continue shopping <i class="fa fa-shopping-cart"></i></button></a>
              <a href="chekout.php"><button class="btn btn-primary" type="submit">สั่งซื้อสินค้า <i class="fa fa-check"></i></button></a>
            </div>
            <?php } ?>
          </div>
         
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

        <!-- BEGIN SIMILAR PRODUCTS -->
        <!-- <div class="row margin-bottom-40">
          <div class="col-md-12 col-sm-12">
            <h2>Most popular products</h2>
            <div class="owl-carousel owl-carousel4">
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="assets/pages/img/products/k1.jpg" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="assets/pages/img/products/k1.jpg" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                  <div class="sticker sticker-new"></div>
                </div>
              </div>
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="assets/pages/img/products/k2.jpg" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="assets/pages/img/products/k2.jpg" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.html">Berry Lace Dress2</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                </div>
              </div>
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="assets/pages/img/products/k3.jpg" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="assets/pages/img/products/k3.jpg" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.html">Berry Lace Dress3</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                </div>
              </div>
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="assets/pages/img/products/k4.jpg" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="assets/pages/img/products/k4.jpg" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.html">Berry Lace Dress4</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                  <div class="sticker sticker-sale"></div>
                </div>
              </div>
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="assets/pages/img/products/k1.jpg" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="assets/pages/img/products/k1.jpg" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.html">Berry Lace Dress5</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                </div>
              </div>
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="assets/pages/img/products/k2.jpg" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="assets/pages/img/products/k2.jpg" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.html">Berry Lace Dress6</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                </div>
              </div>
            </div>
          </div>
        </div> -->
        <!-- END SIMILAR PRODUCTS -->
      </div>
    </div>

    <?php 
    include("footer.php");
    ?>
     <script>
        function post(itemId,option_d,qty){

            $.ajax({
            type: "POST",
            data: {itemId: itemId, qty: qty},
            url: "updatecart.php",
            success: function(){
                //the controller function count_votes returns an integer.
                //echo that with the fade in here.

                }
            });

        }

        function get(itemId,option_d){

            $.ajax({
            type: "GET",
            data: {itemId: itemId},
            url: "removecart.php",
            success: function(){
                window.location ='shop-shoping-cart.php';

                }
            });

            }
    </script>