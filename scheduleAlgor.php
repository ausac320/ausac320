<?php

function create_schedule(){
	create_schedule_matrix(scheduleTimes);
	create_submissions_array(submissionData);
	populate_schedule_matrix($scheduleMatrix, $submissionsArray);
}

function populate_schedule($startTime, $endTime, $presLength, $numOfRooms, $scheduleMatrix, $submissionsArray){
	while ($roomNumber = 3; $roomNumber > ($numberOfRooms + 3); $roomNumber ++) {# while there is still rooms
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
	if($submissionData[Type] == "Poster" or $submissionData[Type] == "Art"){ #Art and Posters go in the forum
		array_push($scheduleMatrix[1], $submissionData);
	}
	elseif ($submissionData[Type] == "Drama") { #Drama goes a theatre
	
	}
	elseif ($submissionData[OURStatus] == "Yes") { #OUR events go in the board room
		array_push($scheduleMatrix[1], $submissionData);
	}
	else{ #Oral and musical then go in the booked rooms
		$scheduleMatrix[$roomNumber][$presEndTime] = $submissionData;
		check_for_student_conflict($scheduleMatrix, $presEndTime, $roomNumber, $numOfRooms, $presLength);
		return $presEndTime;
	}
}

function check_for_student_conflict($scheduleMatrix, $presEndTime, $roomNumber, $numOfRooms, $presLength){
	$studentConflict = false;
	while ($compareRoom = 3; $compareRoom > ($numOfRooms + 3); $compareRoom++) {
		if($scheduleMatrix[$roomNumber][$presEndTime][student] == $scheduleMatrix[$compareRoom][$presEndTime][student]
		and $roomNumber != $compareRoom){ #If the student is the same in the two presentations and they arent the same one
			$studentConflict = true;
			array_push($scheduleMatrix[][$presEndTime], $scheduleMatrix[$roomNumber][$presEndTime]); #Move it to the "conflict room"
			$scheduleMatrix[$roomNumber][$presEndTime] = null; #remove the conflicting presentation from the schedule
		}	
	}
	if ($studentConflict == false) { #if there is no conflict the schedule has been successfully booked and the time period moves forward
		$presEndTime = $presEndTime + $presLength;
		return $presEndTime;
	}
}

?>