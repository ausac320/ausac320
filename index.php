<!-- 
AUCSC320 - Augustana Student Academic Conference

January 11, 2018

index.php is the basic page that will be displayed when the website is called 
in the browser. 

It is the login screen that will authentication to allow access to the rest of
the program. 

Contained is a google authentication that will be linked to @ualberta.ca emails
this is to ensure that the user is registered with the University of Alberta.

In order for the Google authentication to function properly, the webhost server is 
set to a localhost named  augsac.
If the local webhost is not named this way, google will not be able to authenticate due 
to the program being hosted offline and not a live site. 
-->

<!doctype html>
<html class="no-js" lang="en" dir="ltr">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="google-signin-client_id" content="514360117392-qkk1ff10ud9svjk0mm08piuvmncregp6.apps.googleusercontent.com">
    	<title>Augustana Student Academic Conference Website</title>
		<link rel="stylesheet" href="resources/css/foundation.css">
    	<link rel="stylesheet" href="resources/css/app.css">
    	<link rel="stylesheet" href="resources/css/index.css">
    	<link rel="shortcut icon" href="resources\images\Augfavicon.ico" type="image/x-icon">
	</head>
	
	<body>
		<div class="header">
			<h1>
				<a href="index.php">Augustana Student Academic Conference</a>
			</h1>
		</div>

		<div id="loginField" class="callout secondary">
			<h3 id="loginDisplay">Login</h3>
			<form id="loginForm" action="userpage.php" method="POST">
				<div class="g-signin2" data-onsuccess="onSignIn" required>
				</div>
				<input name="username" type="text" placeholder="CCID" required>
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
		<script src="https://apis.google.com/js/platform.js" async defer></script>
    	<script src="js/app.js"></script>
	</body>
</html>
