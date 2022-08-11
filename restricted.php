<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Demo Page 1 | EPQ Web Design Demo</title>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<a class="navbar-brand" href="http://epq.block2block.me/">EPQ - Web Design</a>
    		</div>
    		<ul class="nav navbar-nav">
      			<li><a href="\">Home</a></li>
      			<li class="active"><a href="#">Demo Page 1</a></li>
      			<li class="dropdown">
        			<a class="dropdown-toggle" data-toggle="dropdown" href="#">Example Dropdown Menu
        			<span class="caret"></span></a>
        			<ul class="dropdown-menu">
          				<li><a href="#">Example Item</a></li>
          				<li><a href="#">Another Example Item</a></li>
        			</ul>
      			</li>
			</ul>
    		<ul class="nav navbar-nav navbar-right">
				<?php
				include_once 'accounts/functions.php';
				include_once 'accounts/db-connect.php';
				
				sec_session_start();
				
				if (login_check($mysqli)) :?>
					<li class="dropdown" style="font-family: Helvetica;">
        			<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Hello, <?php echo get_name($_SESSION['user_id'],$mysqli)?>
        			<span class="caret"></span></a>
        			<ul class="dropdown-menu">
						<li><a href="account"><span class="glyphicon glyphicon-user"></span> Account Details</a></li>
          				<li><a href="accounts/process-logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        			</ul>
      			</li>
				 <?php else : ?>
					<li><a href="register"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      				<li><a href="login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
				
				<?php endif; ?>
      			
    		</ul>
  		</div>
	</nav>
	
	<div class="jumbotron text-center bg" style="background-image: url(http://files.block2block.me/uploads/jw8u8I9m3L.jpg); background-size: cover; height: 100%; background-position: center;">
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
    	<h1>Demo Page 1</h1>
    	<p class="lead">This is an example page of restriected content that is only visible to people who are logged in.</p>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
	</div>
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2"></div> <!-- Gap at left side of form -->
			<div class="col-sm-8 col-xs-12">
				<h1><Strong>Demo Restricted Page</Strong></h1>
				<p style="font-size: 17px; font-family: 'Helvetica'">This is a demo of a page that can only be viewed by those who are logged in. For those that are not logged in, you will not be able to see anything that is below this little paragraph.</p>
				
				<?php if (login_check($mysqli)): ?>
					<legend style="font-family: 'Helvetica';">How does this work?</legend>
					<p style="font-size: 17px; font-family: 'Helvetica'">As the page loads, it will check to see if the user has an active session, and will display this if the login check was passed. You may have heard of cookies before from previous companies like Google, saying that their website uses cookies. Cookies essentially allow websites to track your individual browser while visiting their site. They are able to set values in cookies, which essentially allow them to tell it's you. This is how the login system works. Without cookies, this would not work.</p>
					<br>
					<br>
					<legend style="font-family: 'Helvetica';">Couldn't a user just change their cookies to be logged in as someone else?</legend>
					<p style="font-size: 17px; font-family: 'Helvetica'">Most browsers do not allow users to edit their own cookies, or even see what's inside them. However, as a precaution, this website has a special token stored in the cookie which is used to identify a specific browser, comprising of an encrypted password and a code used to identify the users specific browser. This way, users are not able to just change their cookie to be logged in as someone else.</p>
					<br>
					<br><legend style="font-family: 'Helvetica';">Ok, that's cool. What else are you able to do with the website then?</legend>
					<img src="http://files.block2block.me/uploads/jo4Kd4hSDA.jpg" style="display: block;max-width: 20%;height: auto;float: right;margin: 0px 0px 4px 10px;">
					<p style="font-size: 17px; font-family: 'Helvetica'">There are many things you can do with this. For instance, there is an image attached to the right of this section. This image could be anything, from an explanatory diagram to a staff picture with a staff testiment here. There are many possible combinations of things you can do with a combination of Bootstrap and CSS. If you use the newer version of Bootstrap, you can also do more things, including cards whici is like a personal profile. With PHP, you can also implement features such as an announcement system or a news system, which don't require the user to know CSS or HTML in order to change the web page.</p>
				<?php else: ?>
					<br>
					<p style="font-size: 17px; font-family: 'Helvetica'">You must be logged in to see this content. Please <a href="/login">log in</a> or <a href='/register'>register</a> to an account.</p>
				<?php endif;?>
			</div>
			<div class="col-sm-2"></div> <!-- Gap at right side of form -->
		</div>
		<hr>	
		<div class="row border-between">
		  <div class="col-sm-2"></div> <!-- Gap at left side of links -->
			<div class="col-sm-2 text-center">
				<h4><strong><u>About</u></strong></h4>
				<p style="font-family: Helvetica;">This website is to show the capabilities of Web Design and Development. I really wanted to showcase what was possible and how any company and person can make a website that not only looks great, but has good capabilities too. Feel free to explore any part of the site, create an account or even look at some of the HTML running the site (although you might not understand all of it!).</p>
			  <p></p>
		  </div>
		  <div class="col-sm-1"></div>
			<div class="col-sm-2 text-center">
				<h4><strong><u>Links</u></strong></h4>
				<p style="font-family: Helvetica;"><a href="/">Home Page</a></p>
				<p style="font-family: Helvetica;"><a href="/restricted">Demo Page 1</a></p>
			</div>
			<div class="col-sm-1"></div>
			<div class="col-sm-2 text-center">
				<h4><strong><u>Accounts</u></strong></h4>
				<p style="font-family: Helvetica;"><a href="/register">Sign Up</a></p>
				<p style="font-family: Helvetica;"><a href="/login">Log In</a></p>
				<p style="font-family: Helvetica;"><a href="/account">Account Details</a></p>
			</div>
			
			<div class="col-sm-2"></div> <!-- Gap at right side of form -->
		</div>
	</div>
</body>
</html>