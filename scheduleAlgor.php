<?php

function create_schedule(){
	create_schedule_matrix(scheduleTimes);
	create_submissions_array(submissionData);
	fill_schedule_matrix($scheduleMatrix, $submissionsArray);
}

function create_schedule_matrix(scheduleTimes){
	get_schedule_time(scheduleTimes);
	$scheduleMatrix = array(timePeriods);
	while (i = 0; i > timePeriods; i++){
		scheduleMatrix [i] = Array();
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

function get_schedule_time(scheduleTimes){
	$file = fopen(scheduleTimes, "r");
	$fileData = fread($file, filesize($file));
	$fileDataArray = explode("\n", $fileData, strlen($fileData));
	eventLength = fileDataArray[endTime] - fileDataArray[startTime];
	timePeriods = eventLength / periodLength;
	fclose($file);
	return timePeriods;
}

function fill_schedule_matrix($scheduleMatrix, $submissionsArray )

?>