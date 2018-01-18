<!--
	presSubmissions.php
	
	Description: 
	This page is for the user to be able to see all of their student submissions
	in one place as well as the information that was submitted for those students.
	If the information needs to be editted, there is an included edit button. 

	File Contents:
	This file contains the layout elements for the design of the submissions page 
	as well as the UI interactions that occur with the user.
-->

<!doctype html>
<html class="no-js" lang="en" dir="ltr">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> Augustana Student Academic Conference Website</title>
		<link rel="stylesheet" href="resources/css/vendor/foundation.css">
    	<link rel="stylesheet" href="resources/css/app.css">
    	<link rel="stylesheet" href="resources/css/presSubmissions.css">
    	<link rel="shortcut icon" href="resources\images\Augfavicon.ico" type="image/x-icon">

	</head>

	<body>
		<div class="header">
			<h1>
				<a href="index.php">Augustana Student Academic Conference</a>
			</h1>
		</div>

		<div id="submissionPageField" class="callout secondary">
			<div class="row.fullsize">
				<div class="large-2 medium-2 small-2 columns">
					<ul id="navMenu">
				  		<li>
				  			<a href="userpage.php" >Home</a>
				  		</li>
				  		<li>
				  			<a href="presRegister.php" >Register</a>
				  		</li>
				  		<li class="active">
				  			<a href="presSubmissions.php" >Submissions</a>
				  		</li>
				  		<li>
				  			<a href="scheduleSetup.php" >Schedule Setup</a>
				  		</li>
				  		<li>
				  			<a href="index.php" onclick="signOut();">Sign out</a>
				  		</li>
					</ul>
				</div>
				<div id="submissionsDisplayBox" class="large-8 medium-8 small-8 columns"></div>					
				<div class="large-2 medium-2 small-2 columns"></div>
			</div>	
		</div>

		<div class="footer">
			Designed January 7th, 2018<br>
  			by Sheldon Grundberg, Alex Ho, and Connor Maschke.
		</div>

		<script src="resources/js/vendor/jquery.js"></script>
    	<script src="resources/js/vendor/what-input.js"></script>
		<script src="resources/js/vendor/foundation.js"></script>
    	<script src="resources/js/app.js"></script>
    	<script src="resources/js/editableSubTable.js"></script>

	</body>
</html>
