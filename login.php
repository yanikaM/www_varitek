

<!-- Body BEGIN -->
<body class="ecommerce">
     <?php 
      include("header.php");

    ?>
    
    <div class="main">
      <div class="container">
      <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li class="active">LOGIN</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
            <h1>Login</h1>
            <!-- BEGIN CHECKOUT PAGE -->
            <div class="panel-group checkout-page accordion scrollable" id="checkout-page">

              <!-- BEGIN CHECKOUT -->
              <div id="checkout" class="panel panel-default">
   
                <div id="checkout-content" class="panel-collapse collapse in">
                  <div class="panel-body row">
                    <div class="col-md-6 col-sm-6">
                      <h3>New Customer</h3>
                  
                      
                      <a href="register.php"><button class="btn btn-primary" >Register</button></a>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <h3>Returning Customer</h3>
                      <p>I am a returning customer.</p>
                      <form action="contact_process.php" method="post">
                        <div class="form-group">
                          <label for="email-login">Username</label>
                          <input type="text" id="username" name ="username" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="password-login">Password</label>
                          <input type="password" id="password" name ="password"  class="form-control">
                        </div>
                        <a href="javascript:;">Forgotten Password?</a>
                        <div class="padding-top-20">                  
                          <button class="btn btn-primary" type="submit">Login</button>
                        </div>
                        <hr>
                        
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END CHECKOUT -->

              

            </div>
            <!-- END CHECKOUT PAGE -->
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
    </div>

    <?php 
    include("footer.php");
    ?>