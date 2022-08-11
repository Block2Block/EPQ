<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home | EPQ Web Design Demo</title>
	
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
      			<a class="navbar-brand" href="http://scapegoat.block2block.me/">EPQ - Web Design</a>
    		</div>
    		<ul class="nav navbar-nav">
      			<li class="active"><a href="#">Home</a></li>
      			<li><a href="restricted">Demo Page 1</a></li>
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
    	<h1>Welcome</h1>
    	<p class="lead">Welcome to my Demo EPQ Website to demonstrate web design! Please take your time to explore the website and find cool things!
			<br>Feel free to also try out the accounts system! It actually works!</p>
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
				<h1><Strong>My EPQ Demo Website</Strong></h1>
				<legend style="font-family: 'Helvetica';">So, what's this about?</legend>
				<p style="font-size: 17px; font-family: 'Helvetica'">I really wanted to showcase what was possible with the use of the various languages that are available for use to create websites, and how websites such as these are hosted. I wanted to create a Demo site that uses CSS (Cascading Style Sheets) and some external libraries (like libraries you would visit, contains extra information that I can use) in order to make an appealing website that has functionality that companies or individuals might want.</p>
				<br>
				<br>
				<legend style="font-family: 'Helvetica';">That's pretty cool. So what does this website do?</legend>
				<p style="font-size: 17px; font-family: 'Helvetica'">This website contains some very basic functionality. It has an account system, where you can sign up, login and manage account details such as name and password. Those features can be found by using the buttons at the right of the navigation bar at the top of the page. On that note, I also have a working navigation bar for easy navigation website. I also included an example dropdown menu (which doesn't go anywhere) just to show how the Navigation bar can be used.</p>
				<br>
				<br>
				<legend style="font-family: 'Helvetica';">So how would something like this be hosted?</legend>
				<p style="font-size: 17px; font-family: 'Helvetica'">Well that is reletively simple depending on your level of understanding. All websites are hosted on something called a HTTP server (Hyper-text transfer protocol - a protocol is basically a set of rules telling a computer how to handle data). The particular one I am using is called Apache. For websites which are dynamic - meaning the content can change based on the person who visits it, it will need an extra addon called PHP, which is another programming language which adds functionality for things like a login system (hence I have this addon installed).</p>
				<br>
				<br>
				<legend style="font-family: 'Helvetica';">How does the website get from the server to my browser then?</legend>
				<p style="font-size: 17px; font-family: 'Helvetica'">When you enter the address of the page you wish to visit, it first sends a request to a DNS server. The address you type, also called a Domain, is converted into an address of the server you a trying to visit, called an IP address. This tells your browser where on the internet the server is located. Once it knows this, it then sends a request to the HTTP server located at the address asking for a webpage to display. If the webpage requested is dynamic, the server will do some processing, and will then return the HTML file and appropriate script and CSS files and your browser then interprets the code it is given and displays the webpage, such as this.</p>
				<br>
				<br>
				<legend style="font-family: 'Helvetica';">How has the website changed from your original plan?</legend>
				<p style="font-size: 17px; font-family: 'Helvetica'">Originally, I would have made the website dark, as this is the kind of website people prefered as white websites can sometimes be hard to look at. Due to time limitations, I did not have time to figure out colours that work well to make a dark theme for the website. I also planned to do some sort of announcement system, but again could not do that due to time constraints.</p>
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