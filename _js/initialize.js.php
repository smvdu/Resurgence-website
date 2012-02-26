<?php 
$file_array = file('_js/initialize.js');

for($i = 0; $i < count($file_array); $i++) 
{
    $data = trim($file_array[$i]); 
	if(substr($data,0,2)=="//")
		continue;
	$data = str_replace("\t"," ", $data);
	$data = str_replace("  "," ", $data);
	echo $data; 
} 
//echo $data;
?>