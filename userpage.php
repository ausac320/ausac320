<!--
AUCSC 320 - Augustana Student Academic Conference

Documentation by Sheldon Grundberg on January 19, 2018

userpage.php is The Home Page that displays after the user sucessfully logs in. This page will also be displayed when users click the "Home" button of the navigation column

The Home Page contains three features, the display of the current schedule, the important dates and deadlines text box (which is editable with the click of a button), and it also features the edit button for the contacts text box at the bottom of the page. 
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