<?php
$phpArray = json_decode($_POST['array']);

//$fp = fopen('resources/data/testsave.csv', 'w+');
$fp = fopen('resources/data/testSchedule.csv', 'w+');

foreach($phpArray as $fields){
	fputcsv($fp, $fields);
}

fclose($fp);
?>
