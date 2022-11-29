<?php
class StreamFilterNewlines extends php_user_filter {
    function filter($in, $out, &$consumed, $closing) {

        while ( $bucket = stream_bucket_make_writeable($in) ) {
            $bucket->data = str_replace(',', "\r\n", $bucket->data);
            $consumed += $bucket->datalen;
            stream_bucket_append($out, $bucket);
        }
        return PSFS_PASS_ON;
    }
}

$number = $_POST['numField']; 
$username_length = $_POST['userField']; 

function generate_emails($number, $username_length) {
if (is_numeric($number) && $number != 0) {
	if ($number > 100000) { //put hard limit on generate request
		$number = 100000; 
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

	stream_filter_register("newlines", "StreamFilterNewlines");
	stream_filter_append($output, "newlines");

	fwrite($output, "Generated $email_count random test e-mails:");  
	fwrite($output, ","); 
	fputcsv($output, $generated_emails); 

}

if (is_numeric($username_length) && $username_length <= 24 && $username_length != 0) {

generate_emails($number, $username_length); 

} else {
	$username_length = 12; 
	generate_emails($number, $username_length); 
}

?>
