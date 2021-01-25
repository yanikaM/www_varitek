

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
            <h1>บทความข่าวสาร</h1>
            <?php
            if(isset($_GET['news'])){
                $id=$_GET['news'];

                $sql_n= "SELECT * FROM `news`  WHERE News_ID= '$id'  ";
                $query_n = mysqli_query($con, $sql_n);
                $row_n = mysqli_fetch_assoc($query_n);
            ?>
            <div class="goods-page">
              <div class="goods-data clearfix">
                <div class="row">
                    <div class="col-md-4">
                     <h1 style="color:#fd7e14;"><?php echo $row_n['news_topic'];?></h1><br><br>
                      <p><?php echo $row_n['LastUpdate'];?></p><br><br>
                      <p>by Admin</p>
                    </div>
                    <div class="col-md-4">
                         <img src="../varitek-admin1/<?php echo $row_n['news_photo'];?>" class="img-responsive" alt="">  
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $row_n['news_detail'];?>
                    </div>
                </div>
              </div>
            </div>  
            <?php    

            }else{
                $sql_n= "SELECT * FROM `news`  ORDER BY LastUpdate DESC  ";
                $query_n = mysqli_query($con, $sql_n);
                while ($row_n = mysqli_fetch_assoc($query_n)) { 
            ?>
            <div class="goods-page">
              <div class="goods-data clearfix">
                  <div class="col-md-5">
                        <a href="shop-news.php?news=<?php echo $row_n['News_ID']; ?>">
                        <img src="../varitek-admin1/<?php echo $row_n['news_photo'];?>" class="img-responsive" alt="">
                        </a>
                  </div>
                  <div class="col-md-7">
                      <h1 style="color:#fd7e14;"><?php echo $row_n['news_topic'];?></h1>
                      <p><?php echo $row_n['LastUpdate'];?></p>
                      <p>by Admin</p> <br>
                      <p><?php
                      $a = preg_replace( '/^([เแไใโ]{0,1}[ก-ฮ]{1,2}[อิอีอือึอุอูอัอ่อ้อ๊อ๋]{0,2}[าะ]{0,1}[ก-ฮ]{0,1}){4}/u' , '', $row_n['news_detail']);
                      $a = preg_replace( '/([เแไใโ]{0,1}[ก-ฮ]{1,2}[อิอีอือึอุอูอัอ่อ้อ๊อ๋]{0,2}[าะ]{0,1}[ก-ฮ]{0,1}){2}$/u' , '', $a);
                      echo mb_substr($a,0,500,'UTF-8')."<a href='shop-news.php?news=".$row_n['News_ID']."'>   อ่านเพิ่มเติม.... </a>"; ?></p>
                  </div>
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