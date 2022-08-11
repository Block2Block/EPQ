<?php
include_once 'accounts/db-connect.php';
include_once 'accounts/functions.php';
 
sec_session_start();
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login | EPQ Web Design Demo</title>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script>
	
	<style>
	input[type=text], select, input[type=password], textarea, input[type=date], input[type=email] {
    	width: 100%;
    	padding: 12px 20px;
    	margin: 8px 0;
    	display: inline-block;
    	border: 1px solid #ccc;
    	border-radius: 4px;
    	box-sizing: border-box;
		font-family: 'Century Gothic';
	}

	input[type=button], input[type=submit] {
    	width: 100%;
    	background-color: #4CAF50;
    	color: white;
    	padding: 14px 20px;
   		margin: 8px 0;
    	border: none;
    	border-radius: 4px;
    	cursor: pointer;
	}

	input[type=button]:hover {
    	background-color: #45a049;
	}

	</style>
</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<a class="navbar-brand" href="http://epq.block2block.me/">EPQ - Web Design</a>
    		</div>
    		<ul class="nav navbar-nav">
      			<li><a href="/">Home</a></li>
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
      				<li class="active"><a href="login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
				
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
    	<h1>Login</h1>
    	<p class="lead">Log in to your already existing account. If you do not already have one, please register at <a href="register">epq.block2block.me/register</a>.</p>
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
				<h1><Strong>Log in</Strong></h1>
				<?php if (login_check($mysqli)):
					echo '<p>You are already logged in as ' . get_name($_SESSION['user_id'],$mysqli) . '.</p>';
					echo '<p>Click <a href="/">here</a> to go to the home page.</p>'; 
				 else: ?>
				<p style="font-size: 18px">Use this page to log into an account that you have created. If you have not created an account, then please sign up at <a href="register">epq.block2block.me/register</a>.</p> <br>
				
				<div id="alerts">
				
				</div>
				
				<form action="accounts/process-login.php" method="post" name="login_form" style="font-family: 'Helvetica';">
					
					<fieldset style="font-family: 'Helvetica';">
    				<legend style="font-family: 'Helvetica';">Registration Form</legend>
						
					Email:<input type='email' name='email' id='email'/><br>
					Password: <input type="password" name="password" id="password"/><br>
					<input type="button" value="Login" onclick="formhash(this.form, this.form.email, this.form.password);" /> 
					
						
				</form>
				<?php endif; ?>
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