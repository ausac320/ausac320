<?php
/**
This is where all the schedule building logic is going to be written.
All functions here will pertain to getting the data that is submitted and will 
organize it in a way that will be turned into a csv file that will represent the schedule. 
*/

$submissionDataFile = "resources/submissionFolder/scheduleTest.csv";//this is the file that contains the submission data
$submissionData = createSubmissionsArray($submissionDataFile);
				global $fileName;
				$scheduleArray = []; //global array where each index is a different room 
				$presLength = 5;
				$eventStartTime = 6*60;//start @ 6:00
				$eventEndTime = 10*60;//end @ 10:00
				$breakStartTime = 8*60;//break start @ 8:00
				$breakEndTime = 9*60;//break end @ 9:00
				$numOfRooms = 5;
				$oralPresRooms;
				$fileName = "resources/submissionsFolder/TestMethod2.txt";


/**
createSubmissionArray() takes the csv file (how we are storing without the use of a database)
and will turn the csv file back into an array representation.
When moving through all the elements of $presentationReg those are all the presentations that were submitted.
Within that the $Row will have all the information pertaining to that presentation submission.
*/

__halt_compiler();


function testMethod(){
	global $submissionsData;
	$file = fopen($fileName, "w+");
	$results = print_r($submissionsData,true);

	file_put_contents('resources/submissionFolder/TestMethod2.txt', print_r($b, true));
	
	fclose($myFile);
}

//placing the presentation into the "room"
function placeInRoom($submissionsArray){
	global $oralPresRooms;
	$oralPresRooms = 4;
	for($i=0; $i < count($submissionsArray); $i++){
		if($submissionsArray[$i][3] == "Y"){//is an OUR Pres
			schedulePlacement($submissionsArray[$i], 0, );
		}
		if($submissionArray[$i][2] == "Poster" or "Art"){
			schedulePlacement($submissionsArray[$i], 1);
		}
		elseif($submissionArray[$i][2] == "Drama"){
			schedulePlacement($submissionsArray[$i], 2);

		}
		else{//General oral Presentations go here

			schedulePlacement($submissionsArray[$i], $oralPresRooms)
					
			}//else
		}//forLoop
}//placeInRoom



function schedulePlacement($presentationInfo, $roomNumber){
	global $scheduleArray;
	global $eventStartTime;
	global $eventEndTime;
	global $presLength;
	global $breakStartTime;
	global $breakEndTime;
	global $oralPresRooms;
	$prevPresRef = count($scheduleArray[$roomNumber][]) -1;
	if($prevPresRef == 0){//if it's first element in the presentation listing
		$presentationInfo[] = $presentationStartTime;
		$presentationInfo[] = $presentationStartTime + $presLength;
	}
	$prevPresEndTime = $scheduleArray[$roomNumber][$prevPresRef-1][8];//get the last presentation's end time
	$presEndTime = $prevPresEndTime + $presLength


	elseif($prevPresEndTime < $breakStartTime){//before the break
		if( $presEndTime > $breakStartTime){//runs into the break - set to after the break
			$scheduleArray[$roomNumber][] = array("Break Time", ($breakEndTime - $breakStartTime));//add the Break Time
			if (check_for_student_conflict($scheduleArray, $roomNumber, $numOfRooms) == false){
				$presentationStartTime = $breakEndTime;
				$presentationInfo[] = $presentationStartTime;
				$presentationInfo[] = $presentationStartTime + $presLength;
				$scheduleArray[$roomNumber][] = $presentationInfo;//put in the presentation into the proper room.
			}
			else{
				$scheduleArray[3][] = $presentationInfo;
			} 
		}
		else{//it can go before the break
			if (check_for_student_conflict($scheduleArray, $roomNumber, $numOfRooms) == false){
				$presentationInfo[] = $presentationStartTime;
				$presentationInfo[] = $presentationStartTime + $presLength;
				$scheduleArray[$roomNumber][] = $presentationInfo;//put the presentation into the proper room.
			}
			else{
				$scheduleArray[3][] = $presentationInfo;
			} 
		}
	}
	else{//After the break
		$presentationStartTime = $prevPresEndTime;
		if($presentationStartTime+$presLength < $eventEndTime){//before the end of the presentation end time
			if (check_for_student_conflict($scheduleArray, $roomNumber, $numOfRooms) == false){
				$presentationInfo = $presentationStartTime;
				$presentationInfo = $presentationStartTime + $presLength;
				$scheduleArray[$roomNumber][] = $presentationInfo;//put in the presentation into the proper room.
			}
			else{
				$scheduleArray[3][] = $presentationInfo;
			} 
		}
		else{//what will happen if it doesn't fit.
			if ($roomNumber > 3) {//this is oral presentations that don't fit.
			global $numOfRooms;
				if($roomNumber-4 < $numOfRooms ){
					schedulePlacement($presentation, $roomNumber+=1)
				}//if
			}//if
			else{//can't resolve... Send to the Conflicts Array
			$scheduleArray[3][] = $presentationInfo;
			}//else
		}//else
	}//else
}//schedulePlacement






/**
WORK ON IT TOMORROW
*/

function check_for_student_conflict($scheduleArray, $roomNumber, $numOfRooms){
	$conflictStatus = false;
	$studentName = 0; #This is because the student name is stored constantly in the first element
	$presentationPeriod = sizeof($scheduleArray[$roomNumber]); 
	while ($compareRoom = 4; $compareRoom < ($numOfRooms + 4); $compareRoom++) { #since our booked rooms start at 4
		if($scheduleArray[$roomNumber][$presentationPeriod][$studentName] == $scheduleArray[$compareRoom][$presentationPeriod][$studentName]
		and $roomNumber != $compareRoom){ #If the student is the same in the two presentations and they arent the same one
			$conflict = true;
			return $conflictStatus;
		}	
	}
	if ($studentConflict == false) { #Then we check for professor conflicts
		check_for_prof_conflict($scheduleArray, $roomNumber, $numOfRooms, $conflictStatus);
		return $conflictStatus;
	}
}

function check_for_prof_conflict($scheduleArray, $roomNumber, $numOfRooms, $conflictStatus){
	$profName = 5; #This is because like our student name, the professor name is constantly stored in the last element
	$presentationPeriod = sizeof($scheduleArray[$roomNumber]);
	while ($compareRoom = 4; $compareRoom < ($numOfRooms + 4); $compareRoom++) {
		if($scheduleMatrix[$roomNumber][$presentationPeriod][$profName] == $scheduleMatrix[$compareRoom][$presentationPeriod][$profName]
		and $roomNumber != $compareRoom){ #If the professor is the same in the two presentations and they arent the same one
			$conflict = true;
			return $conflictStatus;
		}	
	}
	if ($profConflict == false) { #if there is no conflict the schedule has been successfully booked and the time period moves forward
		return $conflictStatus;
	}
}

?>