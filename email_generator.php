<?php

$number = $_POST['numField']; 
$username_length = $_POST['userField']; 



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
		$fullAddress = $randomName . "@" ."example.".$extension; 
		$generated_emails[] = $fullAddress; 	
		$email_count = count($generated_emails); 

		}
		
	}

	header('Content-Type: text/txt; charset=utf-8'); 
	header('Content-Disposition: attachment; filename=emails.txt'); 

	$output = fopen('php://output', 'w'); 

	fwrite($output, "Generated $email_count random test e-mails:");  
	fwrite($output, "    "); 
	fputcsv($output, $generated_emails); 

}

if (is_numeric($username_length) && $username_length <= 24 && $username_length != 0) {

generate_emails($number, $username_length); 

} else {
	$username_length = 12; 
	generate_emails($number, $username_length); 
}

?>