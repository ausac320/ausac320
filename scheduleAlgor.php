<?php
/**
This is where all the schedule building logic is going to be written.
All functions here will pertain to getting the data that is submitted and will 
organize it in a way that will be turned into a csv file that will represent the schedule. 
*/

$submissionDataFile = "resources/submissionFolder/scheduleTest.csv";//this is the file that contains the submission data
				$data;
				$submissionArray = createSubmissionsArray($submissionDataFile);
				$roomsArray =  array();//array that holds an array of submissions
				$scheduleArray = array($submissionArray);//holds the array of submissions
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
	global $submissionArray;
	global $scheduleArray;
	global $data;
	$submissionArray = array();
	$scheduleArray = array();
$row = 1;
if (($handle = fopen($dataFile, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        //echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            $scheduleArray[$c] = $data[$c];
            //echo $scheduleArray[$c] . ", ";
        }
        for($i=0; $i < count($scheduleArray); $i++){
        	$submissionArray[$i] = $scheduleArray;
        	//echo $submissionArray[$i][$i]. ", ";
        }
        for($j=0; $j < count($submissionArray); $j++){
        	$allSubArray[$j] = $submissionArray;//holds all submissions 
        	//echo $allSubArray[$j][$j][$j];//prints out everything on one line
        }
    
        writeFile($allSubArray);

    }
    //exportCSV($scheduleArray[]);
    fclose($handle);
}
//return $scheduleArray;
}//createSubmissionsArray

function array_2_csv($array) {
$csv = array();
foreach ($array as $item=>$val) {
    if (is_array($val)) { 
        $csv[] = $this->array_2_csv($val);
        $csv[] = "\n";
    } else {
        $csv[] = $val;
    }
}
return implode(';', $csv);
}

//placing the presentation into the "room"
function placeInRoom($submissionsArray){
	global $oralPresRooms;
	global $submissionArray;
	global $scheduleArray;
	$oralPresRooms = 4;
	for($i=0; $i < count($submissionsArray); $i++){
		if($submissionArray[$i] === "Yes"){//is an OUR Pres
			schedulePlacement($submissionsArray[$i], 0);
		}
		if($submissionsArray[$i][2] === "Poster" or "Art"){
			schedulePlacement($submissionsArray[$i], 1);
		}
		elseif($submissionsArray[$i][2] === "Drama"){
			schedulePlacement($submissionsArray[$i], 2);
		}
		else{//General oral Presentations go here

			schedulePlacement($submissionArray[$i], $oralPresRooms);
					
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
	$count = 0;

	foreach ($scheduleArray as $type) {
    	$count+= count($type);
	}
	if($count > 0){
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
		$presentationInfo = $presStartTime;
		$presentationInfo = $presStartTime + $presLength;
	}
	elseif($presStartTime < $breakStartTime){//before the break
		if( $presEndTime > $breakStartTime){//runs into the break - set to after the break
			$scheduleArray[$roomNumber] = array("Break Time", ($breakEndTime - $breakStartTime));//add the Break Time
			$presentationStartTime = $breakEndTime;
			$presentationInfo = "$presStartTime";
			$presentationInfo = "$presStartTime + $presLength";
			$scheduleArray[$roomNumber] = $presentationInfo;//put in the presentation into the proper room. 
		}
		else{//it can go before the break
			$presentationInfo = "$presStartTime";
			$presentationInfo = "$presStartTime + $presLength";
			$scheduleArray[$roomNumber] = $presentationInfo;//put the presentation into the proper room.
		}
	}
	else{//After the break
		if($presStartTime+$presLength < $eventEndTime){//before the end of the presentation end time
			$presentationInfo = "$presStartTime";
			$presentationInfo = "$presStartTime + $presLength";
			$scheduleArray[$roomNumber] = $presentationInfo;//put in the presentation into the proper room. 
		}
		else{//what will happen if it doesn't fit.
			if ($roomNumber > 3) {//this is oral presentations that don't fit.
			global $numOfRooms;
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


function writeFile($roomsArray){
	global $data;
	$fp = fopen('resources/submissionFolder/scheduleFinal.txt', 'w');
		//for($i=0; $i< count($roomsArray); $i++){
			//echo $roomsArray[$i]. ", ";
			//for($j=0; $j< count($roomsArray[$i]); $j++){
				//echo $roomsArray[$j][$j]. ", ";
				for($h=0; $h < count($data); $h++){
					echo $roomsArray[$h][$h][$h];
					fwrite($fp, $roomsArray[$h][$h][$h]."\n");
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