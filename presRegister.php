<!--
AUCSC 320 - Augustana Student Academic Conference

Documentation by Sheldon Grundberg on January 12, 2018

presRegister.php is the presentation registration page, which will be displayed when the user clicks on the register button of the navigation column.

Contained is a form for submitting presentation information to the "database" (in the case of this project, it will most likely be a file directory). Currently this form has no logic attached to it for submitting the information.
-->
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> Augustana Student Academic Conference Website</title>
		<link rel="stylesheet" href="resources/css/foundation.css">
    	<link rel="stylesheet" href="resources/css/app.css">
    	<link rel="stylesheet" href="resources/css/presRegister.css">
    	<link rel="shortcut icon" href="resources\images\Augfavicon.ico" type="image/x-icon">
	</head>

	<body>
		<div class="header">
			<h1>
				<a href="index.php">Augustana Student Academic Conference</a>
			</h1>
		</div>

		<div id="registerPageField" class="callout secondary">
			<div class="row.fullsize">
				<div class="large-2 medium-2 small-2 columns">
					<ul id="navMenu">
				  		<li>
				  			<a href="userpage.php" >Home</a>
				  		</li>
				  		<li class="active">
				  			<a href="presRegister.php" >Register</a>
				  		</li>
				  		<li>
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
				<div id="newSubmission" class="large-8 medium-8 small-8 columns">
					<div>
						Presentation Registration Page
						<form action="presSubmissions.php" method="POST">
							<input name="studentName" type="text" placeholder="Student's name" required>
							<input name="courseName" type="text" placeholder="Course name" required>
							<input name="profName" type="text" placeholder="Professor's name" required>
							<div>
								Presentation Type:
								<input name="presentationType" type="radio" value="oral" required>Oral
								<input name="presentationType" type="radio" value="poster" required>Poster
								<input name="presentationType" type="radio" value="art" required>Art
								<input name="presentationType" type="radio" value="drama" required>Drama
								<input name="presentationType" type="radio" value="music" required>Music
							</div>
							<div>
								OURStatus:
								<input name="OURStatus" type="radio" value="yes" required>Yes
								<input name="OURStatus" type="radio" value="no" required>No
							</div> 
							<input name="titleOfPresentation" type="text" placeholder="Title of presentation" required>
							<input name="studentAbstract" type="text" placeholder="Student abstract">
							<input value="Submit Presentation" type="submit">
						</form>
					</div>
				</div>
				<div class="large-2 medium-2 small-2 columns">
				</div>
			</div>	
		</div>

		<div class="footer">
			Designed January 7th, 2018<br>
  			by Sheldon Grundberg, Alex Ho, and Connor Maschke.
		</div>

		<script src="js/vendor/foundation.js"></script>
    	<script src="js/app.js"></script>
	</body>
</html>
