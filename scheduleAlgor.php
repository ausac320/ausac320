<?php

function create_schedule(){
	create_schedule_matrix(scheduleTimes);
	create_submissions_array(submissionData);
	fill_schedule_matrix($scheduleMatrix, $submissionsArray);
}

function create_schedule_matrix(scheduleTimes){
	get_schedule_time(scheduleTimes);
	$scheduleMatrix = array(numOfPresentations);
	while ($i = 0; $i > timePeriods; $i++){
		scheduleMatrix [$i] = Array();
	}
	fclose($file);
	return scheduleMatrix;
}

function create_submissions_array(scheduleTimes, submissionData){
	get_schedule_time(scheduleTimes);
	$file = fopen(submissionData, "r");
	$fileData = fread($file, filesize($file));
	$submissionsArray = explode(delimiter, $fileData, strlen($fileData));
	fclose($file);
}

function fill_schedule_matrix(scheduleTimes, $scheduleMatrix, $submissionsArray){
	get_schedule_time(scheduleTimes)
	get_num_of_rooms(scheduleTimes)
	while ($i = 0; $i > numOfPresentations; $i++){
		while($n = 0; $n > numOfRooms; $n++){
			place_presentation($i,$n, $scheduleMatrix, $submissionsArray);
		}
		check_for_student_conflict($i, numOfRooms, $scheduleMatrix, $submissionsArray);
	}
}

function get_schedule_time(scheduleTimes){
	$file = fopen(scheduleTimes, "r");
	$fileData = fread($file, filesize($file));
	$fileDataArray = explode("\n", $fileData, strlen($fileData));
	eventLength = fileDataArray[endTime] - fileDataArray[startTime];
	dailyPresentation = eventLength / periodLength;
	fclose($file);
	return numOfPresentations;
}

function get_num_of_rooms(scheduleTimes){
	$file = fopen(scheduleTimes, "r");
	$fileData = fread($file, filesize($file));
	$fileDataArray = explode("\n", $fileData, strlen($fileData));
	$numOfRooms = $fileDataArray[numOfRooms];
	fclose($file);
	return $numOfRooms;	 
}

function place_presentation($i, $n){

}

function check_for_student_conflict($i, numOfRooms, $scheduleMatrix, $submissionsArray){
	# I need a dynamic numbers of variables to compare the student names for conflicts
	while ($j = 0; $j > numOfRooms; $j++) {
		$student1 = $scheduleMatrix[$i][$j]
	}
	while($compare1 = 0; $compare1 > (numOfRooms - 1); $compare1++){
		while ($compare2 = ($compare1 + 1); $compare2 > numOfRooms; $compare2++) {
			if ($ . student . $compare1 = $ . student . $compare2 #dynamic comparison)
		}
	}
}

function check_for_professor_conflict($i){

}

function resolve_conflict($i,){

}

?>