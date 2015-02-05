<?php
try{
if( isset($_REQUEST["name"]) && isset($_REQUEST["email"]) && isset($_REQUEST["college"]) && isset($_REQUEST["phone_no"])){
		
	require_once("connect.php");
     
	//**check if email is already registered
	$query="Select * from registered_user where email='".trim(urldecode(strip_tags($_REQUEST["email"])))."';";
	$result=mysql_query($query);
	while($res=mysql_fetch_array($result))
	{
		exit ('Email is already registered');		
	}
	//trim space from each of the element from java
    
    
    
	$query="Insert into registered_user (name,email,college,phone_no)values('".trim(urldecode(strtolower(strip_tags($_REQUEST["name"]))))."','".trim(urldecode(strip_tags($_REQUEST["email"])))."','".urldecode(strip_tags($_REQUEST["college"]))."','".strip_tags($_REQUEST["phone_no"])."');";
	$result=mysql_query($query)
                    or die('Invalid Entry');

    $quert="Select * from registered_user where email='".trim(urldecode(strip_tags($_REQUEST["email"])))."';";
	$resulty=mysql_query($quert)
				or die('Invalid Entry');
	echo "You are registered successfully";
}
else
echo "Invalid Entry";
}
catch (Exception $e) {
    echo  "Something went wrong. Try again!!!";
}
?>