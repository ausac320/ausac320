<?php
/**
This is where all the schedule building logic is going to be written.
All functions here will pertain to getting the data that is submitted and will 
organize it in a way that will be turned into a csv file that will represent the schedule. 
*/

$submissionDataFile = "resources/submissionFolder/scheduleTest.csv";//this is the file that contains the submission data
				$scheduleArray = array();//this will be the final array where the schedule will be stored
				$presLength = 25;
				$eventStartTime = 300;//start @ 6:00
				$eventEndTime = 10*60;//end @ 10:00
				$breakStartTime = 8*60;//break start @ 8:00
				$breakEndTime = 9*60;//break end @ 9:00
				$numOfPresRooms = 5;
				$oralPresRoom = 4;
				createSubmissionsArray($submissionDataFile);
				for($i=0; $i < count($scheduleArray); $i++){
					writeFile($scheduleArray[$i]);
				}
/**
createSubmissionArray() takes the csv file (how we are storing without the use of a database)
and will turn the csv file back into an array representation.
When moving through all the elements of $presentationReg those are all the presentations that were submitted.
Within that the $Row will have all the information pertaining to that presentation submission.
*/

function createSubmissionsArray($dataFile){
	$submissionArray = array();

$row = 1;
if (($handle = fopen($dataFile, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
       //echo "<p> $num fields in line $row: <br /></p>\n";
        for ($c=0; $c < $num; $c++) {
            $submissionArray[$row] = $data;
        }
        $row++;
        //writeFile($submissionArray);    
    }

    fclose($handle);
}
	foreach($submissionArray as &$person){
    	//echo"Placed $person[0]";
    	placeInRoom($person);
    	}//place each row into a room
}//createSubmissionsArray


//placing the presentation into the "room"
function placeInRoom($submissionArray){
	global $scheduleArray, $oralPresRoom;

	if($submissionArray[3] == "Yes"){//is an OUR Pres
		$presRoom=0;
	}
	elseif($submissionArray[2] == "Poster"){
		$presRoom=1;//poster / art Room
	}elseif($submissionArray[2] == "Art"){
		$presRoom=1;//poster / art Room
	}
	elseif($submissionArray[2] == "Drama"){
		$presRoom=2;
	}
	else{//General oral Presentations go here
		$presRoom = $oralPresRoom;
	}//else
	$scheduleArray = schedulePlacement($submissionArray, $presRoom);
}//placeInRoom



function schedulePlacement($presentationInfo, $roomNumber){
	global $scheduleArray,$eventStartTime,$eventEndTime,$presLength,$breakStartTime,$breakEndTime,$oralPresRooms,$numOfRooms;//final array
	$prevPresRef;
	echo "$presentationInfo[0] is in schedulePlacement.\n";
	if(empty($scheduleArray[$roomNumber])){
		$presCount = 0;
		echo"====one\n";
	}
	else{
	$presCount = count($scheduleArray[$roomNumber][]);
	echo"====two\n ";
	}

	if($presCount > 0){
		$prevPresRef = ;
		echo"$prevPresRef is prev Pres\n";
	}
	else{
		$prevPresRef = 0;
		echo"====four\n";
	}

	if($prevPresRef > 0){
		writeFile($scheduleArray[$roomNumber]);
		$presStartTime = $scheduleArray[$roomNumber][$prevPresRef-1][7];//get the last presentation's end time
		echo"====five\n";
	}
	else{
		$presStartTime = $eventStartTime;
		echo"====six\n";
	}

	$presEndTime = $presStartTime + $presLength;
	if($prevPresRef == 0){//if it's first element in the presentation listing
	//array_push($presentationInfo, "$presStartTime", "$presEndTime");
		$presentationInfo[7] = "$presStartTime";
		$presentationInfo[8] = "$presEndTime";
		$scheduleArray[$roomNumber][] = $presentationInfo;//put in the presentation into the proper room. 
		echo"====seven\n";
	}

	elseif( $presEndTime > $breakStartTime){//ends after the break
		$scheduleArray[$roomNumber][] = array("Break Time", ($breakEndTime - $breakStartTime));//add the Break Time
		$presentationStartTime = $breakEndTime;
		$presentationInfo[7] = "$presStartTime";
		$presentationInfo[8] = "$presEndTime";
		$scheduleArray[$roomNumber] = $presentationInfo;//put in the presentation into the proper room. 
		echo"====eight\n";
		}
	elseif($presEndTime < $breakStartTime){//it can go before the break
		$presentationInfo[7] = "$presStartTime";
		$presentationInfo[8] = "presEndTime";
		$scheduleArray[$roomNumber] = $presentationInfo;//put the presentation into the proper room.
		echo"====nine\n";
		}
	
	else{//After the break
		if($presEndTime < $eventEndTime){//before the end of the presentation end time
			$presentationInfo[7] = "$presStartTime";
			$presentationInfo[8] = "$presEndTime";
			$scheduleArray[$roomNumber] = $presentationInfo;//put in the presentation into the proper room. 
			echo"====ten\n";
		}
		else{//what will happen if it doesn't fit.
			if ($roomNumber > 3) {//oral presentation didn't fit
				if($roomNumber-4 < $numOfRooms ){//there is a new room to go in
					schedulePlacement($presentationInfo, $roomNumber+=1);
					echo"====eleven\n";
				}//if
			}//if
			else{//can't resolve... Send to the Conflicts Array
			$scheduleArray[3] = $presentationInfo;
			echo"====twelve\n";			
			}//else
		}//else
	}//else
	return $scheduleArray;
}//schedulePlacement






function writeFile($array){
	$fp = fopen('resources/submissionFolder/scheduleFinal.txt', 'w');
				for($h=0; $h < count($array); $h++){//loop through all presentations of room
					for($i=0; $i < count($array[$h]); $i++){
						fwrite($fp, $array[$h][$i]);
					}
				}
			

	//}
//}
fclose($fp);

}






/**
WORK ON IT TOMORROW


function check_for_student_conflict($scheduleMatrix, $presEndTime, $roomNumber, $numOfRooms, $presLength){
	$studentConflict = false;
	$studentName = 0; #This is because the student name is stored constantly in the first element 
	while ($compareRoom = 4; $compareRoom < ($numOfRooms + 4); $compareRoom++) { #since our booked rooms start at 4
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
	$profName = 5; #This is because like our student name, the professor name is constantly stored in the last element
	while ($compareRoom = 4; $compareRoom < ($numOfRooms + 4); $compareRoom++) {
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
*/
?>