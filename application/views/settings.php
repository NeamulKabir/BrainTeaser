<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/home.css");?>">
    <title>User Settings</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url("assets/css/bootstrap.min.css");?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url("assets/css/dashboard.css");?>" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo base_url("assets/js/ie-emulation-modes-warning.js");?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a id="logo" class="navbar-brand" href="#">BrainTeaser</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo site_url('start/home');?>">Home</a></li>
            <li><a href="<?php echo site_url('start/settings');?>">Settings</a></li>
            <li><a href="<?php echo site_url('start/profile');?>">Profile</a></li>
            <li><a href="<?php echo site_url('start/about');?>">About Us</a></li>
            <li><a href="<?php echo site_url('start/logout');?>">Log Out</a></li>
          </ul>
          
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li ><a href="<?php echo site_url('start/home');?>"><b>HOME </b><span class="sr-only">(current)</span></a></li>
            <li><a href="<?php echo site_url('start/profile');?>"><b>Profile</b></a></li>
            <li><a href="<?php echo site_url('start/statistic');?>"><b>Statistics</b></a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="<?php echo site_url('start/addProblem');?>"><b>ADD A PROBLEM</b></a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="<?php echo site_url('start/forum');?>"><b>FORUM</b></a></li>
          </ul>

          <ul class="nav nav-sidebar">
             <li style="padding-left: 20px"><b>TOPICS</b>
                <ul class="nav nav-side">
                  <ul class="nav nav-side">
                  <?php
                  foreach ($categories as $c) {
                    //print_r($c);
                    $temp=$c['category_id'];
                    echo "<li><a href="; echo site_url('start/algebra/'.$temp); echo">".$c['category_name']."</li></a>";
                  }
                  ?>
                </ul>
            </li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-8 col-md-offset-2 main">
          <h2 class="page-header">Settings</h2>
          <form  id="settingsForm" class="form-horizontal" role="form" action="<?php echo site_url('start/ePass');?>" method = "post">
          <h3><span class="label label-warning">Change Password</span></h3>
          <?php
            if ($done == 1)
                                        // echo "failed...Try again";
             echo "<span class='label label-danger'>Successfully changed.</span>";
          ?>
          <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
              <h4>Old Password<h4>
            </div>
            <div class="col-xs-6 col-sm-6 placeholder">
              <input type="password" class="form-control"name="old" placeholder="Old Password" ><br>
            </div>
        </div>
        <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
              <h4>New Password<h4>
            </div>
            <div class="col-xs-6 col-sm-6 placeholder">
              <input type="password" class="form-control" name = "new" placeholder="New Password" ><br>
            </div>
        </div>
        <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
              <h4>Confirm New Password<h4>
            </div>
            <div class="col-xs-6 col-sm-6 placeholder">
              <input type="password" class="form-control" name = "newConfirm" placeholder="COnfirm New Password" ><br>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder"></div>
        <div class="col-xs-6 col-sm-6 placeholder">
        <form   action="<?php echo site_url('start/ePass');?>" method = "post">
          <button type="submit" class="btn btn-success">Confirm</button>
        </form>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
