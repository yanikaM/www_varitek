
<!-- Body BEGIN -->
<body class="ecommerce">
     <?php 
      include("header.php");
      if($_POST['submit']=="บันทึก"){
          $name = $_POST['name'];
          $email = $_POST['email'];
          $phone = $_POST['phone'];
          $cust = $_SESSION["cust"];

          $txt = " UPDATE customers SET Customer_Name = '$name',Customer_Email= '$email',Customer_Phone='$phone' WHERE Customer_ID = '$cust' ";
          $add_Query = mysqli_query($con,$txt);
          if($add_Query == TRUE) {

			$_SESSION["cust_name"] =  $name;
			$_SESSION["cust_email"] = $email;
			$_SESSION["cust_phone"] = $phone;

            echo "<script language='javascript'> alert('แก้ไขข้อมูลเรียบร้อย');window.location='my-profile.php';</script>";
            }else{
              echo "<script language='javascript'> alert('error');</script>";;
            }

      }

    ?>
    
    <div class="main">
      <div class="container">
        <div class="row margin-bottom-40">
            <!-- BEGIN CONTENT -->

            <div class="col-md-12 col-sm-12">
              <h1>แก้ไขข้อมูลส่วนตัว</h1>
              <div class="goods-page">
                <div class="goods-data clearfix">
                <form action="" method="post">
                <div id="payment-address-content" class="">
                  <div class="panel-body row">
                    <div class="col-md-6 col-sm-6">
                      <h3>รายละเอียดข้อมูลส่วนตัว</h3>
                      
                      <div class="form-group">
                        <label for="firstname">ชื่อ - สกุล</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?php echo $_SESSION["cust_name"];?>" >
                      </div>
                      <div class="form-group">
                        <label for="email">อีเมล</label>
                        <input type="text" id="email" name ="email" class="form-control" value="<?php echo $_SESSION["cust_email"];?>" >
                      </div>
                      <div class="form-group">
                        <label for="telephone">เบอร์โทร</label>
                        <input type="text" id="phone" name ="phone"  class="form-control" value="<?php echo $_SESSION["cust_phone"];?>" >
                      </div>
                    
                    <hr>
                    <div class="col-md-12">                      
                      <input  class="btn btn-primary  pull-left" type="submit" name="submit" value="บันทึก">

                     
                    </div>
                  </div>
                </div>
              </div>
              <!-- END PAYMENT ADDRESS -->
        </form>  
                </div> 
              </div> 
            </div>
          </div>   
      </div>
    </div>

    <?php 
    include("footer.php");
    ?>