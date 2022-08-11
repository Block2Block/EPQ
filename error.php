<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Error | EPQ Web Design Demo</title>
	
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
    	<h1>Error</h1>
    	<p class="lead">Uh oh! Something went wrong!</p>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
	</div>
</body>
</html>