<!--
	createCSV.php
	
	Description: 
	This page is for taking the compiled version of the submissions page after it has been
	edited and turning that array of elements back into a .csv that overwrites the 
	original file that we are reading from. 

	File Contents:
	This file contains the .csv creation.
-->

<?php
$phpArray = json_decode($_POST['array']);//data is sent through ajax as json

//$fp = fopen('resources/data/testsave.csv', 'w+');
$fp = fopen('resources/submissionFolder/Mike Myers.csv', 'w+');

foreach($phpArray as $fields){
	fputcsv($fp, $fields);
}

fclose($fp);
?>

<!--
Supposed to be safer code but can't get it to work

$csvFromPost = filter_input(INPUT_POST, 'array', FILTER_SANITIZE_STRING);
$phpArray = json_decode($csvFromPost);
-->