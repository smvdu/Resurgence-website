<?php

function is_localhost(){

	return (strcmp($_SERVER['SERVER_NAME'],"localhost")) ? true : false ;

}

?>