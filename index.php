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
		<link rel="stylesheet" href="resources/css/vendor/foundation.css">
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
			
				<input name="username" type="text" placeholder="Username">
				<input name="password" type = "password" placeholder="Password">
				<input value="Submit" type="submit">
				<ul>
					<a href="registration.php">Don't have an account yet? Register Here</a>
				</ul>
			</form>
		</div>

		<div class="footer">
			<div class="row footerSpace">
				<div class="large-4 medium-4 small-4 columns">
					<img src="resources/images/SAC Logo-1.png" alt="SAC Logo" >
				</div>
				<div class="large-4 medium-4 small-4 columns">
					<p>
						Designed January 7th, 2018<br>
  						by Sheldon Grundberg, Alex Ho, and Connor Maschke.
  					</p>
				</div>
				<div class="large-4 medium-4 small-4 columns contactInfo">
					<h3 class="underline">Contact Information</h3>
				</div>
			</div>
		</div>

		<?php
		if ($_SERVER["REQUEST_METHOD"] == 'POST'){
			$userName = ($_POST["username"]);
			$password = ($_POST["password"]);
			get_user_and_password_data();
			check_username_and_password($userName, $password, $dataArray);
		}
		?>

		<script src="resources/js/vendor/jquery.js"></script>
    	<script src="resources/js/vendor/what-input.js"></script>
		<script src="resources/js/vendor/foundation.js"></script>
		<script src="https://apis.google.com/js/platform.js" async defer></script>
    	<script src="resources/js/index.js"></script>
    	<script src="resources/js/app.js"></script>
    	<script src="resources/js/editableContactTable.js"></script>

    	<script type="text/javascript")>
			grabContactTextData();
		</script>

	</body>
</html>

<?php
//Sheldon's User Login System

function get_user_and_password_data(){
	$file = fopen("resources/data/userInfo.txt", "r");
	$fileData = fread($file, filesize($file));
	$dataArray = explode("\n",$fileData, 3);
	return $dataArray;
}

function check_username_and_password($userName, $password, $dataArray){
	while ($dataArray[$i] != null) {
		$i = 0; 
		$i++;
		if ($userName == $dataArray[$i][0] and $password == $dataArray[$i][1]) {
			$_SESSION['userName'] = $username;
			$_SESSION['permission'] = $dataArray[$i][2];
			return $_SESSION;
		}
		else{
			return $_SESSION;
		}
	}

}
?>