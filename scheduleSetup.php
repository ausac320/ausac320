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
										Presentation Time Slots (minutes)
										<input type="number" name="presTimeSlot" placeholder ="25" required>
									</label>
									<label>
										Number of Rooms
										<input type="number" name="numberofRooms" placeholder ="4" required>
									</label>
								</div>
							</div>
							<div id ="breakTimes" name ="breakTimes">	

								<div id="input1" style="margin-bottom:4px;" class="clonedInput">
						    		<div class="large-4 medium-4 small-4 columns">
						    			Break Date
								   		<input type="date" name="breakDate" id="breakDate" max= "9999-12-31" min="1111-01-01" required pattern="YYYY/MM/DD" required/>
							 		</div>
									<div class="large-4 medium-4 small-4 columns">
								        Break Start Time: 
								        <input type="time" name="breakStart" id="breakStart" required pattern="HH:MM" required/>
								    </div>
								    <div class="large-4 medium-4 small-4 columns">    
								    	Break End Time: 
								    	<input type="time" name="breakEnd" id="breakEnd" required pattern="HH:MM" required/>
									</div>
								 </div>	
							</div> 

								<div class ="row" id="addFields">
									<div class="large-6 medium-6 small-6 columns">
								    	<input type="button" id="btnAdd" value="Add Break"/>
							        	<input type="button" id="btnDel" value="Remove Break"/>
							     </div>
							  </div>			
							<div class="row" id="scheduleButton">
								<div class="large-4 medium-4 small-4 columns">
									<input id="scheduleSubmit" value="Submit" type="submit">
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					
					<button class="button testButton">Press Me To Test Method</button>
				</div>
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
        	var breakList = ["1"];
            $('#btnAdd').click(function() {
                var num     = $('.clonedInput').length ; // how many "duplicatable" input fields we currently have
                var newNum  = new Number(num + 1);      // the numeric ID of the new input field being added
 
                // create the new element via clone(), and manipulate it's ID using newNum value
                var newInput = $('#input' + num).clone().attr('id', 'input' + newNum);
                var newBreakStart = $('#breakStart' + num).clone().attr('id', 'breakStart' + newNum);
                var newBreakEnd = $('#breakEnd' + num).clone().attr('id', 'breakEnd'+newNum);

                // manipulate the name/id values of the input inside the new element
                newInput.children(':first').attr('id', 'name' + newNum).attr('name', 'name' + newNum);				
 				//add the newElem to the list which will be used to print to text in php
 				breakList.push('input'+newNum);
                // insert the new element after the last "duplicatable" input field
                $('#input' + num).after(newInput); 
                // enable the "remove" button
                $('#btnDel').attr('disabled','');
 
                // maximum number of breakTimes allowed
                if (newNum == 10)
                    $('#btnAdd').attr('disabled','disabled');
            }); 
            $('#btnDel').click(function() {
                var num = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
                $('#input' + num).remove();     // remove the last element
                breakList.pop();
                console.log(breakList);
 
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
	function prepareData(){
		global $fileName;
		$termSelect = testInput($_POST["termSelect"]);
		$startDate = testInput($_POST["startDate"]);
		$startTime = testInput($_POST["startTime"]);
		$endDate = testInput($_POST["endDate"]);
		$endTime = testInput($_POST["endTime"]);
		$presTimeSlot = testInput($_POST["presTimeSlot"]);
		$numberofRooms = testInput($_POST["numberofRooms"]);
		$regEndDate = testInput($_POST["regEndDate"]);
		$abstractDeadline = testInput($_POST["abstractDeadline"]);
		$breakDate = testInput($_POST["breakDate"]);
		$breakStart = testInput($_POST["breakStart"]);
		$breakEnd = testInput($_POST["breakEnd"]);
		$fileTitle= "$termSelect". " " ."$startDate"; 
		$fileName = "resources/submissionFolder/$fileTitle.txt";
		if (fopen($fileName, "x") == false){
			echo "Submission Failed";
		}
		else {
			createFile($termSelect, $startDate, $startTime, $endDate, $endTime, $presTimeSlot, $regEndDate,$numberofRooms, $abstractDeadline, $breakDate, $breakStart, $breakEnd);
			echo "Submission Successful";
		}
	}

	function testInput($data) {
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = trim($data); 
		return $data;
	}

	function createFile($termSelect, $startDate, $startTime, $endDate, $endTime, $presTimeSlot,$numberofRooms, $regEndDate, $abstractDeadline, $breakDate, $breakStart, $breakEnd) {
		global $fileName;
		$file = fopen ($fileName, "w+");
		$txt = $termSelect."\n";
		fwrite($file, $txt);
		$txt = $regEndDate."\n";
		fwrite($file, $txt);
		$txt = $abstractDeadline."\n";
		fwrite($file, $txt);
		$txt = $startDate." ";
		fwrite($file, $txt);
		$txt = $startTime."\n";
		fwrite($file, $txt);
		$txt = $endDate." ";
		fwrite($file, $txt);
		$txt = $endTime."\n";
		fwrite($file, $txt);
		$txt = $presTimeSlot."\n";
		fwrite($file, $txt);
		$txt = $numberofRooms."\n";
		fwrite($file, $txt);	
		$txt = $breakDate." ";
		fwrite($file, $txt);
		$txt = $breakStart." ";
		fwrite($file, $txt);
		$txt = $breakEnd."\n";
		fwrite($file, $txt);
		fclose($file);
	}//createFile
?>

