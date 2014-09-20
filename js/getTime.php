<?php
	include_once("classes/getTimeClass.php");

	if(isset($_GET['city'])) {
		
		//Get the time details from google
		$TimeClass = new TimeClass();
		$TimeClass->getTimeCity($_GET['city']);
		
	}
?>