<!DOCTYPE html>
    <html lang="en"> 
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrainTeaser Admin Home</title>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css");?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap-theme.min.css");?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/adminHome.css");?>">
    
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
            <li><a href="<?php echo site_url('admin/home');?>">HOME</a></li>
            
            <li><a href="<?php echo site_url('admin/addCategory');?>">New Category</a></li>
            <li><a href="<?php echo site_url('admin/addSection');?>">New Section</a></li>
            <li><a href="<?php echo site_url('admin/addAdmin');?>">New Admin</a></li>
            <li><a href="<?php echo site_url('admin/signout');?>">Sign Out</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <br><br>
        <div class="col-sm-9 col-sm-offset-3 col-md-8 col-md-offset-2 main">
          <h2 class="page-header">Welcome To <a id ="logo">BrainTeaser</a> Admin Panel</h2>
          <br><br>
          <h3>You have a lot of work to do!!!</h3>
          <br><br>
          <table class="table">
            <tbody>
              
              <tr class="success"><td><h4>Add New Category</h4></td></tr>
              <tr class="warning"></tr>
              <tr class="info"><td><h4>Add New Section</h4></td></tr>
              <tr class="warning"></tr>
              <tr class="success"><td><h4>Add New Admin</h4></td></tr>
            <tbody>  
          </table>
        </div>
    </div>



  </body>

  </html>