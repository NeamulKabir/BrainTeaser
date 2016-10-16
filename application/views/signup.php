<!DOCTYPE html>
    <html lang="en"> 
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrainTeser Sign Up</title>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css");?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/signup.css");?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap-theme.min.css");?>">  
  </head> 

  <body>

    <div class="container"> 

 <div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Sign Up</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="<?php echo site_url('start/login');?>" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                        </div>  
                        <div class="panel-body" >
                            <form id="signupform" class="form-horizontal" role="form" action="<?php echo site_url('start/signup_confirm');?>" method = "post">
                                
                                <div id="signupalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>
                                </div>
                                  
                                  <?php
                                        if ($fail == 0)
                                        // echo "failed...Try again";
                                    echo "<span class='label label-danger'>failed...Try again. User Name used already.</span>";

                                        if ($fail == 2)
                                            echo "<span class='label label-danger'>failed...Try again. password and confirm password doesn't match.</span>";


                                  ?>  
                                
                                  
                                
                                    
                                <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">First Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="firstname" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-md-3 control-label">Last Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="lastname" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_name" class="col-md-3 control-label">User Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="user_name" placeholder="User Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="age" class="col-md-3 control-label">Age</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="age" min="8" placeholder="Enter Your Age Here" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="passwd" placeholder="Password" required>
                                    </div>
                                </div>
                                
                                    
                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Confirm Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="conPasswd" placeholder="Confirm Password" required>
                                    </div>
                                </div>
                                <? php
                                $pass=$_POST['passwd']
                                $con=$_['conPasswd']
                                if($pass!=$con)
                                    echo "password matched"
                                else
                                    echo "mismatched"
                                ?>

                                <div class="form-group">
                                    <!-- Button -->                                        
                                    
                                    <button class="btn btn-lg btn-primary" type="submit" style="margin-left:40px width:50px">Sign Up</button>

                                </div>
                                
                              <!--  <div style="border-top: 1px solid #999; padding-top:20px"  class="form-group">
                                    
                                    <div class="col-md-offset-3 col-md-9">
                                        <button id="btn-fbsignup" type="button" class="btn btn-primary"><i class="icon-facebook"></i>   Sign Up with Facebook</button>
                                    </div>                                           
                                        
                                </div>-->
                                
                                
                                
                            </form>
                         </div>
                    </div>

               
               
                
         </div> 
    </div>
    <script src="<?php echo base_url("assets/js/jquery-1.11.2.min.js");?>"></script>
    <script src="<?php echo base_url("assets/js/bootstrap.min.js");?>"></script>
  </body>
</html>