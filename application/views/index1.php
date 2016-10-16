<!DOCTYPE html>
<html lang="en">
  <head>
	   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
       <title>Creating a Simple Parallax Scrolling Website</title>
       <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css");?>"/>
	   <script type="text/javascript" src="<?php echo base_url("assets/js/jquery-1.10.2.min.js");?>"</script>
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
<a href="#" class="lpanel"> << BACK TO THE 1STWEBDESIGN ARTICLE </a>
<a href="#" class="rpanel"> NEXT DEMO >> </a>
</div>

<!----- HEADER START- -->   
<header id="header">
<div class="content">
<div id="logo"><a href=""> PARALLAX </a></div>

<nav id="nav">
	<ul>
		<li><a href="#slide1" class="active" title="Next Section" >Slide 1</a></li>
		<li><a href="#slide2" title="Next Section">Slide 2</a></li>
		<li><a href="#slide3" title="Next Section">Slide 3</a></li>
		<li><a  href="#slide4" title="Next Section">Slide 4</a></li>
		<li><a href="#slide5" title="Next Section">Slide 5</a></li>
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
            <h2>MERRY</h2>
		    <h1>CHRISTMAS</h1>
		    <div id="divider"> </div>
		     <h3>HAPPY NEW YEAR </h3>
           <div id="ribbon"></div>
	       <div id="new_year"> </div>
		</div> 
    </div> 

	<div id="slide2">
		<div class="content" >
            <div class="quotes_container">
		    <h3 class="quotes">“Then the Grinch thought of something he hadn't before! What if Christmas, he thought, doesn't come from a store. What if Christmas...perhaps...means a little bit more!”</h3>
		  <img src="<?php echo base_url("assets/img/dr-seuss.png");?>" align="left"/> <h4 class="author_name_gray">Dr. Seuss </h4>
		</div> 
		</div> 
    </div> 
	
	
   <div id="slide3">
		<div class="content">
			   <div class="quotes_container">
		       <h3 class="quotes">“I truly believe that if we keep telling the Christmas story, singing the Christmas songs, and living the Christmas spirit, we can bring joy and happiness and peace to this world.”  </h3>
		      <img src="<?php echo base_url("assets/img/norman.png");?>" align="left"/> <h4 class="author_name_white">Norman Vincent Peale </h4>
		    </div> 
		</div> 
    </div> 
	
	
	<div id="slide4">
		<div class="content">
              <div class="quotes_container">
		    <h3 class="quotes">“Christmas doesn't come from a store, maybe Christmas perhaps means a little bit more....” </h3>
		  <img src="<?php echo base_url("assets/img/dr-seuss.png");?>" align="left"/> <h4 class="author_name_gray">Dr. Seuss </h4>
		</div> 
		</div> 
    </div> 
	
	
	<div id="slide5">
		<div class="content">
           <div class="quotes_container">
		    <h3 class="quotes">“My idea of Christmas, whether old-fashioned or modern, is very simple: loving others. Come to think of it, why do we have to wait for Christmas to do that?” </h3>
		    <img src="<?php echo base_url("assets/img/bob.png");?>" align="left"/> <h4 class="author_name_white">Bob Hope </h4>
		  </div> 
		<div id="copyright"><a href="http://www.1stwebdesigner.com/">Copyright 1stwebdesigner.com </a></div>  
		</div> 
		

    </div> 
	
<!----- SLIDES END - -->

</body>
</html>
