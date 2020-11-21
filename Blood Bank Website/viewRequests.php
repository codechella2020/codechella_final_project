<?php
session_start();
require_once 'php_modules/main_functions.php';
require_once 'php_modules/config.php';
	
	// check login
	$login = checkLogin();
	$output = '';
	if($login && $_SESSION["type"]=="hospital"){
		// check whether logged in as hospital
		$output = loggedInAsHospital();
		$_SESSION["dontShowRequest"] = true;
	}
	else{

		// else redirect to index page
		header("Location: index.php");
	}

	/**
		query to show the pending request
											*/

	$id = $_SESSION["id"];
	$sql = "SELECT rid,uid,patient_name,email,blood_group,bottles FROM requests WHERE hid = ? and status = 0";
	
	if($stmt = mysqli_prepare($con,$sql))
	{
		//Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt,"s",$param_id);

		//set parameter
		$param_id = $id;
		if (mysqli_stmt_execute($stmt)) {
			
			$content="";
			mysqli_stmt_store_result($stmt);
			if(mysqli_stmt_num_rows($stmt)>0){
				mysqli_stmt_bind_result($stmt,$rid,$uid,$p_name,$email,$blood,$amount);
				$content = '<center><span class="request-heading">Pending Requests</span></center>';
				
				while(mysqli_stmt_fetch($stmt)){
					$content .= '<div class="row mt-3 request-row">
			
							<div class="col-md-3 align-self-center">
								
								<center><i class="fas fa-user-alt" style="font-size: 4em; color: #A8DADC;"></i></center>
							</div>
							<div class="col-md-4">
								<span class="request-title">'.$p_name.' requested for '.$amount.' units of blood of type '.convertBloodType($blood).'.<br>Email - '.$email.'</span></center>
							</div>
							<div class="col-md-2 mt-1 align-self-center btn-decline">
								<button class="btn btn-block btn-danger decline" type="button">Decline <i class="fa "></i><input type="hidden" class="requestId" value="'.$rid.'">
								<input type="hidden" class="emailId" value="'.$email.'">
								<input type="hidden" class="amount" value="'.$amount.'">
								<input type="hidden" class="blood" value="'.$blood.'"></button>
							</div>
							<div class="col-md-2 mt-1 align-self-center btn-accept">
								<button class="btn btn-block btn-primary accept" type="button" >Accept <i class="fa "></i><input type="hidden" class="requestId" value="'.$rid.'">
								<input type="hidden" class="emailId" value="'.$email.'">
								<input type="hidden" class="amount" value="'.$amount.'">
								<input type="hidden" class="blood" value="'.$blood.'"></button>
							</div>
							
						</div>';
				}
			}
			else{

				// if no pending request

				$content .= '<div class="col-md-12 mt-2">
							<div class="container main-content"><div class="row justify-content-center">
									<div class="col-xs-12 mx-2">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-smile" style="color: #E63946; font-size:5em;"></i><br>
										<h4>No Pending Requests!! </h4>
									</div></div></div>';
			}
		}
	}
					

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Blood Bank</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/viewRequests.css">
	<!-- bootstrap, fontawesome and jquery CDNs -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Amaranth&display=swap" rel="stylesheet">
	<!-- animate.css cdn -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" />
</head>
<body>

						<!-- ---------------------- -->
						<!-- navigation bar portion -->
						<!-- ---------------------- -->

	<header>
		<div class="container">
			<nav class="navbar fixed-top navbar-expand-sm navbar-light scrolled">
  				<a class="navbar-brand" href="#"><span class="heading">Blood<img src="images/blood.png" class="heading-img">Bank</span></a>
  				<button class="navbar-toggler toggle-btn" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    				<span class="navbar-toggler-icon"></span>
  				</button>

	  			<div class="collapse navbar-collapse front" id="navbarSupportedContent">
	    			<ul class="navbar-nav ml-lg-auto">
	      				<li class="nav-item home">
	        				<a class="nav-link" href="index.php">Home</a>
	      				</li>
	      				<li class="nav-item">
	        				<a class="nav-link" href="availability.php">Check Availability</a>
	      				</li>
	      				<li class="nav-item">
	        				<a class="nav-link" href="index.php#about">About Us</a>
	      				</li>
	      				
	      				<?php echo $output;?>
	    			</ul>
	    			
	 			</div>
			</nav>
		</div>
	</header>
						
						<!-- ----------------- -->
						<!-- main body of page -->
						<!-- ----------------- -->


	<div class="container main-container">
		
		<?php echo $content; ?>
		
	</div>


	<!-- popperJS, botstrap JS CDNs -->
	<script type="text/javascript" src="js/main.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<!-- texillate.js cdn for text animation -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/textillate/0.4.0/jquery.textillate.min.js" integrity="sha512-0bHMhYsdpiur1bT84kDH4D7cpxFQ9O7uA5yxVAqWC87h552Xt0swX4M+ZlXMKE8oPVRIJ5lAwXWO2UWeDwJJOw==" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lettering.js/0.6.1/jquery.lettering.min.js" ></script>
	
	<!-- sweet alert cdn -->
	<script src="js/sweet-alert/package/dist/sweetalert2.all.min.js"></script>

	<!-- submit and refresh functiona -->
	<script type="text/javascript" src="js/viewRequests.js"></script>

	<!-- extra checks -->
	<script type="text/javascript">
		$(document).ready(function(){
			$('.requests').addClass('active');
		});
		
	</script>
</body>
</html>