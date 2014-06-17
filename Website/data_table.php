<?php
//header('Content-type: application/json');

// Set your CSV feed
$url = "https://docs.google.com/spreadsheet/pub?key=0An2BgPnSFrG6dFE2XzF0bVl0cmZfbVYtcThGRFo4anc&single=true&gid=1&output=txt";


// create curl resource 
$ch = curl_init(); 
// set url 
curl_setopt($ch, CURLOPT_URL, $url); 
//return the transfer as a string 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
// $output contains the output string 
$output = curl_exec($ch); 
// close curl resource to free up system resources 
curl_close($ch);




$csv = explode("\n", trim($output) );
$lines = array();
foreach ($csv as &$line )
{
	$lines[] = explode("\t", trim($line));
}

$array = array();
$head = array_shift($lines);
foreach ($lines as $line)
{
	$item = array();
	foreach ($line as $key=>$value )
	{
		$item[$head[$key]] = $value; 
	}

	/* RANDOM LOCATIONS FOR DEBUGING
	if(!$item["latitude"] || empty($item["latitude"]) || !$item["longitude"] || empty($item["longitude"]))
	{
		$item["latitude"] = 31.768319 + (rand(-5, 5) / 100);
		$item["longitude"] = 35.21371 + (rand(-5, 5) / 100);
	}
	*/

	$array[] = (object)$item;
}


echo 'var data = { "companies" : '.json_encode($array).' };';


?>