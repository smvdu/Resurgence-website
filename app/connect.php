<?php
	/**
 * MYSQL Cerendentials Include Page
 *
 * @author Laxmikant Revdikar <laxmikant.4644@gmail.com>
 */
			$mysql=mysql_connect("localhost","root","smvdu@123")
			or die ("Cannot connect to database");
			if (mysqli_connect_errno())
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			$db = mysql_select_db("res16",$mysql);
?>
