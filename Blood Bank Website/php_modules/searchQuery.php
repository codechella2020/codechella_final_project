<?php
require_once 'config.php';
require_once 'main_functions.php';
session_start();
	$login = checkLogin();
	$type = "";
	if($login){
		$type = $_SESSION["type"];
	}

	// search the hospitals which user has requested
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$hid = (int) $_POST["id"];
		
		$bloodType = filter_var(trim($_POST["blood"]),FILTER_SANITIZE_STRING);
		
		// fetch all the blood bank data of that hospital		
		$sql = 'SELECT hid,hos_name,a_positive,a_negative,b_positive,b_negative,o_positive,o_negative,ab_positive,ab_negative,address_line,state FROM `hospital` WHERE ';

		// construct the query according to the need of the user
		if(!empty($hid)){
			$sql .= 'hid = '.$hid;
		}
		
		if(!empty($bloodType)){
			
			
			if(!empty($hid)){
				$sql .= ' and ';
			}
			$sql .= $bloodType.'>0';
		}
		
		$result = mysqli_query($con,$sql);
		
		$output = "";
		
		if (mysqli_num_rows($result) > 0) {
			if($login && $type == "receiver"){
				$output = '<span class="sorting">To request blood according to your eligibility, clear filters!</span><br>';
			}
			while ($row = mysqli_fetch_array($result)) {
			
				$output .= '<div class="col-md-6 mt-2">
				<div class="container main-content">
					<div class="row">
						<div class="col">
							<center>
								<span class="hospital-heading">'.$row["hos_name"].'</span>
								<br>
								<small>'.$row["address_line"].', '.$row["state"].'</small>
							</center>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-xs-3 mx-2">
							<img src="images/blood-icons/apos.svg" class="blood-icon">
							<h4>&nbsp;&nbsp;'.$row["a_positive"].'</h4>
						</div>
						<div class="col-xs-3 mx-2">
							<img src="images/blood-icons/aneg.svg" class="blood-icon">
							<h4>&nbsp;&nbsp;'.$row["a_negative"].'</h4>
						</div>
						<div class="col-xs-3 mx-2">
							<img src="images/blood-icons/bpos.svg" class="blood-icon">
							<h4>&nbsp;&nbsp;'.$row["b_positive"].'</h4>
						</div>
						<div class="col-xs-3 mx-2">
							<img src="images/blood-icons/bneg.svg" class="blood-icon">
							<h4>&nbsp;&nbsp;'.$row["b_negative"].'</h4>
						</div>
					</div>
					<div class="row justify-content-center mt-2">
						<div class="col-xs-3 mx-2">
							<img src="images/blood-icons/opos.svg" class="blood-icon">
							<h4>&nbsp;&nbsp;'.$row["o_positive"].'</h4>
						</div>
						<div class="col-xs-3 mx-2">
							<img src="images/blood-icons/oneg.svg" class="blood-icon">
							<h4>&nbsp;&nbsp;'.$row["o_negative"].'</h4>
						</div>
						<div class="col-xs-3 mx-2">
							<img src="images/blood-icons/abpos.svg" class="blood-icon">
							<h4>&nbsp;&nbsp;'.$row["ab_positive"].'</h4>
						</div>
						<div class="col-xs-3 mx-2">
							<img src="images/blood-icons/abneg.svg" class="blood-icon">
							<h4>&nbsp;&nbsp;'.$row["ab_negative"].'</h4>
						</div>
					</div>';

					// for receiver


					if($login && $type == "receiver"){
						// check to show the button disabled or enabled
						$disabledVariable = "";
						$buttonType = "";
						if($row["a_positive"]>0 && in_array("a_positive", $_SESSION["bloodEligibility"]) ){
							$disabledVariable = "";
							$buttonType = "primary";
						}
						else if($row["a_negative"]>0 && in_array("a_negative", $_SESSION["bloodEligibility"])){
							$disabledVariable = "";
							$buttonType = "primary";
						}
						else if($row["b_positive"]>0 && in_array("b_positive", $_SESSION["bloodEligibility"])){
							$disabledVariable = "";
							$buttonType = "primary";
						}
						else if($row["b_negative"]>0 && in_array("b_negative", $_SESSION["bloodEligibility"])){
							$disabledVariable = "";
							$buttonType = "primary";
						}
						else if($row["o_positive"]>0 && in_array("o_positive", $_SESSION["bloodEligibility"])){
							$disabledVariable = "";
							$buttonType = "primary";
						}
						else if($row["o_negative"]>0 && in_array("o_negative", $_SESSION["bloodEligibility"])){
							$disabledVariable = "";
							$buttonType = "primary";
						}
						else if($row["ab_positive"]>0 && in_array("ab_positive", $_SESSION["bloodEligibility"])){
							$disabledVariable = "";
							$buttonType = "primary";
						}
						else if($row["ab_negative"]>0 && in_array("ab_negative", $_SESSION["bloodEligibility"])){
							$disabledVariable = "";
							$buttonType = "primary";
						}
						else{
							$disabledVariable = "disabled";
							$buttonType = "secondary";
						}
						$output .= '<div class="row justify-content-center mt-2">
									<div class="col-md-6 mt-1">
										<button class="btn btn-block btn-'.$buttonType.'  myself" type="button" '.$disabledVariable.' data-toggle="modal" data-target="#requestMyselfModalForm">Request for myself<input type="hidden" value="'.$row["hid"].'"></button>
									</div>
									<div class="col-md-6 mt-1">
										<button class="btn btn-block btn-primary other" type="button" data-toggle="modal" data-target="#requestOtherModalForm">Request for other<input type="hidden" value="'.$row["hid"].'"></button>
									</div>
								</div>
							</div>
						</div>';
					}
					elseif($login && $type == "hospital"){
						//button fort hospital
						$output .= '<div class="row justify-content-center mt-2">
									<div class="col-md-6 mt-1">
										<button class="btn btn-block btn-secondary disabled myself" type="button">Request for myself</button>
									</div>
									<div class="col-md-6 mt-1">
										<button class="btn btn-block btn-secondary disabled other" type="button">Request for other</button>
									</div>
								</div>
							</div>
						</div>';
					}
					else{
						//button for non-loggedin users
						$output .= '<div class="row justify-content-center mt-2">
									<div class="col-md-6 mt-1">
										<button class="btn btn-block btn-primary myself" type="button" data-toggle="modal" data-target="#signinModalForm">Request for myself</button>
									</div>
									<div class="col-md-6 mt-1">
										<button class="btn btn-block btn-primary other" type="button" data-toggle="modal" data-target="#signinModalForm">Request for other</button>
									</div>
								</div>
							</div>
						</div>';
					}
					
			}
		}else{
			// if no data found
			$output = '<div class="col-md-12 mt-2">
				<div class="container main-content"><div class="row justify-content-center">
						<div class="col-xs-12 mx-2">
							<img src="https://img.icons8.com/fluent/96/000000/nothing-found.png"/>
							<h4>No Data Found!! </h4>
						</div></div></div>';
		}
		echo $output;
	}


?>
