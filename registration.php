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
    	<link rel="stylesheet" href="resources/css/registration.css">
    	<link rel="shortcut icon" href="resources\Augfavicon.ico" type="image/x-icon">

	</head>

	<body>
		<div class="header">
			<h1>
				<a href="index.php">Augustana Student Academic Conference</a>
			</h1>
		</div>
	
		<div id="submitField" class ="callout secondary">
			<h3 id="registerDisplay">
				Register Here
			</h3>
			<form id="submitForm" action="index.php" method="GET">
				<input name="username" type="text" placeholder="Username" required>
				<input name="name" type = "text" placeholder="Name" required>
				<input name="email" type="text" placeholder="UAlberta Email" required>
				<input name="confirmEmail" type="text" placeholder="Confirm UAlberta Email" required>
				<input name="password" type="password" placeholder="Password" required>
				<input name="confirmPassword" type="password" placeholder="Confirm Password" required>
				<input value="Register" type="submit">
			</form>
		</div>
		<div class="footer">
			Designed January 7th, 2018<br>
  			by Sheldon Grundberg, Alex Ho, and Connor Maschke.
		</div>
		<script src="js/vendor/foundation.js"></script>
    	<script src="js/app.js"></script>
	</body>
</html>