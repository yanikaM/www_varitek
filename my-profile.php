

<!-- Body BEGIN -->
<body class="ecommerce">
     <?php 
      include("header.php");

    ?>
    
    <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li class="active">ข้อมูลของฉัน</li>
        </ul>
         <!-- BEGIN PAYMENT ADDRESS -->
         <div id="payment-address" class="panel panel-default">

                <div id="payment-address-content" class="">
                  <div class="panel-body row">
                    <div class="col-md-6 col-sm-6">
                      <h3>รายละเอียดข้อมูลส่วนตัว</h3>
                      
                      <div class="form-group">
                        <label for="firstname">ชื่อ - สกุล</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?php echo $_SESSION["cust_name"];?>" disabled>
                      </div>
                      <div class="form-group">
                        <label for="email">อีเมล</label>
                        <input type="text" id="email" name ="email" class="form-control" value="<?php echo $_SESSION["cust_email"];?>" disabled>
                      </div>
                      <div class="form-group">
                        <label for="telephone">เบอร์โทร</label>
                        <input type="text" id="phone" name ="phone"  class="form-control" value="<?php echo $_SESSION["cust_phone"];?>" disabled>
                      </div>
                    
                    <hr>
                    <div class="col-md-12">                      
                      
                      <a href="profile-edit.php"> <button class="btn btn-primary  pull-left" type="" name="rigist">แก้ไขข้อมูลส่วนตัว</button></a>
                     
                    </div>
                  </div>
                </div>
              </div>
              <!-- END PAYMENT ADDRESS -->

      </div>


      <div id="payment-address" class="panel panel-default">
           
                <div id="payment-address-content" class="">
                  <div class="panel-body row">
                    <div class="col-md-12 col-sm-12">
                      <h3>ที่อยู่จัดส่งสินค้า</h3>
                      <?php
                      
                      $cust = $_SESSION['cust'];
                      $sql	= "SELECT * FROM customers_address WHERE Customer_ID= '$cust' ORDER BY ca_ID ASC  ";
                      $query = mysqli_query($con, $sql);
                      while ($row = mysqli_fetch_assoc($query)) {
                      ?>
                      <hr>
                      <div class="row">
                        <div class="col-md-8">
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
                        </div>
                        <div class="col-md-4">

                  <a class="btn btn-danger btn-sm" href="delete.php?p_ID=<?php echo $prd ; ?> " onclick="return confirm('ยืนยันการลบ')"> Delete</a>
                        </div>
                      </div>
                      <?php
                      }
                      ?>



                      <hr>
                      <a href="add-address.php"> <button class="btn btn-primary  pull-left" type="" name="rigist">เพิ่มที่อยู่จัดส่งสินค้า</button></a>
                     
                    
                  
                    <div class="col-md-12">                      
                      
                      
                     
                    </div>
                  </div>
                </div>
              </div>
              <!-- END PAYMENT ADDRESS -->
        
      </div>
    </div>

    <?php 
    include("footer.php");
    ?>