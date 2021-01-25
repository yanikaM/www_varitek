

<!-- Body BEGIN -->
<body class="ecommerce">
     <?php 
      include("header.php");
      $order_no= $_GET['o_ID'];
      $sql = "SELECT * FROM orders as o, orders_detail as d, products as p WHERE o.Orders_No= '$order_no' AND  o.Orders_No=d.Orders_No AND d.Products_ID=p.Products_ID  ORDER BY o.Orders_ID ASC";
      $query = mysqli_query($con, $sql);
      if(isset($_POST['claim'])){
        $prd = $_POST['prd'];
        $note = $_POST['note'];
        $custid = $_SESSION["cust"];
        $order_no = $_POST['order_no'];
        $sql_in = "INSERT INTO products_claim (products_ID,note,Orders_No,Customer_ID,LastUpdate,status)
        VALUES ('$prd','$note','$order_no','$custid',CURRENT_DATE,1) ;";
        $query_in = mysqli_query($con, $sql_in);
        if($query_in == TRUE) {
          echo "<script language='javascript'> alert('แจ้งเคลมสินค้าเรียบร้อย กรุณารอเจ้าหน้าที่ติดต่อกลับ');window.location='order.php?order_no="."$order_no"."';</script>";
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
              <h1>แจ้งเคลมสินค้า</h1>
              <div class="goods-page">
                <div class="goods-data clearfix">
                <form action="" method="post">
                <div id="payment-address-content" class="">
                  <div class="panel-body row">
                    <div class="col-md-6 col-sm-6">

                      <input type="hidden" name="order_no" value="<?php echo $order_no;?> ">
                      <div class="form-group">
                        <label for="prd">สินค้าที่ต้องการเคลม<span class="require">*</span></label>
                        <select name="prd" id="prd" class="form-control"  required= "required" >
                            <option value="">เลือกสินค้า</option>
                            <?php while($result = mysqli_fetch_assoc($query)): ?>
                                <option value="<?php echo $result['Products_ID'];?>"><?php echo $result['Products_Name'];?></option>
                            <?php endwhile; ?>
                        </select>
                      <div class="form-group">
                        <label for="note">รายละเอียด<span class="require">*</span></label>
                        <textarea class="form-control" name="note" id="note" cols="30" rows="10" required= "required"></textarea>
                      </div> 
                    </div>
                    
                  
                    <div class="col-md-12">                      
                      
                      <button class="btn btn-primary  pull-left" type="submit" name="claim">ยืนยันการเคลมสินค้า</button>
                                            
                    </div>
                  </div>
                </div>
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