<?php
$csvFromPost = filter_input(INPUT_POST, 'finalCSV', FILTER_SANITIZE_STRING);
$phpArray = json_decode($csvFromPost);

$fp = fopen('testsave.csv', 'w');

foreach($phpArray as $fields){
	fputcsv($fp, $fields);
}

fclose($fp);
?>