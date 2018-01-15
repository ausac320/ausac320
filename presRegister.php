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
		<link rel="stylesheet" href="resources/css/vendor/foundation.css">
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
						<form method="POST">
							<input name="studentName" type="text" placeholder="Student's name" pattern="[A-za-z' ]{1,}" required>
							<input name="courseName" type="text" placeholder="Course name" pattern="[A-Z0-9]{8}" required>
							<input name="profName" type="text" placeholder="Professor's name" pattern="[A-za-z' .]{1,}" required>
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
							<input name="titleOfPresentation" type="text" placeholder="Title of presentation" pattern="[A-za-z0-9' .!,]{1,}" required>
							<input name="studentAbstract" type="text" placeholder="Student abstract" pattern="[A-za-z0-9' .!,]{1,}">
							<input value="Submit Presentation" type="submit">
						</form>
					</div>
				</div>
				<div class="large-2 medium-2 small-2 columns">
				</div>
			</div>	
		</div>
		<?php
			$studentName = "";
			$courseName = "";
			$profName = "";
			$presentationType = "";
			$OURStatus = "";
			$titleOfPresentation = "";
			$studentAbstract = "";
			$fileName = "";

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$studentName = test_input($_POST["studentName"]);
				$courseName = test_input($_POST["courseName"]);
				$profName = test_input($_POST["profName"]);
				$presentationType = test_input($_POST["presentationType"]);
				$OURStatus = test_input($_POST["OURStatus"]);
				$titleOfPresentation = test_input($_POST["titleOfPresentation"]);
				$studentAbstract = test_input($_POST["studentAbstract"]);
				$fileName = "resources/submissionFolder/$titleOfPresentation.txt";
				if (fopen($fileName, "x") == false){
					echo "Submission Failed";
				}
				else {
					create_file($studentName, $courseName, $profName, $presentationType, $OURStatus, $titleOfPresentation, $studentAbstract, $fileName);
					echo "Submission Successful";
				}
			}

			function test_input($data) {
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				$data = trim($data); 
				return $data;
			}

			function create_file($studentName, $courseName, $profName, $presentationType, $OURStatus, $titleOfPresentation, $studentAbstract, $fileName) {
				$file = fopen ($fileName, "w+");
				$txt = $studentName."\n";
				fwrite($file, $txt);
				$txt = $courseName."\n";
				fwrite($file, $txt);
				$txt = $profName."\n";
				fwrite($file, $txt);
				$txt = $presentationType."\n";
				fwrite($file, $txt);
				$txt = $OURStatus."\n";
				fwrite($file, $txt);
				$txt = $titleOfPresentation."\n";
				fwrite($file, $txt);
				$txt = $studentAbstract."\n";
				fwrite($file, $txt);
				fclose($file);
			}
		?>
		<div class="footer">
			Designed January 7th, 2018<br>
  			by Sheldon Grundberg, Alex Ho, and Connor Maschke.
		</div>
    
		<script src="resources/js/vendor/jquery.js"></script>
    	<script src="resources/js/vendor/what-input.js"></script>
		<script src="resources/js/vendor/foundation.js"></script>
		<script src="resources/js/presRegister.js"></script>
    	<script src="resources/js/app.js"></script>

	</body>
</html>