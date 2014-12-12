<?php

$number = 10002; 

$username_length = 24; 

function generate_emails($number, $username_length) {
if (is_numeric($number) && $number != 0) {
	if ($number > 1000) { //put hard limit on generate request
		$number = 1000; 
	}
	$generated_email_addresses = array(); 
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
	$char_count = count($characters); 
	$tld = array("com", "net", "biz"); 
	for ($i=0; $i<$number; $i++){
		$randomName = ''; 
		for($j=0; $j<$username_length; $j++){
		$randomName .= $characters[rand(0, strlen($characters) -1)];
	}
		$k = array_rand($tld); 
		$extension = $tld[$k]; 
		$fullAddress = $randomName . "@" ."example".$extension; 
		$generated_emails[] = $fullAddress; 	
		echo "<br />$fullAddress<br />"; 	

		}
		
	}

	$lines = count($generated_emails); 	
	echo "There are $lines lines of e-mail data"; 
	$fp = fopen("emails.csv", "w"); 
	fputcsv($fp, $generated_emails); 
	fclose($fp); 

	header('Content-Type: application/csv'); 
	header('Content-Disposition: attachment; filename="emails.csv"'); 

}



generate_emails($number, $username_length); 



			/*$randomName = '';
			$randomName .= $characters[rand(0, strlen($characters) -1)]; 
			print_r($randomName);  
			echo "<br />"; */

?>