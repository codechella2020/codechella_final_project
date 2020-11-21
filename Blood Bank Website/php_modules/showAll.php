<?php
require_once 'config.php';
require_once 'main_functions.php';
session_start();
	$login = checkLogin();
	$type = "";
	if($login){
		$type = $_SESSION["type"];
	}
	// to show all the data in the database
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$sql = 'SELECT hid,hos_name,a_positive,a_negative,b_positive,b_negative,o_positive,o_negative,ab_positive,ab_negative,address_line,state FROM hospital';
		$output = "";
		if($stmt = mysqli_prepare($con,$sql)){

			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_store_result($stmt);

				if(mysqli_stmt_num_rows($stmt)>0){
					mysqli_stmt_bind_result($stmt,$id,$hos_name,$apos,$aneg,$bpos,$bneg,$opos,$oneg,$abpos,$abneg,$address,$state);
					if($login && $type == "receiver"){
						$output = '<span class="sorting">To request blood according to your eligibility, clear filters!</span><br>';
					}
					while(mysqli_stmt_fetch($stmt)){
						$output .= '<div class="col-md-6 mt-2">
						<div class="container main-content">
							<div class="row">
								<div class="col">
									<center>
										<span class="hospital-heading">'.$hos_name.'</span>
										<br>
										<small>'.$address.', '.$state.'</small>
									</center>
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/apos.svg" class="blood-icon">
									<h4>&nbsp;&nbsp;'.$apos.'</h4>
								</div>
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/aneg.svg" class="blood-icon">
									<h4>&nbsp;&nbsp;'.$aneg.'</h4>
								</div>
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/bpos.svg" class="blood-icon">
									<h4>&nbsp;&nbsp;'.$bpos.'</h4>
								</div>
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/bneg.svg" class="blood-icon">
									<h4>&nbsp;&nbsp;'.$bneg.'</h4>
								</div>
							</div>
							<div class="row justify-content-center mt-2">
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/opos.svg" class="blood-icon">
									<h4>&nbsp;&nbsp;'.$opos.'</h4>
								</div>
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/oneg.svg" class="blood-icon">
									<h4>&nbsp;&nbsp;'.$oneg.'</h4>
								</div>
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/abpos.svg" class="blood-icon">
									<h4>&nbsp;&nbsp;'.$abpos.'</h4>
								</div>
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/abneg.svg" class="blood-icon">
									<h4>&nbsp;&nbsp;'.$abneg.'</h4>
								</div>
							</div>
							<div class="row justify-content-center mt-2">';

							// check the type of user
						if($login && $type == "hospital"){
							//button for hospital
							$output .= '<div class="col-md-6 mt-1">
										<button class="btn btn-block btn-secondary disabled myself" type="button">Request for myself</button>
										</div>
										<div class="col-md-6 mt-1">
											<button class="btn btn-block btn-secondary disabled other" type="button">Request for other</button>
										</div>
									</div>
								</div>
							</div>';
							
						}
						elseif($login && $type == "receiver"){
							// show button according to the eligibility of receiver
							$disabledVariable = "";
						$buttonType = "";
						if($apos>0 && in_array("a_positive", $_SESSION["bloodEligibility"]) ){
							$disabledVariable = "";
							$buttonType = "primary";
						}
						else if($aneg>0 && in_array("a_negative", $_SESSION["bloodEligibility"])){
							$disabledVariable = "";
							$buttonType = "primary";
						}
						else if($bpos>0 && in_array("b_positive", $_SESSION["bloodEligibility"])){
							$disabledVariable = "";
							$buttonType = "primary";
						}
						else if($bneg>0 && in_array("b_negative", $_SESSION["bloodEligibility"])){
							$disabledVariable = "";
							$buttonType = "primary";
						}
						else if($opos>0 && in_array("o_positive", $_SESSION["bloodEligibility"])){
							$disabledVariable = "";
							$buttonType = "primary";
						}
						else if($oneg>0 && in_array("o_negative", $_SESSION["bloodEligibility"])){
							$disabledVariable = "";
							$buttonType = "primary";
						}
						else if($abpos>0 && in_array("ab_positive", $_SESSION["bloodEligibility"])){
							$disabledVariable = "";
							$buttonType = "primary";
						}
						else if($abneg>0 && in_array("ab_negative", $_SESSION["bloodEligibility"])){
							$disabledVariable = "";
							$buttonType = "primary";
						}
						else{
							$disabledVariable = "disabled";
							$buttonType = "secondary";
						}
							$output .= '<div class="col-md-6 mt-1">
											<button class="btn btn-block btn-'.$buttonType.'  myself" '.$disabledVariable.' type="button" data-toggle="modal" data-target="#requestMyselfModalForm">Request for myself<input type="hidden" value="'.$id.'"></button>
										</div>
										<div class="col-md-6 mt-1 ">
											<button class="btn btn-block btn-primary other" type="button" data-toggle="modal" data-target="#requestOtherModalForm">Request for other<input type="hidden" value="'.$id.'"></button>
										</div>
									</div>
								</div>
							</div>';
						}
						else{
							//if user not loggedin
							$output .= '<div class="col-md-6 mt-1">
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

		}
		else{
			// if no data found
			$output .= '<div class="col-md-12 mt-2">
				<div class="container main-content"><div class="row justify-content-center">
						<div class="col-xs-12 mx-2">
							<img src="https://img.icons8.com/fluent/96/000000/nothing-found.png"/>
							<h4>No Data Found!! </h4>
						</div></div></div>';
		}
		echo $output;
	}

}
}
?>