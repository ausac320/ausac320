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
				<div id="scheduleSetup" class="large-8 medium-8 small-8 columns">
					Schedule Setup Page
					<div class="setup">
						<form data-abide action="scheduleSetup.php" method="POST">
							<div data-abide-error class="alert callout" style="display: none;">
								<p><i class="fi-alert"></i> There are errors in your form.</p>
							</div>
							<div class ="row">
							<div class="large-6 medium-6 small-6 columns">
								<label> 
									SAC presentation term:
									<select id="termSelect" name ="termSelect" required>
										<option value=""></option>
										<option value="Fall Term">Fall Term</option>
										<option value="Winter Term">Winter Term</option>
									</select>
								</label>
							</div>
							</div>
							<div class="row">
								<div class="large-6 medium-6 small-6 columns">
									<label>
										Registration Deadline
										<input type="date" name="regEndDate" required pattern = "YYYY/MM/DD" max= "9999-12-31" min="1111-01-01" required>
									</label>
								</div>
								<div class="large-6 medium-6 small-6 columns">
									<label>
										Abstract Deadline
										<input type="date" name="abstractDeadline" required pattern="YYYY/MM/DD" max= "9999-12-31" min="1111-01-01" required>
									</label>
									
								</div>
							</div>	
							<div class="row">
								<div class="large-6 medium-6 small-6 columns">
									<label> 
										Start Date
										<input type="date" name="startDate" required pattern= "YYYY/MM/DD" max= "9999-12-31" min="1111-01-01" required>
									</label>									
									<label> 
										End Date
										<input type="date" name="endDate" required pattern= "YYYY/MM/DD" max= "9999-12-31" min="1111-01-01" required>
									</label>
								</div>
								<div class="large-6 medium-6 small-6 columns">						
									<label> 
										Start Time
										<input type="time" name="startTime" required pattern= "HH:MM:" required>
									</label>
									<label> 
										End Time
										<input type="time" name="endTime" required pattern= "HH:MM" required>
									</label>
								</div>
							</div>
							<div class="row">
								<div class="large-6 medium-6 small-6 columns">
									<label>
										Presentation Time Allowed (minutes)
										<input type="number" name="presTimeSlot" placeholder ="25" required>
									</label>
								</div>
							</div>	
							<div id="input1" style="margin-bottom:4px;" class="clonedInput">
					    		<div class="large-4 medium-4 small-4 columns">
					    			Break Date
							   		<input type="date" name="breakDate" id="breakDate" max= "9999-12-31" min="1111-01-01" required pattern="YYYY/MM/DD" required/>
						 		</div>
								<div class="large-4 medium-4 small-4 columns">
							        Break Start Time: 
							        <input type="time" name="breakStart" id="startTime1" required pattern="HH:MM" required/>
							    </div>
							    <div class="large-4 medium-4 small-4 columns">    
							    	Break End Time: 
							    	<input type="time" name="breakEnd" id="endTime1" required pattern="HH:MM" required/>
								</div>
							 </div>	
								<div>
								    <input type="button" id="btnAdd" value="Add Break"/>
							        <input type="button" id="btnDel" value="Remove Break"/>
							    </div>			
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
			<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				prepareData();
			}
			?>
		

		<div class="footer">
			Designed January 7th, 2018<br>
  			by Sheldon Grundberg, Alex Ho, and Connor Maschke.
		</div>


		<script src="resources/js/vendor/jquery.js"></script>
    	<script src="resources/js/vendor/what-input.js"></script>
		<script src="resources/js/vendor/foundation.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    	<script src="resources/js/scheduleSetup.js"></script>
    	<script src="resources/js/app.js"></script>
    	
<!--
	Sourced this code from http://charlie.griefer.com/blog/2009/09/17/jquery-dynamically-adding-form-elements/index.html
	has been modified in order for program to use proper information
-->
    	<script type="text/javascript">
        $(document).ready(function() {
            $('#btnAdd').click(function() {
                var num     = $('.clonedInput').length ; // how many "duplicatable" input fields we currently have
                var newNum  = new Number(num + 1);      // the numeric ID of the new input field being added
 
                // create the new element via clone(), and manipulate it's ID using newNum value
                var newElem = $('#input' + num).clone().attr('id', 'input' + newNum);
 
                // manipulate the name/id values of the input inside the new element
                newElem.children(':first').attr('id', 'name' + newNum).attr('name', 'name' + newNum);
 
                // insert the new element after the last "duplicatable" input field
                $('#input' + num).after(newElem);
 
                // enable the "remove" button
                $('#btnDel').attr('disabled','');
 
                // maximum number of breakTimes allowed
                if (newNum == 10)
                    $('#btnAdd').attr('disabled','disabled');
            });
 
            $('#btnDel').click(function() {
                var num = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
                $('#input' + num).remove();     // remove the last element
 
                // enable the "add" button
                $('#btnAdd').attr('disabled','');
 
                // if only one element remains, disable the "remove" button
                if (num-1 == 1)
                    $('#btnDel').attr('disabled','disabled');
            });
 
            $('#btnDel').attr('disabled','disabled');
        });
    </script>
	</body>
</html>

		<?php
			$termSelect = "";
			$startDate = "";
			$startTime = "";
			$endDate = "";
			$endTime = "";
			$presTimeSlot = "";
			$regEndDate = "";
			$abstractDeadline = "";
			$breakDate = "";


		function prepareData(){
			
				global $fileName;
				$termSelect = test_input($_POST["termSelect"]);
				$startDate = test_input($_POST["startDate"]);
				$startTime = test_input($_POST["startTime"]);
				$endDate = test_input($_POST["endDate"]);
				$endTime = test_input($_POST["endTime"]);
				$presTimeSlot = test_input($_POST["presTimeSlot"]);
				$regEndDate = test_input($_POST["regEndDate"]);
				$abstractDeadline = test_input($_POST["abstractDeadline"]);
				$breakDate = test_input($_POST["breakDate"]);
				$fileTitle= "$termSelect". " " ."$startDate"; 
				$fileName = "resources/submissionFolder/$fileTitle.txt";

				if (fopen($fileName, "x") == false){
					echo "Submission Failed";
				}
				else {
					create_file($termSelect, $startDate, $startTime, $endDate, $endTime, $presTimeSlot, $regEndDate, $abstractDeadline, $breakDate);
					echo "Submission Successful";
				}
			}

			function test_input($data) {
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				$data = trim($data); 
				return $data;
			}

			function create_file($termSelect, $startDate, $startTime, $endDate, $endTime, $presTimeSlot, $regEndDate, $abstractDeadline, $breakDate) {
				global $fileName;
				$file = fopen ($fileName, "w+");
				$txt = $termSelect."\n";
				fwrite($file, $txt);
				$txt = $startDate."\n";
				fwrite($file, $txt);
				$txt = $endDate."\n";
				fwrite($file, $txt);
				$txt = $startTime."\n";
				fwrite($file, $txt);
				$txt = $endTime."\n";
				fwrite($file, $txt);
				$txt = $presTimeSlot."\n";
				fwrite($file, $txt);
				$txt = $regEndDate."\n";
				fwrite($file, $txt);
				$txt = $abstractDeadline."\n";
				fwrite($file, $txt);
				$txt = $breakDate."\n";
				fwrite($file, $txt);
				fclose($file);
			}
		?>