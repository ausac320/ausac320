<!--
AUCSC 320 - Augustana Student Academic Conference

Documentation by Sheldon Grundberg on January 12, 2018

userpage.php is the page that displays after the user sucessfully logs in. This page will also be displayed when users click the "Home" button of the navigation column

Contained on this page is a chart and a text box. The chart is our "schedule" and is there primarily for showcasing U.I. elements as it has no logic implemented currently. The text box is our "Warning and Deadlines" banner, it is a text box for displaying information pertaining to the deadlines of the SAC, currently the text has to be modified by code, but in future versions the admin should have an edit button for the box.
-->
<!doctype html>
<html class="no-js" lang="en" dir="ltr">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Augustana Student Academic Conference Website</title>
		<link rel="stylesheet" href="resources/css/vendor/foundation.css">
    	<link rel="stylesheet" href="resources/css/app.css">
    	<link rel="stylesheet" href="resources/css/userpage.css">
    	<link rel="shortcut icon" href="resources\images\Augfavicon.ico" type="image/x-icon">
	</head>

	<body>
		<div class="header">
			<h1>
				<a href="index.php">Augustana Student Academic Conference</a>
			</h1>
		</div>

		<div id="userPageField" class="callout secondary">
			<div class="row.fullsizerow">
				<div class="large-2 medium-2 small-2 columns">
					<ul id="navMenu">
				  		<li class="active">
				  			<a href="userpage.php" >Home</a>
				  		</li>
				  		<li>
				  			<a href="presRegister.php" >Register</a>
				  		</li>
				  		<li>
				  			<a href="presSubmissions.php" >Submissions</a>
				  		</li>
				  		<li>
				  			<a href="scheduleSetup.php" >Schedule Setup</a>
				  		</li>
				  		<li>
				  			<a href="index.php" onclick="signOut();" >Sign out</a>
				  		</li>
					</ul>
				</div>
				<div class="large-8 medium-8 small-8 columns"><!-- slam table here -->
					<h4 id="usersName">User's Name Displays Here</h4>

					<div id="importantDisplay" class="deadlines"></div>

					<div id="importantScheduleHolder" class="schedule"></div>

				</div>
				<div class="large-2 medium-2 small-2 columns">
				</div>
			</div>	
		</div>

		<div class="footer">
			<div class="row footerSpace">
				<div class="large-4 medium-4 small-4 columns">
					<img src="resources/images/SAC Logo-1.png" alt="SAC Logo" >
				</div>
				<div class="large-4 medium-4 small-4 columns"></div>
				<div id="contact" class="large-4 medium-4 small-4 columns contactInfo"></div>
			</div>
		</div>


		<script src="resources/js/vendor/jquery.js"></script>
    	<script src="resources/js/vendor/what-input.js"></script>
		<script src="resources/js/vendor/foundation.js"></script>
		<script src="https://apis.google.com/js/platform.js" async defer></script>
    	<script src="resources/js/app.js"></script>
    	<script src="resources/js/editableContactTable.js"></script>
    	<script src="resources/js/editableImportantTable.js"></script>
    	<script src="resources/js/editableScheduleTable.js"></script>


    	<script type="text/javascript")>
			addContactEditButtonToHomeAdmin();
			addImportantEditButtonToHomeAdmin();
			grabScheduleData();
		</script>
	</body>
</html>