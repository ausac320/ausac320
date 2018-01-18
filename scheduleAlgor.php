<?php


/**
This is where all the schedule building logic is going to be written.
All functions here will pertain to getting the data that is submitted and will 
organize it in a way that will be turned into a csv file that will represent the schedule. 
*/

$submissionDataFile = "resources/submissionFolder/scheduleTest.csv";//this is the file that contains the submission data
$roomsArray = []; //global array where each index is a different room 
$submissionData = createSubmissionsArray($submissionDataFile)

/**
csvToArray() takes the csv file (how we are storing without the use of a database)
and will turn the csv file back into an array representation.
When moving through all the elements of $presentationReg those are all the presentations that were submitted.
Within that the $Row will have all the information pertaining to that presentation submission.
*/
function createSubmissionsArray($fileName){

	$submissionData = str_getcsv($fileName, "\n"); //parse the rows (every registered submission)
	foreach($presentationReg as &$Row){
		$Row = str_getcsv($Row, ","); //parse the items in rows (all the data for each registered submission)
		//each parse in the row is have these attributes as follows:
		// studentName || class || category || O.U.R || title || abstract || profName
	}
	return $submissionData
}


function create_schedule(){
	create_schedule_matrix(scheduleTimes);
	populate_schedule_matrix($scheduleMatrix, $submissionsArray);
}

function populate_schedule($startTime, $endTime, $presLength, $numOfRooms, $scheduleMatrix, $submissionsArray){
	while ($roomNumber = 4; $roomNumber > ($numOfRooms + 4); $roomNumber ++) {# while there is still rooms
		$presEndTime = $startTime + $presLength; #reset the time each time the next room is selected
		while ($presEndTime > $eventEndTime){ #while the end of the presentation is before the end of the event
			if ($submissionsArray[0][0] == null) { #checks to see if the professor's submission array is empty
				array_shift($submissionsArray); #removes the professor array
				if ($submissionsArray[0] == null){ #checks to see if there are any professor submission arrays
					export_schedule($scheduleMatrix);
					break; #stops since there are no more submissions, the schedule is complete!
				}
				else{ #since there is still a professor's submission array, schedule a presentation
					schedule_presentation($submissionsArray, $scheduleMatrix, $roomNumber, $presEndTime, $presLength);
				}
			}
			else{ #since the professor's submission array isnt empty, schedule a presentation
				schedule_presentation($submissionsArray, $scheduleMatrix, $roomNumber, $presEndTime, $presLength);
			}
		}
	}
	if ($submissionsArray[0] != null){ #since there are submissions yet to be scheduled, the schedule creation has failed
		echo "Schedule creation failed, not enough time, or rooms granted."
	}
}

function schedule_presentation($submissionsArray, $scheduleMatrix, $roomNumber, $presEndTime, $presLength){
	$submissionData = array_shift($submissionsArray);
	if($submissionData[Type] == "Poster" or $submissionData[Type] == "Art"){ #Art and Posters go in the forum, "room 0"
		array_push($scheduleMatrix[0], $submissionData);
	}
	elseif ($submissionData[OURStatus] == "Yes") { #OUR events go in the board room, "room 1"
		array_push($scheduleMatrix[1], $submissionData);
	}
	elseif ($submissionData[Type] == "Drama") { #Drama goes a theatre, "room 3"
		array_push($scheduleMatrix[3], $submissionData);
	}
	else{ #Oral and musical then go in the booked rooms
		$scheduleMatrix[$roomNumber][$presEndTime] = $submissionData;
		check_for_student_conflict($scheduleMatrix, $presEndTime, $roomNumber, $numOfRooms, $presLength);
		return $presEndTime;
	}
}

function check_for_student_conflict($scheduleMatrix, $presEndTime, $roomNumber, $numOfRooms, $presLength){
	$studentConflict = false;
	$studentName = 2; #This is because the student name is stored constantly in the second element 
	while ($compareRoom = 4; $compareRoom > ($numOfRooms + 4); $compareRoom++) { #since our booked rooms start at 4
		if($scheduleMatrix[$roomNumber][$presEndTime][$studentName] == $scheduleMatrix[$compareRoom][$presEndTime][$studentName]
		and $roomNumber != $compareRoom){ #If the student is the same in the two presentations and they arent the same one
			$studentConflict = true;
			array_push($scheduleMatrix[2][$presEndTime], $scheduleMatrix[$roomNumber][$presEndTime]); #Move it to the "conflict room", "room 2"
			$scheduleMatrix[$roomNumber][$presEndTime] = null; #remove the conflicting presentation from the schedule
		}	
	}
	if ($studentConflict == false) { #Then we check for professor conflicts
		check_for_prof_conflict($scheduleMatrix, $presEndTime, $roomNumber, $numOfRooms, $presLength);
		return $presEndTime;
	}
}

function check_for_prof_conflict($scheduleMatrix, $presEndTime, $roomNumber, $numOfRooms, $presLength){
	$profConflict = false;
	$profName = 1; #This is because like our student name, the professor name is constantly stored in the first element
	while ($compareRoom = 4; $compareRoom > ($numOfRooms + 4); $compareRoom++) {
		if($scheduleMatrix[$roomNumber][$presEndTime][$profName] == $scheduleMatrix[$compareRoom][$presEndTime][$profName]
		and $roomNumber != $compareRoom){ #If the professor is the same in the two presentations and they arent the same one
			$profConflict = true;
			array_push($scheduleMatrix[][$presEndTime], $scheduleMatrix[$roomNumber][$presEndTime]); #Move it to the "conflict room"
			$scheduleMatrix[$roomNumber][$presEndTime] = null; #remove the conflicting presentation from the schedule
		}	
	}
	if ($profConflict == false) { #if there is no conflict the schedule has been successfully booked and the time period moves forward
		$presEndTime = $presEndTime + $presLength;
		return $presEndTime;
	}
}

?>