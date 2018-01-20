<!--
AUCSC 320 - Augustana Student Academic Conference

Documentation by Sheldon Grundberg on January 19, 2018

presRegister.php is the Presentation Registration Page, which will be displayed when the user clicks on the register button of the navigation column.

The page contains a form for gathering data for presentation submissions, it then saves the submitted data as into a CSV file so that it can be accessed by the edit-able tables of the submissions page.
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
							<input name="studentName" type="text" placeholder="Student's name" pattern="[A-za-z'- .]{1,}" required>
							<input name="courseName" type="text" placeholder="Course name (ex. AUMAT250)" pattern="[A-Z0-9 ]{8-9}" required>
							<input name="profName" type="text" placeholder="Professor's name" pattern="[A-za-z'- .]{1,}" required>
							<div>
								Presentation Type:
								<input name="presentationType" type="radio" value="Oral" required>Oral
								<input name="presentationType" type="radio" value="Poster" required>Poster
								<input name="presentationType" type="radio" value="Art" required>Art
								<input name="presentationType" type="radio" value="Drama" required>Drama
								<input name="presentationType" type="radio" value="Music" required>Music
							</div>
							<div>
								Would you like to nominate the student for the Outstanding Undergraduate Research Award?:
								<input name="OURStatus" type="radio" value="Yes" required>Yes
								<input name="OURStatus" type="radio" value="No" required>No
							</div>
							<textarea name="titleOfPresentation" placeholder="Title of presentation" rows="2" required></textarea> 
							<textarea name="studentAbstract" placeholder="Student's abstract" rows="6"></textarea>
							<input value="Submit Presentation" type="submit">
						</form>
					</div>
				</div>
				<div class="large-2 medium-2 small-2 columns">
				</div>
			</div>	
		</div>
		
		<?php #If the form is submitted php code will begin
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			prepare_variables();
		}
		?>

		<div class="footer">
			<div class="row footerSpace">
				<div class="large-4 medium-4 small-4 columns">
					<img src="resources/images/SAC Logo-1.png" alt="SAC Logo" >
				</div>
				<div class="large-4 medium-4 small-4 columns"></div>
				<div class="large-4 medium-4 small-4 columns contactInfo">
					<h3 class="underline">Contact Information</h3>
				</div>
			</div>
		</div>

		<script src="resources/js/vendor/jquery.js"></script>
    	<script src="resources/js/vendor/what-input.js"></script>
		<script src="resources/js/vendor/foundation.js"></script>
    	<script src="resources/js/app.js"></script>
    	<script src="resources/js/editableContactTable.js"></script>

    	<script type="text/javascript")>
			grabContactTextData();
		</script>

	</body>
</html>

<?php

	function prepare_variables() { #sets the variables  and calls to create/write the file
		$studentName = test_input($_POST["studentName"]);
		$courseName = test_input($_POST["courseName"]);
		$presentationType = test_input($_POST["presentationType"]);
		$OURStatus = test_input($_POST["OURStatus"]);
		$titleOfPresentation = test_input($_POST["titleOfPresentation"]);
		$studentAbstract = test_input($_POST["studentAbstract"]);
		$profName = test_input($_POST["profName"]);
		$fileName = "resources/submissionFolder/" . "$profName.csv";
		
		create_file($studentName, $courseName, $profName, $presentationType, $OURStatus, $titleOfPresentation, 
				$studentAbstract, $fileName);
		echo "Submission Successful, presentation has been submitted!";

	}

	function test_input($data) { #removes odd characters from the input recieved
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = trim($data); 
		return $data;
	}

	function create_file($studentName, $courseName, $profName, $presentationType, $OURStatus, $titleOfPresentation, 
		$studentAbstract, $fileName) { #writes the inputs to the file and then starts the next line for the next line.
		$file = fopen ($fileName, "a+");
		$txt = $studentName.",";
		fwrite($file, $txt);
		$txt = $courseName.",";
		fwrite($file, $txt);
		$txt = $presentationType.",";
		fwrite($file, $txt);
		$txt = $OURStatus.",";
		fwrite($file, $txt);
		$txt = $titleOfPresentation.",";
		fwrite($file, $txt);
		$txt = $studentAbstract.",";
		fwrite($file, $txt);
		$txt = $profName."\n";
		fwrite($file, $txt);
		fclose($file);
	}

	function add_to_scheduling($courseName, $profName, $studentName){ #Writes vital info of multiple submissions so they can be gathered. INCOMPLETE FUNCTION
		$file = fopen("resources/submissionFolder/registeredSubmissions.csv", "a+");
		$txt = $courseName."\n";
		fwrite($file, $txt);
		$txt = $profName."\n";
		fwrite($file, $txt);
		$txt = $studentName."\n";
		fwrite($file, $txt);
		fwrite($file, "\n");
	}
?>