<?php
$contact = json_decode($_POST['string']);

$fp = fopen('resources/data/testContact.txt', 'w+');

$finalContact = explode("<br>", $contact);

for($i=0; $i<count($finalContact)-1; $i++){
	$txt = $finalContact[$i];
	fwrite($fp, $txt);
}

fclose($fp);
?>