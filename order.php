

<!-- Body BEGIN -->
<body class="ecommerce">
     <?php 
      include("header.php");
      if(isset($_POST['Upload'])){
        $ext = pathinfo(basename($_FILES['pay_slip']['name']), PATHINFO_EXTENSION);
        $order_id = $_POST["order_id"];
        $paymentMethod = $_POST["paymentMethod"];
        $today = date("Y-m-d H:i:s");
        $cust = $_SESSION['cust'];
        if($ext!=""){ 
            $new_pic_name = $order_id."-slip_picture.".$ext;
            $img_path = "asefa-shop-admin/images/slips/";
            $upload_path = $img_path.$new_pic_name;
            $success = move_uploaded_file($_FILES['pay_slip']['tmp_name'], "../".$upload_path);
            $q_pic = "images/slips/".$new_pic_name;
    
        }
    
        $SQL1 = "INSERT INTO  payments (Customers_ID,Employees_ID,Orders_No,payments_Method,payments_Detail,payments_File,payments_Date,payments_Status) 
        VALUE ('$cust',NULL,'$order_id','$paymentMethod',NULL,'$q_pic','$today',1)
         ";
        $Query1 = mysqli_query($con,$SQL1);
        if($Query1 == TRUE) {
            $SQL2 = "UPDATE orders SET `Orders_Status` = 2,LastUpdate='$today'  WHERE `Orders_No` = '$order_id' ";
            $Query2 = mysqli_query($con,$SQL2);
            if($Query2 == TRUE) {
                echo "<script language='javascript'> alert('บันทึกข้อมูลเรียบร้อย');window.location='order.php?order_no=".$order_id."';</script>";
              }else{
                echo "<script language='javascript'> alert('มีปัญหาในการบันทึกข้อมูล กรุณาลองใหม่  err-01');</script>";
       
              }
    
        }else{
            echo "<script language='javascript'> alert('มีปัญหาในการบันทึกข้อมูล กรุณาลองใหม่  err-02');</script>";
        }
    
        
    
    }elseif(isset($_POST['cancel'])){
        $order_id = $_POST["order_id"];
        $today = date("Y-m-d H:i:s");
        $cust = $_SESSION['cust'];
    
        $SQL3 = "UPDATE orders SET `Orders_Status` = 0,LastUpdate='$today'  WHERE `Orders_No` = '$order_id' ";
        $Query3 = mysqli_query($con,$SQL3);
            if($Query3 == TRUE) {
                echo "<script language='javascript'> alert('ยกเลิกคำสั่งซื้อแล้ว');window.location='order.php?order_no=".$order_id."';</script>";
              }else{
                echo "<script language='javascript'> alert('มีปัญหาในการบันทึกข้อมูล กรุณาลองใหม่  err-03');</script>";
       
              }
    
    }
    $order_no = $_GET["order_no"];

