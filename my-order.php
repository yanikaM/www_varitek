

<!-- Body BEGIN -->
<body class="ecommerce">
     <?php 
      include("header.php");

    ?>
    
    <div class="main">
      <div class="container">
      <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->

          <div class="col-md-12 col-sm-12">
            <h1>รายการซื้อของฉัน</h1>
            <div class="goods-page">
              <div class="goods-data clearfix">
                <ul class="nav nav-pills nav-justified">
                    <li class="nav-item <?php if(!isset($_GET["f"]) || $_GET["f"]=="" ){echo "active" ;} ?>">
                        <a class="nav-link " href="my-order.php"> ทั้งหมด</a>
                    </li>

                    <li class="nav-item <?php if($_GET["f"]==1){echo "active" ;} ?>">
                        <a class="nav-link " href="my-order.php?f=1">ที่ต้องชำระ</a>
                    </li>
        
                    <li class="nav-item <?php if($_GET["f"]==2){echo "active" ;} ?>">
                        <a class="nav-link " href="my-order.php?f=2">รอจัดส่ง</a>
                    </li>
                    <li class="nav-item <?php if($_GET["f"]==3){echo "active" ;} ?>">
                        <a class="nav-link " href="my-order.php?f=3">อยู่ระหว่างจัดส่ง</a>
                    </li>
                
                    <li class="nav-item <?php if($_GET["f"]==4){echo "active" ;} ?>">
                        <a class="nav-link " href="my-order.php?f=4">สำเร็จแล้ว</a>
                    </li>
                
                    <li class="nav-item  <?php if(isset($_GET["f"]) && $_GET["f"]==0){echo "active" ;} ?>">
                        <a class="nav-link" href="my-order.php?f=0">ยกเลิกแล้ว</a>
                    </li>
                
                </ul>
                
           
           


              </div>
            </div> 
            
            <?php
            $cust = $_SESSION['cust'];
            $sql	= "SELECT * FROM orders WHERE Customer_ID= '$cust' ";

            if(isset($_GET["f"])){
                if($_GET["f"]==1){
                    $sql .= " AND Orders_Status = '1' ";
                }elseif($_GET["f"]==2){
                    $sql .= " AND Orders_Status = '2' ";

                }elseif($_GET["f"]==3){
                    $sql .= " AND Orders_Status = '3' ";

                }elseif($_GET["f"]==4){
                    $sql .= " AND Orders_Status = '4' ";

                }
                elseif($_GET["f"]==0){
                    $sql .= " AND Orders_Status = '0' ";

                }

            }
            $sql .= " ORDER BY Orders_ID DESC ";
            $query = mysqli_query($con, $sql);
            $cnt_order = mysqli_num_rows($query);

            if ($cnt_order == 0){
                echo "<div class=\"alert alert-warning\">ไม่มีออเดอร์สินค้า</div>";
            }else{

                while ($row = mysqli_fetch_assoc($query)) {
                    $status =  $row['Orders_Status'];
                    $order_no= $row['Orders_No'];
                ?>
            <div class="goods-page">
              <div class="goods-data clearfix">
              <table class="table"  style="">
                            <thead>
                                <tr>
                                    <th scope="col" width="70%"><?php echo $row["Orders_No"];?></th>
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
                                    ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_cnt	= "SELECT * FROM orders as o, orders_detail as d, products as p WHERE o.Orders_No= '$order_no' AND  o.Orders_No=d.Orders_No AND d.Products_ID=p.Products_ID  ";
                            $query_cnt = mysqli_query($con, $sql_cnt);
                            $count = mysqli_num_rows($query_cnt);
                            $total=0;
                            while ($row_cnt = mysqli_fetch_assoc($query_cnt)) {
                                $sum_cnt	= $row_cnt['Products_price']*$row_cnt['Products_Qty'];
                                $total += $sum_cnt;
                            }

                            $sql2	= "SELECT * FROM orders as o, orders_detail as d, products as p WHERE o.Orders_No= '$order_no' AND  o.Orders_No=d.Orders_No AND d.Products_ID=p.Products_ID  ORDER BY o.Orders_ID ASC limit 2";
                            $query2 = mysqli_query($con, $sql2);
                            

                            while ($row2 = mysqli_fetch_assoc($query2)) {

                            ?>
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="../varitek-admin1/<?php echo $row2['Products_Image']; ?>" alt="" width="100" higth="150">
                                            </div>
                                            <div class="media-body">
                                                <p><?php echo $row2["Products_Name"];?></p>
                                                <p>ราคา <?php echo number_format($row2['Products_price'],2);?></p>
                                                <p>x <?php echo $row2["Products_Qty"];?></p>
                                            </div>
                                        </div>
                                    </td>
                                
                                    <td>
                                    <?php 
                                    $sum	= $row2['Products_price']*$row2['Products_Qty'];
                                    echo number_format($sum,2); ?> บาท
                                    </td>

                                </tr>
                                <?php 
                                }
                                if($count>2 ) {
                                ?>
                                <tr>
                                <td colspan='2' align='left'> <a class="" href="order.php?order_no=<?php echo $order_no;?>" ><i class="fa fa-flickr" aria-hidden="true"></i> ดูสินค้าเพิ่มเติม</a></td>
                                </tr>
                                <?php
                                
                                    }
                                    ?>

                                <tr>
                                    <td colspan='2' align='right'>ยอดคำสั่งซื้อทั้งหมด : <?php echo number_format($total,2); ?> บาท</td>
                                </tr>
                                <tr>
                                    <td colspan='2' align='right'> <a class="genric-btn info radius" href="order.php?order_no=<?php echo $order_no;?>" >ดูข้อมูลการสั่งซื้อ</a></td>
                                </tr>

                            </tbody>
                        </table>
              </div>
            </div>
            <?php
                }
            }   
            ?>
            
            

          </div>
         
          <!-- END CONTENT -->
        </div>
        
      </div>
    </div>

    <?php 
    include("footer.php");
    ?>