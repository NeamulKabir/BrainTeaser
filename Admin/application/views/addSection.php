<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/home.css");?>">
    <title>Add New Section</title>

    <link href="<?php echo base_url("assets/css/bootstrap.min.css");?>" rel="stylesheet">

    <link href="<?php echo base_url("assets/css/dashboard.css");?>" rel="stylesheet">

    <script src="<?php echo base_url("assets/js/ie-emulation-modes-warning.js");?>"></script>
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

    <div class="container">
      <div class="col-sm-9 col-sm-offset-3 col-md-8 col-md-offset-2 main bord"> 

          <h2 class="sub-header">Add A Section</h2><br><br>
          <form id="problemform" class="form-horizontal" role="form" action="<?php echo site_url('admin/add_new_section');?>" method = "post"> 
            <div>
                <h3><span class="label label-primary">Choose Category</span></h3><br>
                <select name="category">
                  <?php
                    foreach ($cat as $c) {
                       echo "<option>".$c['category_name']."</option>";
                    }
                  ?>
                </select>
            </div>
            <div>
                <h3><span class="label label-primary">Section Name</span></h3><br>
                <input type="text" class="form-control" name="section" id="usr" placeholder="Section Name..."><br>
            </div>
            
            <div>
              <br><button type="submit" class="btn btn-success">Submit </button>
            </div>
          </form>
        </div>
    </div>

    <!--================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo base_url("assets/js/bootstrap.min.js");?>"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="<?php echo base_url("assets/js/vendor/holder.min.js");?>"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url("assets/js/ie10-viewport-bug-workaround.js");?>"></script>
  </body>
</html>
