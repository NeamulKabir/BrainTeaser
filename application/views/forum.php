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
    <title>Forum: A Community to Help Each Other</title>

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
            <li class="active"><a href="<?php echo site_url('start/forum');?>"><b>FORUM</b></a></li>
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
                </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
       <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 class="page-header">FORUM</h2>

          <div class="row placeholders">
            <div class="col-sm-9 col-sm-offset-3 col-md-8 col-md-offset-2 main">
            <h2 class="page-header">Add A New Post</h2>
            <form id="forumform" class="form-horizontal" role="form" action="<?php echo site_url('start/forum_post');?>" method = "post">
              <div>
               
                <h3><span class="label label-default">Description</span></h3>
                <textarea class="form-control" rows="10" id="comment" name= "forum_post"></textarea>

              </div>
              <div>

                <br><button type="submit" class="btn btn-primary">POST</button>
                
            </div>
          </form>
          </div>
           
          </div>

          <h2 class="sub-header">All Posts</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width:5px"></th>
                  <th style="width:200px"></th>
                  <th style="width:200px"></th>
                </tr>
              </thead>
              <tbody>
              <?php
                    $i=1;
                    foreach ($f_post as $key ) {
                      # code...
                      echo   "<tr>";
                      echo '<td>'.$i.'</td>';
                      echo '<td>'.$key['post'].' <span class="text-muted">posted by '.$key['poster'].'</span>';
                      $id = $key['forum_id'];
                      echo '<br><br>';
                      for($t=0;$t<sizeof($comments[$id]);$t++){
                      echo'<h5>'.$comments[$id][$t]['comment'].' <span class="text-muted">by '.$comments[$id][$t]['name'].'</span></h5>
                      <br>';}
                      echo '
                      <form id="forumform" class="form-horizontal" role="form" action=';echo site_url('start/comment/'.$id); echo ' method = "post" >
                      <input type="text" class="form-control" placeholder="Comment Here..." name ="comment" ><br>
                      </form>
                     </td>
                     <td>
                      <form id="forumform" class="form-horizontal" role="form" action=';echo site_url('start/vote_post/'.$id); echo ' method = "post" >
                        <button type="submit" class="btn btn-warning">VOTE ('.$key['vote'].')</button>
                        
                      </form>
                      <form id="forumform" class="form-horizontal" role="form" action=';echo site_url('start/delete_post/'.$id); echo ' method = "post" >
                      <button type="submit" class="btn btn-danger">DELETE </button>
                      </form>
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
                  <td>How the 3 no problem is solved in Algebra, chapter 1, section 2. The problem title is Josephus problem. I tried it, but i couldn't reach any solution. MAy be my method was wrong. Can anybody help?
                    <br><br>
                    <input type="text" class="form-control" placeholder="Comment Here..." ><br>
                  </td>
                  <td>
                    <form>
                      <button type="submit" class="btn btn-warning">VOTE</button>
                      <button type="submit" class="btn btn-danger">DELETE</button>
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
                  <td>How the 3 no problem is solved in Algebra, chapter 1, section 2. The problem title is Josephus problem. I tried it, but i couldn't reach any solution. MAy be my method was wrong. Can anybody help?
                    <br><br>
                    <input type="text" class="form-control" placeholder="Comment Here..." ><br>
                  </td>
                  <td>
                    <form>
                      <button type="submit" class="btn btn-warning">VOTE</button>
                      <button type="submit" class="btn btn-danger">DELETE</button>
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
                  <td>How the 3 no problem is solved in Algebra, chapter 1, section 2. The problem title is Josephus problem. I tried it, but i couldn't reach any solution. MAy be my method was wrong. Can anybody help?
                    <br><br>
                    <input type="text" class="form-control" placeholder="Comment Here..." ><br>
                  </td>
                  <td>
                    <form>
                      <button type="submit" class="btn btn-warning">VOTE</button>
                      <button type="submit" class="btn btn-danger">DELETE</button>
                    </form>
                  </td>
                  
                </tr>
                <tr>
                  <td><br></td>
                  <td><br></td>
                  <td><br></td>
                  
                </tr>
                <tr>
                  <td>5</td>
                  <td>How the 3 no problem is solved in Algebra, chapter 1, section 2. The problem title is Josephus problem. I tried it, but i couldn't reach any solution. MAy be my method was wrong. Can anybody help?
                    <br><br>
                    <input type="text" class="form-control" placeholder="Comment Here..." ><br>
                  </td>
                  <td>
                    <form>
                      <button type="submit" class="btn btn-warning">VOTE</button>
                      <button type="submit" class="btn btn-danger">DELETE</button>
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
