<?php
require_once 'config.php';
session_start();

	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$hos_name = $_SESSION["name"];
	
		$request_id = $_POST["rid"];
		$email = $_POST["email"];

		$sql = 'DELETE FROM requests where rid = ?';
		if($stmt = mysqli_prepare($con,$sql))
		{
			mysqli_stmt_bind_param($stmt,"i",$request_id);
			if (mysqli_stmt_execute($stmt)) {

				// send email to the receiver section
				// this section will not work if you test it on local server
				// $msg = "We are sorry to inform you that your request for blood at ".$hos_name." has been declined by the authority.<br><br>- Blood Bank Team";

				// $msg = wordwrap($msg,100);
				// mail($email,"Acceptance of Blood Group Status",$msg);
				echo "success";
			}
			else{
				echo "error";
			}
		}
		else{
			echo "error";
		}


	}

?>