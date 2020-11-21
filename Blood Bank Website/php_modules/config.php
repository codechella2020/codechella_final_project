<?php
	$con = mysqli_connect('localhost','root','','blood_bank');
	

	if( $con == false )
	{
		die("ERROR : Could not connect ." .mysqli_connect_error());
	}

?>