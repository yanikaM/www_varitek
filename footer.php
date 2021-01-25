<!-- BEGIN BRANDS -->
<div class="brands">
      <div class="container">
            <div class="owl-carousel owl-carousel6-brands">
              <a href="#"><img src="assets/pages/img/brands/4wHcoBbI-fuji-electric-vector-logo.png" alt="canon" title="canon"></a>
              <a href="#"><img src="assets/pages/img/brands/6HaBfX7y-siemens.png" alt="esprit" title="esprit"></a>
              <a href="#"><img src="assets/pages/img/brands/Aum9IQCL-Draka.png" alt="esprit" title="esprit"></a>
              <a href="#"><img src="assets/pages/img/brands/D9fOR2eN-yazaki.jpg" alt="esprit" title="esprit"></a>
              <a href="#"><img src="assets/pages/img/brands/JrIOZX7V-Omron.jpg" alt="esprit" title="esprit"></a>
              <a href="#"><img src="assets/pages/img/brands/lU3neEDX-prysmian.png" alt="esprit" title="esprit"></a>
              <a href="#"><img src="assets/pages/img/brands/ntIfZVsa-Phelps dodge.jpg" alt="esprit" title="esprit"></a>
              <a href="#"><img src="assets/pages/img/brands/oKwefIv2-mitsubishi.jpg" alt="esprit" title="esprit"></a>
              <a href="#"><img src="assets/pages/img/brands/Sfv627kI-Schneider.jpg" alt="esprit" title="esprit"></a>
              <a href="#"><img src="assets/pages/img/brands/TkMIQuAL-JA solar.png" alt="esprit" title="esprit"></a>
             
            </div>
        </div>
    </div>
    <!-- END BRANDS -->

    <!-- BEGIN STEPS -->
    <div class="steps-block steps-block-red">
      <div class="container">
        <div class="row">
          <div class="col-md-4 steps-block-col">
            <i class="fa fa-truck"></i>
            <div>
              <h2>shipping</h2>
              <em>Express delivery</em>
            </div>
            <span>&nbsp;</span>
          </div>
          <div class="col-md-4 steps-block-col">
            <i class="fa fa-gift"></i>
            <div>
              <h2>Promotions</h2>
              <em>For you</em>
            </div>
            <span>&nbsp;</span>
          </div>
          <div class="col-md-4 steps-block-col">
            <i class="fa fa-phone"></i>
            <div>
              <h2>0809153655</h2>
              <em>customer care</em>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END STEPS -->

   

    <!-- BEGIN FOOTER -->
    <div class="footer">
      <div class="container">
        <div class="row">
          <!-- BEGIN COPYRIGHT -->
          <div class="col-md-4 col-sm-4 padding-top-10">
            2021 © Innovation ASEFA. ALL Rights Reserved. 
          </div>
          <!-- END COPYRIGHT -->
          <!-- BEGIN PAYMENTS -->
          <!-- <div class="col-md-4 col-sm-4">
            <ul class="list-unstyled list-inline pull-right">
              <li><img src="assets/corporate/img/payments/western-union.jpg" alt="We accept Western Union" title="We accept Western Union"></li>
              <li><img src="assets/corporate/img/payments/american-express.jpg" alt="We accept American Express" title="We accept American Express"></li>
              <li><img src="assets/corporate/img/payments/MasterCard.jpg" alt="We accept MasterCard" title="We accept MasterCard"></li>
              <li><img src="assets/corporate/img/payments/PayPal.jpg" alt="We accept PayPal" title="We accept PayPal"></li>
              <li><img src="assets/corporate/img/payments/visa.jpg" alt="We accept Visa" title="We accept Visa"></li>
            </ul>
          </div> -->
          <!-- END PAYMENTS -->
          <!-- BEGIN POWERED -->
          <div class="col-md-4 col-sm-4 text-right">
            <p class="powered">Powered by: <a href=""></a></p>
          </div>
          <!-- END POWERED -->
        </div>
      </div>
    </div>
    <!-- END FOOTER -->

    <!-- BEGIN fast view of a product -->
    <div id="product-pop-up" style="display: none; width: 700px;">
            <div class="product-page product-pop-up">
              
            </div>
    </div>
    <!-- END fast view of a product -->

    <!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
    <!--[if lt IE 9]>
    <script src="assets/plugins/respond.min.js"></script>  
    <![endif]-->
    <script src="assets/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>      
    <script src="assets/corporate/scripts/back-to-top.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <script src="assets/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
    <script src="assets/plugins/owl.carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->
    <script src='assets/plugins/zoom/jquery.zoom.min.js' type="text/javascript"></script><!-- product zoom -->
    <script src="assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script><!-- Quantity -->

    <script src="assets/corporate/scripts/layout.js" type="text/javascript"></script>
    <script src="assets/pages/scripts/bs-carousel.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();    
            Layout.initOWL();
            Layout.initImageZoom();
            Layout.initTouchspin();
            Layout.initTwitter();
        });

        $(function () {
          $(document).on('click','.view_data',function(){
          var id = $(this).attr('id');
          var table = $(this).attr('table');
          $.ajax({
              url:"show_product.php",
              type:"post",
              data:{id:id,table:table},
              success :function(data){
                  $("#product-page").html(data);
                  $("#product-pop-up").modal('show');
              }
            });
      });
      })
    </script>
    <!-- END PAGE LEVEL JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>