<?php
require_once 'config.php';
session_start();

	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$hos_name = $_SESSION["name"];
		$hid = (int)$_SESSION["id"];
		$request_id = (int)$_POST["rid"];
		$email = $_POST["email"];
		$bloodType = $_POST["blood"];
		$amount = (int)$_POST["amount"];
		
		$query = "SELECT ".$bloodType." FROM hospital WHERE hid = ".$hid;
		$result = mysqli_query($con,$query);
		if($row = mysqli_fetch_array($result)){
			$value = (int)$row[$bloodType];
			$value = $value - $amount;
			echo $value."->";
			$sql = "UPDATE hospital SET ".$bloodType."=".$value." WHERE hid = ".$hid;
			if($result = mysqli_query($con,$sql)){
				// echo '<script>console.log("'.$sql.'");</script>';
				$sql1 = 'UPDATE requests SET status = 1 WHERE rid = '.$request_id;
				if($result1 = mysqli_query($con,$sql1)){

					// section to send mail 
					//this section will not work if you test in local server

					// $msg = "Your request for blood at ".$hos_name." has been accepted by the authority. Your request id is ".$request_id.". Contact with the hospital immediately. Phone Number - ".$phone;

			        	
			  	//   $msg = wordwrap($msg,200);

			
				 //    mail($email,"Acceptance of Blood Group Status",$msg);
					echo "success";
				}
				else{
					echo "error";
				}
			}
		}		
		else{
			echo "error";
		}
		

	}

?>