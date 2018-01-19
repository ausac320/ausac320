<?php
$phpArray = json_decode($_POST['array']);

//$fp = fopen('resources/data/testsave.csv', 'w+');
$fp = fopen('resources/submissionFolder/Mike Myers.csv', 'w+');

foreach($phpArray as $fields){
	fputcsv($fp, $fields);
}

fclose($fp);

//Supposed to be safer code but can't get it to work
//
//$csvFromPost = filter_input(INPUT_POST, 'array', FILTER_SANITIZE_STRING);
//$phpArray = json_decode($csvFromPost);
?>
