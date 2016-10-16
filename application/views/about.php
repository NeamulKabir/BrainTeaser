<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/home.css");?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/button.css");?>">
    <link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen">
    <link href="css/hosting.css" rel="stylesheet" media="all">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url("assets/css/image.css"); ?>"/>
    <link href="<?php echo base_url("assets/css/bootstrap.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/bootstrap-responsive.css"); ?>" rel="stylesheet" media="screen">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url("assets/css/hosting.css"); ?>" rel="stylesheet" media="all">
    <title>BrainTeaser : An interactive problem solving ground</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url("assets/css/bootstrap.min.css");?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/dashboard.css");?>" rel="stylesheet">
    <script src="<?php echo base_url("assets/js/ie-emulation-modes-warning.js");?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://s3.amazonaws.com/codecademy-content/courses/hour-of-code/js/alphabet.js"></script>
  </head>
  <body>
  	 <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a id="logo" class="navbar-brand" href="<?php echo site_url('start/home');?>">BrainTeaser</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo site_url('start/home');?>">Home</a></li>
            <li><a href="<?php echo site_url('start/settings');?>">Settings</a></li>
            <li><a href="<?php echo site_url('start/profile');?>">Profile</a></li>
            <li><a href="<?php echo site_url('start/about');?>">About Us</a></li>
            <li><a href="<?php echo site_url('start/logout');?>">Log Out</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </nav>
    <div align="center" style="text-align:center">
    <h2>Welcome To </h2>
  </div>
  	<div class="col-sm-3 col-md-2">
  	</div>
  	<div class="col-sm-3 col-md-2">
  		
	    <canvas id="myCanvas"></canvas>
	    <script type="text/javascript" src="http://s3.amazonaws.com/codecademy-content/courses/hour-of-code/js/bubbles.js"></script>
	    <script type="text/javascript" src="<?php echo base_url("assets/js/test.js");?>"></script>
	   </div>
     <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
     <div class="page-header">
        <h3>The people behind building this website</h3>
     </div>

    <div class="container" class="row" style="padding:60px">
       <div class="span3 PlanPricing template4" class="col-md-4" style="width:280px" >  <!-- Price template4 Starts -->
        <div class="planName"> <span class="price">CSE-BUET</span>
          <h4>Neamul Kabir</h4>
          <p>Student</p>
        </div>
        <div class="planFeatures">
          <ul>
            <li><img src="<?php echo base_url("images/neamul2.png");?>" height="100" width="100" class="img-circle" alt="Cinque Terre"></li>
          </ul>
        </div>
        <p> <a href="#" role="button" data-toggle="modal" class="btn btn-success btn-large" height="50" width="50">Programmer </a> </p>
      </div>

      <div class="span3 PlanPricing template4" class="col-md-4" style="width:280px">  <!-- Price template4 Starts -->
        <div class="planName"> <span class="price">CSE-BUET</span>
          <h4>Sukarna Barua</h4>
          <p>Assistant Professor</p>
        </div>
        <div class="planFeatures">
          <ul>
            <li><img src="<?php echo base_url("images/sukarna.png");?>" height="100" width="100" class="img-circle" alt="Cinque Terre"></li>
          </ul>
        </div>
        <p> <a href="#" role="button" data-toggle="modal" class="btn btn-success btn-large" height="50" width="50">Supervisor </a> </p>
      </div>

      <div class="span3 PlanPricing template4" class="col-md-4" style="width:280px">  <!-- Price template4 Starts -->
        <div class="planName"> <span class="price">CSE-BUET</span>
          <h4>Dipon Saha</h4>
          <p>Student</p>
        </div>
        <div class="planFeatures">
          <ul>
            <li><img src="<?php echo base_url("images/dipon2.png");?>" height="100" width="100" class="img-circle" alt="Cinque Terre"></li>
          </ul>
        </div>
        <p><a href="#" role="button" data-toggle="modal" class="btn btn-success btn-large" height="80" width="80">Programmer </a> </p>
      </div>

    </div>

    <footer>
      <div class="navbar-header" padding="70px" align="center">
        <p class="navbar-brand" >This is an intractive problem solving site with problems of different categories and sub-categories. This website is fully for learning purpose.</p>  
      </div>
      <div>
        <a class="navbar-brand" class="col-lg-12" href="#"> &copy; BrainTeaser 2015</a>
      </div>
  </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo base_url("assets/js/bootstrap.min.js");?>"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="<?php echo base_url("assets/js/vendor/holder.min.js");?>"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url("assets/js/ie10-viewport-bug-workaround.js");?>"></script>
  </body>
</html>