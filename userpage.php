<!--
	userpage.php
	
	Description: 
	This page is for the user to be able to see important dates and deadlines as well as edit them if they have 
	admin privileges as well as being able to edit the contact information in the footer if they have said privileges.
	This page will also contain the editable final schedule which will only be displayed once it has be created 
	using the admin settings. It also has editablity if you have admin privileges.

	File Contents:
	This file contains the layout elements for the design of the home page as well as calls for the functionality
	creation. Namely the editable text field, editable contact info, and the editable final schedule table.
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
				<div class="large-8 medium-8 small-8 columns">
					<h4 id="usersName">User's Name Displays Here</h4>

					<!-- place important dates here -->
					<div id="importantDisplay" class="deadlines"></div>

					<!-- place schedule here -->
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

				<!-- place contact here -->
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
			addContactEditButtonToHomeAdmin(); //creates edit button contact for admins
			addImportantEditButtonToHomeAdmin(); //creates edit button important dates for admins
			grabScheduleData(); //begins process of creating displayed schedule
		</script>
	</body>
</html>