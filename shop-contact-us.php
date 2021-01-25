

<!-- Body BEGIN -->
<body class="ecommerce">
     <?php 
      include("header.php");

    ?>
    
    <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li class="">Contact</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-3">
            

            <h2>บริษัท วาไรเทค จำกัด</h2>
            <address>
            89/21 หมู่ 2 ถนนพระราม2 ต.คอกกระบือ<br>
            อ.เมืองสมุทรสาคร จ.เมืองสมุทรสาคร 74000<br>
              <abbr title="Phone">P:</abbr> 0809153655<br>
            </address>
            <address>
              <strong>Email</strong><br>
              <a href="mailto:varitek_2019@hotmail.com">varitek_2019@hotmail.com</a><br>

            </address>

          </div>
          <!-- END SIDEBAR -->

          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-9">
            <h1>Contact</h1>
            <div class="content-page">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3878.113024721624!2d100.3371232132839!3d13.589906204689543!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2b95b356bbd05%3A0xb71398162e19fb96!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4reC4suC4i-C4teC4n-C4siDguIjguLPguIHguLHguJQg4Lih4Lir4Liy4LiK4LiZ!5e0!3m2!1sth!2sth!4v1610950599749!5m2!1sth!2sth" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

              <h2>Contact Form</h2>
              <p>กรุณาระบุข้อมูล</p>
              
              <!-- BEGIN FORM-->
              <form action="mailto:yanika.naja@gmail.com" method="post" enctype="text/plain">
                <div class="form-group">
                  <label for="name">ชื่อ</label>
                  <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                  <label for="email">อีเมล <span class="require">*</span></label>
                  <input type="text" class="form-control" id="email" name="mail">
                </div>
                <div class="form-group">
                  <label for="message">ข้อเสนอแนะ:</label>
                  <textarea class="form-control" rows="8" id="message" name="comment"></textarea>
                </div>
                <div class="padding-top-20">                  
                  <button type="submit" class="btn btn-primary">ส่งข้อมูลติดต่อ</button>
                </div>
              </form>
              <!-- END FORM-->          
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

        
      </div>
    </div>

    <?php 
    include("footer.php");
    ?>