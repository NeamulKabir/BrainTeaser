<!DOCTYPE html>
<html lang="en">
  <head>
	   <meta charset="utf-8">
	   <meta http-equiv="Content-Type" content="text/html" />
       <title>Brain Teaser</title>
       <link rel="stylesheet" href="<?php echo base_url("assets/css/my.css");?>"/>
	   <script type="text/javascript" src="<?php echo base_url("assets/js/jquery-1.10.2.min.js");?>"> </script>
       <link href='http://fonts.googleapis.com/css?family=Wellfleet' rel='stylesheet' type='text/css'>
	   <link href='http://fonts.googleapis.com/css?family=Wellfleet' rel='stylesheet' type='text/css'>
	   <link href='http://fonts.googleapis.com/css?family=Arvo:400,700,400italic,700italic' rel='stylesheet' type='text/css'>	
	   <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	   <link href='http://fonts.googleapis.com/css?family=Goudy+Bookletter+1911' rel='stylesheet' type='text/css'>
	   <script>
			<!----- JQUERY FOR SLIDING NAVIGATION --->   
			$(document).ready(function() {
			  $('a[href*=#]').each(function() {
			    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
			    && location.hostname == this.hostname
			    && this.hash.replace(/#/,'') ) {
			      var $targetId = $(this.hash), $targetAnchor = $('[name=' + this.hash.slice(1) +']');
			      var $target = $targetId.length ? $targetId : $targetAnchor.length ? $targetAnchor : false;
			       if ($target) {
			         var targetOffset = $target.offset().top;

			<!----- JQUERY CLICK FUNCTION REMOVE AND ADD CLASS "ACTIVE" + SCROLL TO THE #DIV--->   
			         $(this).click(function() {
			            $("#nav li a").removeClass("active");
			            $(this).addClass('active');
			           $('html, body').animate({scrollTop: targetOffset}, 100);
			           return false;
			         });
			      }
			    }
			  });

			});
		</script>
  </head> 
	
	<body>
		<!-- --- LINK BACK TO THE TUTORIAL- -->  
		<div id="demo_back">
		<a href="#" class="lpanel"> << Go Back To Google.com </a>
		<a href="#" class="rpanel"> Click A Number >> </a>
		</div>

		<!----- HEADER START- -->   
		<header id="header">
		<div class="content">
			<div id="logo"><a href=""> BrainTeaser </a></div>
					
					
				
			<nav id="na">
				
				<ul>
					<li id="rcorners1"><h3><a href="<?php echo site_url("start/login");?>"> LOG  IN </a></h3></li>
					<li id="rcorners1"><h3><a href="<?php echo site_url("start/signup");?>">SIGN  UP</a></h3></li>
					
					
				</ul>

			</nav>
		</div>
		<div class="content">
			<nav id="nav">
					<ul>
						<li><a href="#slide1" class="active" title="Next Section" >1</a></li>
						<li><a href="#slide2" title="Next Section">2</a></li>
						<li><a href="#slide3" title="Next Section">3</a></li>
						<li><a  href="#slide4" title="Next Section">4</a></li>
						<li><a href="#slide5" title="Next Section">5</a></li>
					</ul>
				</nav>
		</div>
		</header>	
		<!----- HEADER END- -->   

		<!----- SLIDES START - -->   	
		<div id="slide1">
			<div class="content">
				<div id="christmas_tree"> </div>
				<div id="snowflakes1"></div>
				<div id="snowflakes2"></div>
	            <h2>TEASE</h2>
			    <h1>YOUR BRAIN</h1>
			    <div id="divider"> </div>
			     <h3>LEARN, PRACTISE & CHERISH </h3>
	           <div id="ribbon"></div>
		       <div id="new_year"> </div>
			</div> 
	    </div> 

		<div id="slide2">
			<div class="content" >
	            
	            	<h2>Topics That You Can Explore Here</h3>
	            	<table>
	            		<thead>
	            			<td style="width:280px"></td>
	            			<td style="width:400px"></td>
	            		</thead>
	            		<tbody>
	            			<tr>
	            				<td></td>
	            				<td style="font-family:Helvetica; color:#660990"><h3>Algebra</h3></td>
	            				
	            			</tr>
	            			<tr>
	            				<td></td>
	            				<td style="font-family:Helvetica; color:#660990"><h3>Geometry</h3></td>
	            				
	            			</tr>
	            			<tr>
	            				<td></td>
	            				<td style="font-family:Helvetica; color:#660990"><h3>Number Theory</h3></td>
	            				
	            			</tr>
	            			<tr>
	            				<td></td>
	            				<td style="font-family:Helvetica; color:#660990"><h3>Calculus</h3></td>
	            				
	            			</tr>
	            			<tr>
	            				<td></td>
	            				<td style="font-family:Helvetica; color:#660990"><h3>Combinatorics</h3></td>
	            				
	            			</tr>
	            			<tr>
	            				<td></td>
	            				<td style="font-family:Helvetica; color:#660990"><h3>Basic Mathematics</h3></td>
	            				
	            			</tr>
	            			<tr>
	            				<td></td>
	            				<td style="font-family:Helvetica; color:#660990"><h3>Logic</h3></td>
	            				
	            			</tr>
	            			<tr>
	            				<td></td>
	            				<td style="font-family:Helvetica; color:#660990"><h3>Computer Science</h3></td>
	            				
	            			</tr>
	            		</tbody>
	            	</table>

			</div> 
	    </div> 
		
		
	   <div id="slide3">
			<div class="content">
				   <div class="quotes_container">
				   	<h3 class="quotes">Effective learning is interactive, not passive.</h3>

				<h4 id="fon">Want to get smarter, faster? This website lets you explore great, thought-provoking questions designed to guide you to a deep and lasting understanding of math, science, and engineering.</h4>
					
			       <h3 class="quotes">BrainTeaser is a network.</h3>

					<h4 id="font">	Problem solving together is the foundation of all great relationships in the sciences. You can write your own solution and get feedback from people around the world. Contribute a question or mentor someone who is learning. Other people will do the same for you. </h4>
			       <h4 class="author_name_white">-- BrainTeaser Team</h4>
			    </div> 
			</div> 
	    </div> 
		
		
		<div id="slide4">
			<div class="content">
	              <div class="quotes_container">
			    <h3 class="quotes"> Go from aspiration to excellence. <br> BrainTeaser has quizzes to help you master concepts quickly, a collaborative wiki with conceptual explanations and examples, short and fun video classes, and a network of over 1.5 million members to learn with. People on Brilliant help each other excel </h3>
			  
			</div> 
			</div> 
	    </div> 
		
		
		<div id="slide5">
			<div class="content">
	           <div class="quotes_container">
			    <h3 class="quotes">Inspire others.</h3>

			<h4 id="fon">"I have learnt much more than what is taught at school at Brilliant. I would like to say thank you to my peers here at Brilliant. You have taught me much from your explanations and solutions. Thank you to everyone here! :)"<br>

				--- Anqi Li, Singapore<br><br>

			"I'm so happy to be selected for the Indian National Mathematical Olympiad. Thank you, Brilliant, for the support and direction. You're all heroes for me."<br>

			--- Aditya Raut, India<br> </h4>
			    
			  </div> 
			<div id="copyright"><a href="#rat_race_2">Copyright rat_race_2.com </a></div>  
			</div> 
	    </div> 
	
		<!----- SLIDES END - -->
	</body>
</html>
