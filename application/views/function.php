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
    <title>Sections Of A Catefory</title>

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
             <li class="active" style="padding-left: 20px"><b>TOPICS</b>
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
          <h2 class="page-header"><?php echo $cat_name; ?></h2>
          <?php echo'
          <h3 class="sub-header">Problems On: <i><b>'.$name['section_name'].'</b></i></h3>';
          ?>
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
                    $i=1;
                    foreach ($problems as $key) {
                        echo '<tr>';
                        echo '<td>'.$i.'</td>';
                        echo '<td>';
                        $id = $key['problem_id'];
                        echo "<h4><b><i>".$key['title']."</i></b></h4>";
                        echo nl2br("<h4>".$key['statement']."</h4>");
                        echo '<br>
                        <span class="text-muted">by '.$key['setter'].'</span><br>
                        <span class="text-muted">'.$key['cat'].' ('.$key['sec'].')</span><br>
                        <form id="submitform" class="form-horizontal" role="form" action='; echo  site_url('start/vote_problem/'.$id); echo ' method = "post">
                          <button type="submit" class="btn btn-primary">Like (';echo $key['vote_count']; echo')</button>
                        </form>
                        </td>
                      <td>';
                        if($key['solved'] == 0){
                          echo '
                          <form id="submitform" class="form-horizontal" role="form" action='; echo  site_url('start/submit_result1/'.$id); echo ' method = "post">
                            <input type="text" name = "result" class="form-control" placeholder="Type Your Answer Here..." ><br>
                            <input type="hidden" name="prb_id" value='.$id.'>
                            <button type="submit" class="btn btn-success">Submit</button>
                          </form>
                          <span class="text-muted">'; echo "Can't solve this? You can see solution here (but no points then!)"; echo '</span>
                          <form id="submitform" class="form-horizontal" role="form"  action='; echo site_url('start/show_solution_method/'.$id);echo ' method = "post">
                             <!--<button type="submit" class="btn btn-warning">See Solution</button>-->
                              <button class="myButton2"><span>See Solution </span></button>
                          </form>';}
                        else{
                          echo "
                           <h3>You've Solved It!!!</h3>"; echo '
                          <form id="submitform" class="form-horizontal" role="form"  action='; echo site_url('start/solution_method/'.$id);echo ' method = "post">
                            <textarea class="form-control" name="solutionMethod" rows="5" id="comment" placeholder="Put Your Solution Method Here to Share It With Others..." ></textarea><br>
                            <button type="submit" class="btn btn-success">Submit</button>
                          </form>

                          <span class="text-muted">'; echo "Or, You can also..."; echo '</span>
                          <form id="submitform" class="form-horizontal" role="form"  action='; echo site_url('start/show_solution_method1/'.$id);echo ' method = "post">
                             <!--<button type="submit" class="btn btn-warning">See Solution</button>-->
                              <button class="myButton2"><span>See Solution </span></button>
                          </form>';}
                          echo '
                        </td>
                        
                      </tr>
                      <tr>
                        <td><br></td>
                        <td><br></td>
                        <td><br></td>
                        
                      </tr>';
                      $i++;
                    }


                ?>
                <!-- <tr>
                  <td>2</td>
                  <td>If a and b are both odd integers, which of the following MUST also be an odd integer?
                    <br>1.  a+b <br> 2.  a-b<br>3.  a*b <br>4.  a/b<br>
                    <span class="text-muted">Basic Mathematics (Topic Tags)</span><br>
                    <span class="text-muted">Problem Setter</span>
                  </td>
                  <td>
                    <form>
                      <input type="text" class="form-control" placeholder="Type Your Answer Here..." ><br>
                      <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                  </td>
                  
                </tr>

                <tr>
                  <td><br></td>
                  <td><br></td>
                  <td><br></td>
                  
                </tr>

                <tr>
                  <td>3</td>
                  <td>Which equation is an illustration of the additive identity property?<br>1.(x)•(1) = x <br>2.  x + 0 = x<br> 
                    3.  x - x = 0<br>    4.  (x)•(1/x) = 1<br>
                    <span class="text-muted">Basic Mathematics (Topic Tags)</span><br>
                    <span class="text-muted">Problem Setter</span>
                  </td>
                  <td>
                    <form>
                      <input type="text" class="form-control" placeholder="Type Your Answer Here..." ><br>
                      <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                  </td>
                  
                </tr>
                <tr>
                  <td><br></td>
                  <td><br></td>
                  <td><br></td>
                  
                </tr>
                <tr>
                  <td>4</td>
                  <td>If a and b are both odd integers, which of the following MUST also be an odd integer?
                    <br>1.  a+b <br> 2.  a-b<br>3.  a*b <br>4.  a/b<br>
                    <span class="text-muted">Basic Mathematics (Topic Tags)</span><br>
                    <span class="text-muted">Problem Setter</span>
                  </td>
                  <td>
                    <form>
                      <input type="text" class="form-control" placeholder="Type Your Answer Here..." ><br>
                      <button type="submit" class="btn btn-success">Submit</button>
                  </td>
                  
                </tr>

                <tr>
                  <td><br></td>
                  <td><br></td>
                  <td><br></td>
                  
                </tr>
                 <tr>
                  <td>5</td>
                  <td>If a and b are both odd integers, which of the following MUST also be an odd integer?
                    <br>1.  a+b <br> 2.  a-b<br>3.  a*b <br>4.  a/b<br>
                    <span class="text-muted">Basic Mathematics (Topic Tags)</span><br>
                    <span class="text-muted">Problem Setter</span>
                  </td>
                  <td>
                    <form>
                      <input type="text" class="form-control" placeholder="Type Your Answer Here..." ><br>
                      <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                  </td>
                  
                </tr>
                <tr>
                  <td><br></td>
                  <td><br></td>
                  <td><br></td>
                  
                </tr> -->
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
