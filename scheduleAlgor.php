<?php





$filename = "scheduleTest.csv";
$csvArray = ImportCSV2Array($filename);

foreach ($csvArray as $row){
    echo $row['column1'];
    echo $row['column2'];
    echo $row['column3'];
    echo $row['column4'];
    echo $row['column5'];
    echo $row['column6'];
    echo $row['column7'];
	}

	function openCSV($fileToOpen)
	{
    $row = 0;
    $col = 0;
 
    $handle = @fopen($filename, "r");
    if ($handle) 
    {
        while (($row = fgetcsv($handle, 4096)) !== false) 
        {
            if (empty($fields)) 
            {
                $fields = $row;
                continue;
            }
 
            foreach ($row as $k=>$value) 
            {
                $results[$col][$fields[$k]] = $value;
            }
            $col++;
            unset($row);
        }
        if (!feof($handle)) 
        {
            echo "Error: unexpected fgets() failn";
        }
        fclose($handle);
    }
 
    return $results;
}

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
	dailyPresentation = eventLength / periodLength;
	fclose($file);
	return timePeriods;
}

function fill_schedule_matrix($scheduleMatrix, $submissionsArray )

?>