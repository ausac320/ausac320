<!-- 
AUCSC320 - Augustana Student Academic Conference

Last Reviewed: January 11, 2018

scheduleSetup.php is the webpage that will be displayed when setting up a new
session of presentations.

There will be a variety of variables that will be required in order to set restraints
for the schedule organization.  
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
    	<link rel="stylesheet" href="resources/css/scheduleSetup.css">
    	<link rel="shortcut icon" href="resources\images\Augfavicon.ico" type="image/x-icon">

	</head>

	<body>
		<div class="header">
			<h1>
				<a href="index.php">Augustana Student Academic Conference</a>
			</h1>
		</div>

		<div id="scheduleSetupPageField" class="callout secondary">
			<div class="row.fullsize">
				<div class="large-2 medium-2 small-2 columns">
					<ul id="navMenu">
				  		<li>
				  			<a href="userpage.php" >Home</a>
				  		</li>
				  		<li>
				  			<a href="presRegister.php" >Register</a>
				  		</li>
				  		<li>
				  			<a href="presSubmissions.php" >Submissions</a>
				  		</li>
				  		<li class="active">
				  			<a href="scheduleSetup.php" >Schedule Setup</a>
				  		</li>
						<li>
				  			<a href="index.php" onclick="signOut();">Sign out</a>
				  		</li>
					</ul>
				</div>
				<div class="large-8 medium-8 small-8 columns">
					<div class="setup">
						<form data-abide action="scheduleSetup.php" method="GET">
							<div data-abide-error class="alert callout" style="display: none;">
								<p><i class="fi-alert"></i> There are errors in your form.</p>
							</div>
							<div class ="row">
							<div class="large-6 medium-6 small-6 columns">
								<label> 
									SAC presentation term occurence:
									<select id="termSelect" required>
										<option value=""></option>
										<option value="fallTerm">Fall Term</option>
										<option value="winterTerm">Winter Term</option>
									</select>
								</label>
							</div>
							</div>		
							<div class="row">
								<div class="large-6 medium-6 small-6 columns">
									<label> 
										Start Date
										<input type="date" name="date" required pattern= "MM/DD/YYYY" placeholder="startDate" required>
									</label>									
									<label> 
										End Date
										<input type="date" name="date" required pattern= "MM/DD/YYYY" placeholder="endDate" required>
									</label>
								</div>
								<div class="large-6 medium-6 small-6 columns">						
									<label> 
										Start Time
										<input type="time" name="startTime" required pattern= "HH:MM:" placeholder="startTime" required>
									</label>
									<label> 
										End Time
										<input type="time" name="endTime" required pattern= "HH:MM" placeholder="endTime" required>
									</label>
								</div>
							</div>
<!--
							<div class="row">
								<div class="large-4 medium-4 small-4 columns">
									<form method="POST">
     									
          								Entry 1<br><input type="text" class="myInputs[]">
     								
     									<button onClick="addInput()"> Add New </button>
									</form>							
								</div>
							</div>
-->

							<div class="row">
								<div class="large-4 medium-4 small-4 columns">
									<input id="scheduleSubmit" value="Submit" type="submit">
								</div>
							</div>
						</form>
					</div>
				</div>
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
	</body>
</html>