$sql	= "SELECT * FROM orders as o INNER JOIN customers_address as ca ON o.ca_ID = ca.ca_ID LEFT JOIN payments ON o.Orders_No=payments.Orders_No WHERE o.Orders_No= '$order_no'";
$query = mysqli_query($con, $sql);
$rows = mysqli_fetch_assoc($query);
$status =  $rows['Orders_Status'];
$ornum =  $rows['Orders_No'];
$tag =  $rows['Orders_TAG'];
$pay_Method =  $rows['payments_Method'];

    ?>
    
    <div class="main">
      <div class="container">
      <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->

          <div class="col-md-12 col-sm-12">
            <h1>รายการซื้อของฉัน</h1>
            <div class="goods-page">
              <div class="goods-data clearfix">
              <div class="table-responsive" >
             
             <table class="table"  style="">
                     <thead>
                         <tr>
                             <th scope="col" width="70%"><h4 style="color:#fd7e14;"><?php echo $order_no;?></h4></th>
                             <th scope="col">สถานะ : <?php 
                                if($status==1){ ?>
                                    <span class="badge badge-info"> ที่ต้องชำระ</span>
                                <?php  }elseif($status==2){
                                    ?>
                                    <span class="badge badge-warning">  รอจัดส่ง   </span>
                                    
                                    <?php 
                                }elseif($status==3){
                                    ?>
                                    <span class="badge badge-primary">อยู่ระหว่างจัดส่ง</span>
                                    <a class="" href="https://track.thailandpost.co.th/?trackNumber=<?php echo $tag; ?> "  target="_blank">ดูสถานะการจัดส่ง</a>

                                    <?php 
                                }elseif($status==4){
                                    ?>
                                    <span class="badge badge-success">สำเร็จแล้ว</span>
                                    <?php 
                                }
                                elseif($status==0){
                                    ?>
                                    <span class="badge badge-secondary"> ยกเลิกคำสั่งซื้อ </span>
                                    <?php 
                                }
                                ?>
                             </th>
                         </tr>
                         <?php 
                         if($status == '2'){ ?>
                         
                             <td>ชำระโดย : <font color="blue"> <?php echo $pay_Method;?> </font></td>
                         
                         <?php 
                         }
                         ?>
                         <tr>
                     </thead>
                
                     <tbody>
                     <?php
                         $sqlo	= "SELECT * FROM orders as o, orders_detail as d, products as p WHERE o.Orders_No= '$order_no' AND  o.Orders_No=d.Orders_No AND d.Products_ID=p.Products_ID  ORDER BY o.Orders_ID ASC";
                         $queryo = mysqli_query($con, $sqlo);
                         $total = 0;
                         while ($row_cartdone = mysqli_fetch_assoc($queryo)) {
                             $opt_id = $row_cartdone['Optiondetails_ID'];
                             $totals = $row_cartdone['Products_price']*$row_cartdone['Products_Qty'];
 
                         ?>
                         <tr>
                             <td>
                                 <div class="media">
                                     <div class="d-flex">
                                         <img src="../varitek-admin1/<?php echo $row_cartdone['Products_Image']; ?>" alt="" width="100" height="100">
                                     </div>
                                     <div class="media-body">
                                         <p><?php echo $row_cartdone['Products_Name'];?></p>
                                         <p>ราคา <?php echo $row_cartdone['Products_price'];?></p>
                                         
                                         
                                         <p>x <?php echo $row_cartdone['Products_Qty']; ?></p>
                                     </div>
                                 </div>
                             </td>
                     
                             <td>
                                 <?php 
                                   $sum	= $row_cartdone['Products_price']*$row_cartdone['Products_Qty'];
                                 echo number_format($sum,2); ?> บาท
                             </td>
                         </tr>
                         <?php
 
                       
                         
                             $total += $sum;
 
                             
                         }
 
                         ?>
                         <tr>
                         <td>
                         <p><font color="red"><h2>ที่อยู่จัดส่งสินค้า</h2></font></p> <br>
                         <?php 
                              echo $rows['ca_name']."</br>";
                              echo $rows['ca_phone']."</br>";
                              echo $rows['ca_address']."</br>";
                              echo $rows['ca_amphure']." ".$rows['ca_district']."</br>";
                              echo $rows['ca_province']." ".$rows['ca_postnum']."</br>";
                            
                            ?>
                            <br>
                           <sub><font color="red"> <em>* หากต้องการเปลี่ยนที่อยู่จัดส่งสินค้า โปรดติดต่อเจ้าหน้าที่</em></font></sub>
                            </td>
                         </tr>
                         <tr>
                             <td colspan='2' align='right'>ยอดคำสั่งซื้อทั้งหมด : <font size="4" color="#ff0000"><?php echo number_format($total,2); ?> บาท</font></td>
                        </tr>
                        <tr>
                        <td colspan='2' align='right'>ค่าจัดส่ง : <font size="4" color="#ff0000"><?php echo number_format(100,2); ?> บาท</font></td>
                             
                        </tr>
                        <tr>
                        <td colspan='2' align='right'>รวมยอดที่ต้องชำระ : <font size="5" color="#ff0000"><b> <?php echo number_format(($total+100),2); ?> บาท</b></font></td>
                        </tr>
                         
                         <?php 
 
       if($status == '1'){ 
 
       $query_rb = "SELECT * FROM banks";
       $rb = mysqli_query($con, $query_rb);
       
       $totalRows_rb = mysqli_num_rows($rb);
     ?>
     <form action="" method="post" enctype="multipart/form-data" name="formpay" id="formpay"> 
     <tr>
 
         <td colspan='2'>   
 
         <p> <font color="red">เลือกช่องทางชำระเงิน</font></p> 
 
         <label for="primary-radio" onclick="sSelect('banking')">
             <input class="primary-radio" type="radio" id="primary-radio" name="paymentMethod" value="โอนเข้าบัญชี">
             โอนเข้าบัญชี
         </label><br><br>
 
         
   
             
         </td>
          </tr>
 
         <tr id='display'  style='display:none;'>
             <td colspan='2' >   
                 <p>แนบหลักฐานการโอน</p>
                 
                 <!-- <p><img id="blah" style="width:200px" src="../asefa-shop-admin/images/up_img.png"/></p> -->
                 <input name="pay_slip" id="pay_slip" type="file"/>
                 (ไฟล์ .jpg, gif, png, pdf&nbsp;ไม่เกิน 2mb)
                 <input name="order_id" type="hidden" id="order_id" value="<?php echo $order_no;?>" />
             </td>
         </tr>     
       
         
       <tr>    
                             <td colspan='2' align='center'> 
                                 
                             <button type="submit" class="btn btn-success" name="Upload" id="Upload">ยืนยันการชำระเงิน </button>
                             <button type="submit" class="btn btn-danger" name="cancel" id="cancel">ยกเลิกคำสั่งซื้อ </button>
                             </td>
                             
                         </tr>
      </form>                   
   <?php 
       }elseif($status='4'){
   ?>
   <tr>
       <td colspan='2'>

           <a href="claim.php?o_ID=<?php echo $order_no;?>" class="btn btn-success">แจ้งเคลมสินค้า</a>
       </td>
   

   </tr>
   <?php 
       }
   ?>
                        
                         
 
                     </tbody>
                 </table>
             </div>

              </div>
            </div>    
          </div>
         
          <!-- END CONTENT -->
        </div>
        
      </div>
    </div>

    <?php 
    include("footer.php");
    ?>

    <script>
        function sSelect(chk){
  var dp = document.getElementById("display");

  
  if (chk=="banking"){
    dp.style.display = 'block';
  }else{
    dp.style.display = 'none';
  }
}
    </script>