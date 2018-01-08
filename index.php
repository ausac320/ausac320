<!doctype html>
<html class="no-js" lang="en" dir="ltr">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> 
			Augustana Student Academic Conference Website
		</title>
		<link rel="stylesheet" href="resources/css/foundation.css">
    	<link rel="stylesheet" href="resources/css/app.css">
	</head>

	<body>
		<div class="row">
			<div class="large-12 columns">
				<h1>
					Augustana Student Academic Conference
				</h1>
			</div>
		</div>

		<div class ="row">
			<h3>
				Please Login Here
			</h3>
		</div>
	
		<div class ="row">
			<form action="userpage.php" method="post">
				<input name="name" type="text" placeholder="Alex" required>
				<input name="lName" type = "text" placeholder="Ho" required>
				<input type="submit">
			</form>
		</div>

		<div class ="row">
				<form action="register.php">
    				<input type="submit" class="button" name="registerButton" value="Register" />
				</form>
		</div>

		<address>
			Made 07 January 2018<br>
  			by Alex Ho, Connor Maschke, Sheldon Grundberg.
		</address>

		<script src="js/vendor/foundation.js"></script>
    	<script src="js/app.js"></script>

	</body>


</html>