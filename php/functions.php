<?php

	function check_fields($array,&$missing)
	{
		$flag=true;
		foreach ($array as $key => $value) 
		{
			if( $key=='email_id')
			{
				if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $value))
		        {
		        	$missing[]=$key;
		        	$flag=false;
		        }
			}
			
			if(empty($key))
			{
				$missing[]=$key;
				$flag=false;
			}
				
		}

		return ($flag);
	}

	function check_accomodation_value($value,&$missing)
	{
		$possible=array('yes','YES','Yes','yEs','yeS','NO','no','No','nO');

		if(in_array($value,$possible))
			$flag=true;
		else
		{
			$missing[]="accomodation";
			$flag=false;
		}
		return ($flag);
	}

	function check_email_register($email_id,&$missing)
	{
		$sql = "SELECT * FROM register WHERE `email_id`='".$email_id."'";
		$query = mysql_query($sql) or die(mysql_error());

		if(mysql_num_rows($query)>0)
		{
			$missing[]="email_id";
			return false;
		}
		else
			return true;
	}
?>