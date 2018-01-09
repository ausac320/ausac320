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
    	<link rel="shortcut icon" href="resources\Augfavicon.ico" type="image/x-icon">
	</head>
	<body>
		<div class="header">
			<h1>
				<a href="index.php">Augustana Student Academic Conference</a>
			</h1>
		</div>
		<div id="loginField" class="callout secondary">
			<h3 id="loginDisplay">
				Login
			</h3>
			<form id="loginForm" action="userpage.php" method="GET">
				<input name="username" type="text" placeholder="Username" required>
				<input name="password" type = "password" placeholder="Password" required>
				<input value="Submit" type="submit">
				<ul>
					<a href="registration.php">Don't have an account yet? Register Here</a>
				</ul>
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