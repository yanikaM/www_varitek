

<!-- Body BEGIN -->
<body class="ecommerce">
     <?php 
      include("header.php");
      if(isset($_POST['rigist'])){
        $name= $_POST['name'];
        $password= $_POST['password'];
        $password= $_POST['password-confirm'];
        $phone= $_POST['phone'];
        $email= $_POST['email'];
        if($name=="" || $password==""){
            echo "<script language='javascript'> alert('กรุณากรอกข้อมูลให้ครบทุกช่อง');window.history.back(-1);</script>";
        }else{
            $SQL1 = "INSERT INTO  customers (Customer_Name,Customer_Username,Customer_Password,Customer_Phone,Customer_Email) 
            VALUE ('$name','$email','$password','$phone','$email')";
            $Query1 = mysqli_query($con,$SQL1);
            if($Query1 == TRUE) {
                echo "<script language='javascript'> alert('ลงทะเบียนสำเร็จ');window.location='logout.php';</script>";
        
            }else{
        
                echo "<script language='javascript'> alert('มีปัญหาในการบันทึกข้อมูล กรุณาลองใหม่  err-01');window.history.back(-1);</script>";
            }
        }
    
       
    }    

    ?>
    
    
    <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li class="active">Register</li>
        </ul>
         <!-- BEGIN PAYMENT ADDRESS -->
         <div id="payment-address" class="panel panel-default">
            <form action="" method="post">
                <div id="payment-address-content" class="">
                  <div class="panel-body row">
                    <div class="col-md-6 col-sm-6">
                      <h3>Your Personal Details</h3>
                      
                      <div class="form-group">
                        <label for="firstname">ชื่อ - สกุล <span class="require">*</span></label>
                        <input type="text" id="name" name="name" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="email">อีเมล <span class="require">*</span></label>
                        <input type="text" id="email" name ="email" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="telephone">เบอร์โทร<span class="require">*</span></label>
                        <input type="text" id="phone" name ="phone"  class="form-control">
                  

                      <h3>Your Password</h3>
                      <div class="form-group">
                        <label for="password">Password <span class="require">*</span></label>
                        <input type="password" id="password" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="password-confirm">Password Confirm <span class="require">*</span></label>
                        <input type="text" id="password-confirm" name ="password-confirm" class="form-control">
                      </div>
                      
                    </div>
                    
                    <hr>
                    <div class="col-md-12">                      
                      
                      <button class="btn btn-primary  pull-right" type="submit" name="rigist">Continue</button>
                      <div class="checkbox pull-right">
                        <label>
                          <input type="checkbox"> I have read and agree to the <a title="Privacy Policy" href="#">Privacy Policy</a> &nbsp;&nbsp;&nbsp; 
                        </label>
                      </div>                        
                    </div>
                  </div>
                </div>
                </form>
              </div>
              <!-- END PAYMENT ADDRESS -->
          
      </div>
    </div>

    <?php 
    include("footer.php");
    ?>
