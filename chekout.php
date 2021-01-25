

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
        <div class="row margin-bottom-40">
            <!-- BEGIN CONTENT -->

            <div class="col-md-12 col-sm-12">
              <h1>รายการซื้อของฉัน</h1>
              <form action="saveorder.php" method="post">
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
                    <td class="goods-page-image">
                      <a href="javascript:;"><img src="../varitek-admin1/<?php echo $meResult['Products_Image'];?>" alt="Berry Lace Dress"></a>
                    </td>
                    <td class="goods-page-description">
                      <h3><a href="javascript:;"><?php echo $meResult['Products_Name'];?></a></h3>

                    </td>
                    
                    <td class="quantity">
                      <div class="quantity">
                          <?php echo $itemValue; ?>
                      </div>
                    </td>
                    <td class="goods-page-price">
                      <strong><?php echo number_format($meResult['Products_price'],2);?> <span>บาท</span></strong>
                    </td>
                    <td class="goods-page-total">
                      <strong><?php echo number_format(($meResult['Products_price']*$itemValue),2);?>  <span>บาท</span></strong>
                    </td>
                    <td class="del-goods-col">
                    <a href="removecart.php?itemId=<?php echo $meResult['Products_ID']; ?>" onclick="return confirm('ต้องการลบสินค้าใช่หรือไม่?')" class="del-goods">&nbsp;</a>
                    </td>
                  </tr>
                 <?php 
                $num ++;
                } ?>
                </table>
                <br>
               
                <h2>ที่อยู่จัดส่งสินค้า</h2> 
                <div class="form-check">
                <?php
                      
                      $cust = $_SESSION['cust'];
                      $sql	= "SELECT * FROM customers_address WHERE Customer_ID= '$cust' ORDER BY ca_ID ASC  ";
                      $query = mysqli_query($con, $sql);
                      while ($row = mysqli_fetch_assoc($query)) {
                      ?>
                      <hr>
                      <div class="row">
                      
                        <div class="col-md-1">
                            <input class="form-check-input" type="radio" name="radio_address" id="radio<?php echo $row['ca_ID'];?>" value="<?php echo $row['ca_ID'];?>">
                        </div>
                        <div class="col-md-10">
                        <label for="radio<?php echo $row['ca_ID'];?>">
                          <div class="form-group-row">
                            <label for="">ชื่อ - สกุล  : </label>
                            
                              <?php echo $row['ca_name'];?>
                           
                          </div>
                          <div class="form-group-row">
                            <label for="">เบอร์โทรศัพท์  : </label>
                           
                            <?php echo $row['ca_phone'];?>
                          
                          </div>
                          <div class="form-group-row">
                            <label for="">ที่อยู่  : </label>
                          
                            <?php 
                              echo $row['ca_address']."</br>";
                              echo $row['ca_amphure']." ".$row['ca_district']."</br>";
                              echo $row['ca_province']." ".$row['ca_postnum']."</br>";
                            
                            ?>
                           
                          </div>
                          </label>
                        </div>
                       
                       
                      </div>
                      <?php
                      }
                      ?>
                </div>
                </div>

                <div class="shopping-total">
                  <ul>
                    <li>
                      <em>Sub total</em>
                      <strong class="price"><?php echo number_format($total_price,2);?><span> บาท</span></strong>
                    </li>
                    <li>
                      <em>ค่าขนส่ง</em>
                      <strong class="price"><?php echo number_format(100,2);?><span> บาท</span></strong>
                    </li>
                    <li class="shopping-total-price">
                      <em>Total</em>
                      <strong class="price"><?php echo number_format($total_price+100,2);?><span> บาท</span></strong>
                    </li>
                  </ul>
                </div>
                
              </div>
              <div>
              <a href="shop-product-list.php"><button class="btn btn-default" type="submit">Continue shopping <i class="fa fa-shopping-cart"></i></button></a>
              <button class="btn btn-primary" type="submit">ยืนยันสั่งซื้อสินค้า <i class="fa fa-check"></i></button>
              </div>
            
              </form>
            </div>
                </div> 
              </div> 
            </div>
          </div>   
      </div>
    </div>

    <?php 
    include("footer.php");
    ?>