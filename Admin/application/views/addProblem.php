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
    <title>Problem Page</title>

    <link href="<?php echo base_url("assets/css/bootstrap.min.css");?>" rel="stylesheet">

    <link href="<?php echo base_url("assets/css/dashboard.css");?>" rel="stylesheet">

    <script src="<?php echo base_url("assets/js/ie-emulation-modes-warning.js");?>"></script>

    <script type="text/javascript">
         function configureDropDownLists(ddl1,ddl2) {
        
            var categories = <?php echo json_encode($cat); ?>;
            var section = <?php echo json_encode($sections); ?>;
            //alert(categories.length);
            
            // var algebra = new Array('Function', 'Real Numbers', 'Complex Numbers', 'Differentiation', 'Integration');
            // var geometry = new Array('Straight Line', 'Circle', 'Triangle');
            // var names = new Array('John', 'David', 'Sarah');

             
            for(var j=0; j < categories.length; j++)
            {
              var p = categories[j]['category_id'];

              if(ddl1.value == p)
              {

                ddl2.options.length = 0;
                //alert(section[p].length);
                for(var i=0; i<section[p].length; i++){
                    //alert(section[p][i]['section_id']);
                    createOption(ddl2, section[p][i]['section_name'],  section[p][i]['section_id']);
                }
                
              }
            }

            
         }

        function createOption(ddl, text, value) {
            var opt = document.createElement('option');
            opt.value = value;
            opt.text = text;
            ddl.options.add(opt);
        }
    </script>
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
            <li><a href="<?php echo site_url('admin/addProblem');?>">New Problem</a></li>
            <li><a href="<?php echo site_url('admin/addCategory');?>">New Category</a></li>
            <li><a href="<?php echo site_url('admin/addSection');?>">New Section</a></li>
            <li><a href="<?php echo site_url('admin/addAdmin');?>">New Admin</a></li>
            <li><a href="<?php echo site_url('admin/signout');?>">Sign Out</a></li>
          </ul>
        </div>
      </div>
    </nav>
       <!-- <?php
             if ($problem_succ == 1)
            // echo "failed...Try again";
             echo "<span class='label label-success'>Succesful</span>";
        ?>-->
        <div class="col-sm-9 col-sm-offset-3 col-md-8 col-md-offset-2 main">
          <h2 class="page-header">Add A New Problem</h2>
           <form id="problemform" class="form-horizontal" role="form" action="<?php echo site_url('admin/add_new_problem');?>" method = "post">
            <div>
              <h3><span class="label label-default">Select Category</span></h3>
                <select id="ddl" name="opt_cat" onchange="configureDropDownLists(this,document.getElementById('ddl2'))">
                  <?php 
                    foreach ($cat as $value) {
                      echo'
                       
                        <option value='.$value['category_id'].'>'.$value['category_name'].'</option>';
                    };
                  ?>
                </select>
                <select id="ddl2" name="opt_sec">
                </select>
                <select id="ddl3" name="point">
                  <option value="10">Easy</option>
                  <option value="20">Medium</option>
                  <option value="30">Hard</option>
                </select>
            </div>
            <div>
              <h3><span class="label label-default">Problem Title</span></h3>
              <input type="text" class="form-control" id="usr" name="title">
            </div>
            <div>
              <h3><span class="label label-default">Problem Description</span></h3>
              <textarea class="form-control" rows="10" id="comment" name="description"></textarea>
              <?php// print_r($sections);?>
            </div>
            <div>
              <h3><span class="label label-default">Answer</span></h3>
              <input type="text" class="form-control" id="usr" name="answer">
            </div>
            <div>
              <br><button type="submit" class="btn btn-primary">Submit Problem</button>
            </div>
          </form>
        </div>
       </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo base_url("assets/js/bootstrap.min.js");?>"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="<?php echo base_url("assets/js/vendor/holder.min.js");?>"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url("assets/js/ie10-viewport-bug-workaround.js");?>"></script>
  </body>
</html>
