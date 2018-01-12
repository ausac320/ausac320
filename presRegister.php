<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<!-- 
		The head of this page simply sets up the necessary meta data, title, links to the proper css pages, and the link to the favicon.
	-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> Augustana Student Academic Conference Website</title>
		<link rel="stylesheet" href="resources/css/foundation.css">
    	<link rel="stylesheet" href="resources/css/app.css">
<<<<<<< HEAD
    	<link rel="stylesheet" href="resources/css/presRegister.css">
=======
>>>>>>> development
    	<link rel="shortcut icon" href="resources\images\Augfavicon.ico" type="image/x-icon">
	</head>

	<!--
		The body of this page contains three block elements, the "header" division which makes the top banner of the site, the "registerPageField" division, which creates the side navigation column of five buttons, and the "newSubmission" division which contains the form for presentation registration (the form does not have logic implemented into it currently, it is primarily for U.I. showcase).
	-->
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
						<form action="presSubmissions.php" method="GET">
							<input name="studentName" type="text" placeholder="Student's name" required>
							<input name="studentNum" type="text" placeholder="Student's number" required>
							<input name="courseName" type="text" placeholder="Course name" required>
							<input name="profName" type="text" placeholder="Professor's name" required>
							<input name="profName2" type="text" placeholder="Second professor's name (if there is one)">
							<input name="profName3" type="text" placeholder="Third professor's name (if there is one)">
							<input name="presentationType" type="text" placeholder="Presentation type" required>
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

		<!--
			The footer of this page just simply makes the bottom banner of the page which contains the date of creation and author names.
		-->
		<div class="footer">
			Designed January 7th, 2018<br>
  			by Sheldon Grundberg, Alex Ho, and Connor Maschke.
		</div>

		<script src="js/vendor/foundation.js"></script>
    	<script src="js/app.js"></script>
	</body>
</html>
