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
    <link rel="stylesheet" href="<?php echo base_url("assets/css/button.css");?>">
    <title>BrainTeaser : An interactive problem solving ground</title>

    <!-- Bootstrap core CSS -->
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
          
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="<?php echo site_url('start/home');?>"><b>HOME </b><span class="sr-only">(current)</span></a></li>
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
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 class="page-header">Latest Updates</h2>

          <div class="row placeholders">
            <div class="col-xs-6 col-sm-9 placeholder">
              <h3>New problem</h3>
              <h4><b><i><?php echo $title; ?></i></b></h4><span class="text-muted"> (<?php echo $point; ?> points)</span><br>
              
              <p>
                <!-- <h4>If 2^5 * 2^a = 2^11, then what is the value of a?</h4> -->
                <?php 
                  echo nl2br("<h4>".$statement."</h4>"); 
                  $_POST['id'] = $p_id;
                ?>
              </p>
              
              <span class="text-muted">by <?php echo $problem_setter; ?></span><br>
              <span class="text-muted"><?php echo $category; ?> ( <?php echo $section; ?> )</span><br>
              <form id="submitform" class="form-horizontal" role="form" action="<?php echo  site_url('start/vote_problem/'.$p_id);?>" method = "post">
               <button type="submit" class="btn btn-primary">Like (<?php echo $vote_count; ?>)</button>
             </form>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <?php 
              if($solved == 0){
              echo '
              <h3>Submit Your Answer Here</h3>
              <form id="submitform" class="form-horizontal" role="form"  action='; echo site_url('start/submit_result/'.$p_id);echo ' method = "post">
                <input type="text"  name= "result" class="form-control" placeholder="Type Your Answer Here..." aria-label="Amount (to the nearest dollar)"><br>
                <button type="submit" class="btn btn-success">Submit</button>
              </form>
               <span class="text-muted">'; echo "Can't solve this? You can see solution here (but no points then!)"; echo '</span>
              <form id="submitform" class="form-horizontal" role="form"  action='; echo site_url('start/show_solution_method/'.$p_id);echo ' method = "post">
                 <!--<button type="submit" class="btn btn-warning">See Solution</button>-->
                 <button class="myButton2"><span>See Solution </span></button>
              </form>
              <br>
             ';}
              else{
              echo "
              <h3>You've Solved It!!!</h3>"; echo '
              <form id="submitform" class="form-horizontal" role="form"  action='; echo site_url('start/solution_method/'.$p_id);echo ' method = "post">
                <textarea class="form-control" name="solutionMethod" rows="5" id="comment" placeholder="Put Your Solution Method Here to Share It With Others..." ></textarea><br>
                <button type="submit" class="btn btn-success">Submit</button>
              </form>
              <span class="text-muted">'; echo "Or, You can also "; echo '</span>
              <form id="submitform" class="form-horizontal" role="form"  action='; echo site_url('start/show_solution_method/'.$p_id);echo ' method = "post">
                 <!--<button type="submit" class="btn btn-warning">See Solution</button>-->
                 <button class="myButton2"><span>See Solution </span></button>
              </form>';}
              ?>
            </div>
           
          </div>

          <h2 class="sub-header">Top 5 Problems</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Problems</th>
                  <th>Solve Here</th>
                </tr>
              </thead>
              <tbody>
               
                  <?php
                  $temp = 0;
                  foreach ($top as $problem) {
                    //print_r($problem);
                    $temp = $temp+1;
                    $pr_id = $problem['problem_id'];
                    echo '<tr>';
                    echo '<td>'.$temp.'</td>';
                    echo  '<td>';
                    echo '<h4><i><b>'.$problem['title'].'</b></i></h4><span class="text-muted">('.$problem['point'].' points)</span>';
                    echo nl2br("<h4>".$problem['statement']."</h4>"); 
                   echo '<span class="text-muted">by '.$problem['setter'].'</span><br>
                        <span class="text-muted">'.$problem['cat'].' ('.$problem['sec'].')</span>
                        <form id="submitform" class="form-horizontal" role="form" action='; echo site_url('start/vote_problem/'.$pr_id); echo ' method = "post">
                          <button type="submit" class="btn btn-primary">Like ('.$problem['vote_count'].')</button>
                        </form>
                        
                   </td>

                  <td>';
                  if($problem['solved'] == 0){
                    echo '
                    <form id="submitform" class="form-horizontal" role="form"  action='; echo site_url('start/submit_result/'.$pr_id);echo ' method = "post">
                      <input type="text" name="result" class="form-control" placeholder="Type Your Answer Here..." ><br>
                      <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                    <span class="text-muted">'; echo "Can't solve this? You can see solution here (but no points then!)"; echo '</span>
                    <form id="submitform" class="form-horizontal" role="form"  action='; echo site_url('start/show_solution_method/'.$pr_id);echo ' method = "post">
                       <!--<button type="submit" class="btn btn-warning">See Solution</button>-->
                        <button class="myButton2"><span>See Solution </span></button>
                    </form>';}
                    else{
                      echo "
                      <h4>You've Solved It!!!</h4>"; echo '
                    <form id="submitform" class="form-horizontal" role="form"  action='; echo site_url('start/solution_method/'.$pr_id);echo ' method = "post">
                      <textarea class="form-control" name="solutionMethod" rows="5" id="comment" placeholder="Put Your Solution Method Here to Share It With Others..." ></textarea><br>
                      <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                    <span class="text-muted">'; echo "Or, You can also ..."; echo '</span>
                    <form id="submitform" class="form-horizontal" role="form"  action='; echo site_url('start/show_solution_method/'.$pr_id);echo ' method = "post">
                       <!--<button type="submit" class="btn btn-warning">See Solution</button>-->
                        <button class="myButton2"><span>See Solution </span></button>
                    </form>
                    ';}
                    echo '
                  </td>
                  
                </tr>
                <tr>
                  <td><br></td>
                  <td><br></td>
                  <td><br></td>';

                  echo '</tr>';
                  }
                  ?>  
              
              </tbody>
            </table>
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
