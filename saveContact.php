<!--
	saveContact.php
	
	Description: 
	This page will take a string of the current contact info in as it's parameter 
	and break up that string  into lines based on the <br> or linebreak characteristic 
	and write it all back to our file we are overwriting.

	File Contents:
	This file contains the .txt creation.
-->


<?php
$contact = json_decode($_POST['string']);//data is sent through ajax as json


$fp = fopen('resources/data/testContact.txt', 'w+');

$finalContact = explode("<br>", $contact);//seperate based on line

for($i=0; $i<count($finalContact)-1; $i++){
	$txt = $finalContact[$i];
	fwrite($fp, $txt);
}

fclose($fp);
?>