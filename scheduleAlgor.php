<?php
/**
This is where all the schedule building logic is going to be written.
All functions here will pertain to getting the data that is submitted and will 
organize it in a way that will be turned into a csv file that will represent the schedule. 
*/

$submissionDataFile = "resources/submissionFolder/scheduleTest.csv";//this is the file that contains the submission data
				$data;
				createSubmissionsArray($submissionDataFile);
				$scheduleArray = array();//this will be the final array where the schedule will be stored
				$presLength = 5;
				$eventStartTime = 6*60;//start @ 6:00
				$eventEndTime = 10*60;//end @ 10:00
				$breakStartTime = 8*60;//break start @ 8:00
				$breakEndTime = 9*60;//break end @ 9:00
				$numOfRooms = 5;
				$oralPresRooms;
				

/**
createSubmissionArray() takes the csv file (how we are storing without the use of a database)
and will turn the csv file back into an array representation.
When moving through all the elements of $presentationReg those are all the presentations that were submitted.
Within that the $Row will have all the information pertaining to that presentation submission.
*/

function createSubmissionsArray($dataFile){
	global $scheduleArray;
	global $data;
	$submissionArray = array();
	$scheduleArray = array();
	$allSubs = array();

$row = 1;
if (($handle = fopen($dataFile, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
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
	global $oralPresRooms;
	$oralPresRooms = 4;
	echo $submissionArray[0]." ".$submissionArray[2];
	if($submissionArray[3] == "Yes"){//is an OUR Pres
		schedulePlacement($submissionArray, 0);
		echo"placed in OUR.\n";
	}
	elseif($submissionArray[2] == "Poster"){
		schedulePlacement($submissionArray, 1);//poster / art Room
		echo"placed in Poster.\n";
	}elseif($submissionArray[2] == "Art"){
		schedulePlacement($submissionArray, 1);//poster / art Room
		echo"placed in Poster.\n";
	}
	elseif($submissionArray[2] == "Drama"){
		schedulePlacement($submissionArray, 2);
		echo"placed in Drama Room.\n";
	}
	else{//General oral Presentations go here
		schedulePlacement($submissionArray, $oralPresRooms);
		echo "placed in Oral Room.\n";
	}//else
}//placeInRoom



function schedulePlacement($presentationInfo, $roomNumber){
	global $scheduleArray;//final array
	global $eventStartTime;
	global $eventEndTime;
	global $presLength;
	global $breakStartTime;
	global $breakEndTime;
	global $oralPresRooms;
	global $numOfRooms;
	$prevPresRef;

	if(empty($scheduleArray[$roomNumber])){
		$presCount = 0;
	}
	else{
	$presCount = count($scheduleArray[$roomNumber]);
	}

	if($presCount > 0){
		$prevPresRef = $count - 1;
	}
	else{
		$prevPresRef = 0;
	}

	if($prevPresRef > 0){
		$presStartTime = $scheduleArray[$roomNumber][$prevPresRef-1][8];//get the last presentation's end time
	}
	else{
		$presStartTime = $eventStartTime;
	}

	$presEndTime = $presStartTime + $presLength;
	if($prevPresRef == 0){//if it's first element in the presentation listing
		$presentationInfo[] = "$presStartTime";
		$presentationInfo[] = "$presEndTime";
	}

	elseif( $presEndTime > $breakStartTime){//ends after the break
		$scheduleArray[$roomNumber][] = array("Break Time", ($breakEndTime - $breakStartTime));//add the Break Time
		$presentationStartTime = $breakEndTime;
		$presentationInfo[] = "$presStartTime";
		$presentationInfo[] = "$presEndTime";
		$scheduleArray[$roomNumber] = $presentationInfo;//put in the presentation into the proper room. 
		}
	elseif($presEndTime < $breakStartTime){//it can go before the break
		$presentationInfo[] = "$presStartTime";
		$presentationInfo[] = "presEndTime";
		$scheduleArray[$roomNumber] = $presentationInfo;//put the presentation into the proper room.
		}
	
	else{//After the break
		if($presEndTime < $eventEndTime){//before the end of the presentation end time
			$presentationInfo[] = "$presStartTime";
			$presentationInfo[] = "$presEndTime";
			$scheduleArray[$roomNumber] = $presentationInfo;//put in the presentation into the proper room. 
		}
		else{//what will happen if it doesn't fit.
			if ($roomNumber > 3) {//oral presentation didn't fit
				if($roomNumber-4 < $numOfRooms ){//there is a new room to go in
					schedulePlacement($presentationInfo, $roomNumber+=1);
				}//if
			}//if
			else{//can't resolve... Send to the Conflicts Array
			$scheduleArray[3] = $presentationInfo;
			}//else
		}//else
	}//else
}//schedulePlacement






function writeFile($array){
	global $data;
	$fp = fopen('resources/submissionFolder/scheduleFinal.txt', 'w');
		//for($i=0; $i< count($roomsArray); $i++){
			//echo $roomsArray[$i]. ", ";
			//for($j=0; $j< count($roomsArray); $j++){
				//echo $roomsArray[$j][$j]. ", ";
				for($h=0; $h < count($data); $h++){
					//echo $roomsArray[$h][$h][$h];
					fwrite($fp, $array[$h][$h]."\n");
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