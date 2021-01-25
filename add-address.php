
<?php

?>
<!-- Body BEGIN -->
<body class="ecommerce">
     <?php 
      include("header.php");

      $sql = "SELECT * FROM provinces";
      $query = mysqli_query($con, $sql);


      if(isset($_POST['rigist'])){
          $name = $_POST['name'];
          $phone = $_POST['phone'];
          $amphure_id = $_POST['amphure_id'];
          $district_id = $_POST['district_id'];
          $province_id = $_POST['province_id'];
          $postnum = $_POST['postnum'];
          $address = $_POST['address'];
          $custid = $_SESSION["cust"];

          $sql1 = "SELECT * FROM provinces WHERE id =  '$province_id'";
          $query1 = mysqli_query($con, $sql1);
          $result1 = mysqli_fetch_assoc($query1);

          $province = $result1['name_th'];

          $sql2 = "SELECT * FROM amphures WHERE id =  '$amphure_id'";
          $query2 = mysqli_query($con, $sql2);
          $result2 = mysqli_fetch_assoc($query2);

          $amphure = $result2['name_th'];

          $sql3 = "SELECT * FROM districts WHERE id =  '$district_id'";
          $query3 = mysqli_query($con, $sql3);
          $result3 = mysqli_fetch_assoc($query3);

          $district = $result3['name_th'];


          $sql_in = "INSERT INTO customers_address (ca_name,ca_phone,ca_province,ca_amphure,ca_district,ca_postnum,ca_address,Customer_ID)
          VALUES ('$name','$phone','$province','$amphure','$district','$postnum','$address','$custid') ;";
          $query_in = mysqli_query($con, $sql_in);


          if($query_in == TRUE) {
            echo "<script language='javascript'> alert('เพิ่มที่อยู่สำเร็จ');window.location='my-profile.php';</script>";
            }else{
              echo   "<script language='javascript'> alert('มีปัญหาการในการเพิ่มที่อยู่กรุณาตรวจสอบอีกครั้ง!'); </script>";
            }
    
      }





      
    ?>
    
    <div class="main">
      <div class="container">
        <div class="row margin-bottom-40">
            <!-- BEGIN CONTENT -->

            <div class="col-md-12 col-sm-12">
              <h1>เพิ่มที่อยู่ใหม่</h1>
              <div class="goods-page">
                <div class="goods-data clearfix">
                 <!-- BEGIN PAYMENT ADDRESS -->
         <div id="payment-address" class="panel panel-default">
            <form action="" method="post">
                <div id="payment-address-content" class="">
                  <div class="panel-body row">
                    <div class="col-md-6 col-sm-6">

                      
                      <div class="form-group">
                        <label for="firstname">ชื่อ - สกุล <span class="require">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" required= "required">
                      </div>

                      <div class="form-group">
                        <label for="phone">เบอร์โทร<span class="require">*</span></label>
                        <input type="text" id="phone" name ="phone"  class="form-control"  required= "required"> 
                      </div>  

                      <div class="form-group">
                        <label for="province">จังหวัด<span class="require">*</span></label>
                        <select name="province_id" id="province" class="form-control"  required= "required" >
                            <option value="">เลือกจังหวัด</option>
                            <?php while($result = mysqli_fetch_assoc($query)): ?>
                                <option value="<?php echo $result['id'];?>"><?php echo $result['name_th'];?></option>
                            <?php endwhile; ?>
                        </select>
                      </div>  

                      <div class="form-group">
                        <label for="telephone">อำเภอ/เขต<span class="require">*</span></label>
                        <select name="amphure_id" id="amphure" class="form-control"  required= "required">
                            <option value="">เลือกอำเภอ/เขต</option>
                        </select>
                      </div>  
                      <div class="form-group">
                        <label for="telephone">ตำบล/แขวง<span class="require">*</span></label>
                        <select name="district_id" id="district" class="form-control"  required= "required">
                            <option value="">เลือกตำบล/แขวง</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="postnum">รหัสไปรษณีย์<span class="require">*</span></label>
                        <input type="text" id="postnum" name ="postnum"  class="form-control"  required= "required"> 
                      </div> 
                      <div class="form-group">
                        <label for="address">รายละเอียดที่อยู่<span class="require">*</span></label>
                        <textarea class="form-control" name="address" id="address" cols="30" rows="10" required= "required"></textarea>
                      </div> 
                    </div>
                    
                  
                    <div class="col-md-12">                      
                      
                      <button class="btn btn-primary  pull-left" type="submit" name="rigist">ยืนยัน</button>
                                            
                    </div>
                  </div>
                </div>
                </form>
              </div>
              <!-- END PAYMENT ADDRESS -->
                </div> 
              </div> 
            </div>
          </div>   
      </div>
    </div>

    <?php 
    include("footer.php");
    ?>
    <script src="assets/plugins/script-th.js"></script>