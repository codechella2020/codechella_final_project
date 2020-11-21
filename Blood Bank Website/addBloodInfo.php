<?php
session_start();
require_once 'php_modules/main_functions.php';
require_once 'php_modules/config.php';

	$login = checkLogin();
	$output = '';
	$requestCheck = "";
	if($login && $_SESSION["type"]=="hospital"){
		
		$output = loggedInAsHospital();
		checkRequests();
		if(isset($_SESSION["hasRequests"]) && $_SESSION["hasRequests"]==true && !isset($_SESSION["dontShowRequest"])){
			$requestCheck = 'hasReq';
		}
	}
	else{
		header("Location: index.php");
	}
	$id = $_SESSION["id"];
	$sql = "SELECT a_positive, a_negative, b_positive, b_negative, o_positive, o_negative, ab_positive, ab_negative FROM hospital WHERE hid = ?";
	
	if($stmt = mysqli_prepare($con,$sql))
	{
		//Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt,"s",$param_id);

		//set parameter
		$param_id = $id;
		if (mysqli_stmt_execute($stmt)) {
			
			//store result
			mysqli_stmt_store_result($stmt);

			mysqli_stmt_bind_result($stmt,$a_pos,$a_neg,$b_pos,$b_neg,$o_pos,$o_neg,$ab_pos,$ab_neg);

			
			mysqli_stmt_fetch($stmt);
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
	<link rel="stylesheet" type="text/css" href="css/addBloodInfo.css">
	<!-- bootstrap, fontawesome and jquery CDNs -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
	<!--  <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Amaranth&display=swap" rel="stylesheet">
	<!-- animate.css cdn -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" />
</head>
<body class="<?php echo $requestCheck; ?>">

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
	    			<!-- <form class="form-inline my-2 my-lg-0">
	     				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
	      				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	    			</form> -->
	 			</div>
			</nav>
		</div>
	</header>
	

	<div class="container-fluid main-container pb-4">
		<div class="row ">
			<div class="col-md-6 pt-3" style="background-color: #DFF2EA;">
				<center><span class="available-heading">Available Blood Samples</span></center>

				<div class="row">
					<div class="col-md-6">
						<img src="images/ap.svg" class="blood-img">
						<span class="sample-value"><i class="fas fa-arrow-alt-circle-right" style="color:#E63946;"></i> <?php echo $a_pos; ?></span>
					</div>
					<div class="col-md-6">
						<img src="images/an.svg" class="blood-img">
						<span class="sample-value"><i class="fas fa-arrow-alt-circle-right" style="color:#E63946;"></i> <?php echo $a_neg; ?></span>
					</div>

				</div>
				<div class="row">
					<div class="col-md-6">
						<img src="images/bp.svg" class="blood-img">
						<span class="sample-value"><i class="fas fa-arrow-alt-circle-right" style="color:#E63946;"></i> <?php echo $b_pos; ?></span>
					</div>
					<div class="col-md-6">
						<img src="images/bn.svg" class="blood-img">
						<span class="sample-value"><i class="fas fa-arrow-alt-circle-right" style="color:#E63946;"></i> <?php echo $b_neg; ?></span>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<img src="images/op.svg" class="blood-img">
						<span class="sample-value"><i class="fas fa-arrow-alt-circle-right" style="color:#E63946;"></i> <?php echo $o_pos; ?></span>
					</div>
					<div class="col-md-6">
						<img src="images/on.svg" class="blood-img">
						<span class="sample-value"><i class="fas fa-arrow-alt-circle-right" style="color:#E63946;"></i> <?php echo $o_neg; ?></span>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<img src="images/abp.svg" class="blood-img">
						<span class="sample-value"><i class="fas fa-arrow-alt-circle-right" style="color:#E63946;"></i> <?php echo $ab_pos; ?></span>
					</div>
					<div class="col-md-6">
						<img src="images/abn.svg" class="blood-img">
						<span class="sample-value"><i class="fas fa-arrow-alt-circle-right" style="color:#E63946;"></i> <?php echo $ab_neg; ?></span>
					</div>
				</div>
				<div class="row px-1">
					<button type="button" class="btn btn-block btn-primary refresh-btn">Refresh <i class="fa "></i></button>
				</div>
			</div>
			<div class="col-md-6 bg-change-input pt-3">
				<center><span class="add-info-heading">Add Blood Info</span></center>
				<form method="POST">
					<div class="row">
						<div class="col-md-6">
							<img src="images/ap.svg" class="blood-img">
							<span class="sample-value"><i class="fas fa-arrow-alt-circle-left" style="color:#457B9D;"></i> <input type="number" value="0" min="0" class="apos"> <small>unit(s)</small></span>
						</div>
						<div class="col-md-6">
							<img src="images/an.svg" class="blood-img">
							<span class="sample-value"><i class="fas fa-arrow-alt-circle-left" style="color:#457B9D;"></i> <input type="number" value="0" min="0" class="aneg"> <small>unit(s)</small></span>
						</div>

					</div>
					<div class="row">
						<div class="col-md-6">
							<img src="images/bp.svg" class="blood-img">
							<span class="sample-value"><i class="fas fa-arrow-alt-circle-left" style="color:#457B9D;"></i> <input type="number" value="0" min="0" class="bpos"> <small>unit(s)</small></span>
						</div>
						<div class="col-md-6">
							<img src="images/bn.svg" class="blood-img">
							<span class="sample-value"><i class="fas fa-arrow-alt-circle-left" style="color:#457B9D;"></i> <input type="number" value="0" min="0" class="bneg"> <small>unit(s)</small></span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<img src="images/op.svg" class="blood-img">
							<span class="sample-value"><i class="fas fa-arrow-alt-circle-left" style="color:#457B9D;"></i> <input type="number" value="0" min="0" class="opos"> <small>unit(s)</small></span>
						</div>
						<div class="col-md-6">
							<img src="images/on.svg" class="blood-img">
							<span class="sample-value"><i class="fas fa-arrow-alt-circle-left" style="color:#457B9D;"></i> <input type="number" value="0" min="0" class="oneg"> <small>unit(s)</small></span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<img src="images/abp.svg" class="blood-img">
							<span class="sample-value"><i class="fas fa-arrow-alt-circle-left" style="color:#457B9D;"></i> <input type="number" value="0" min="0" class="abpos"> <small>unit(s)</small></span>
						</div>
						<div class="col-md-6">
							<img src="images/abn.svg" class="blood-img">
							<span class="sample-value"><i class="fas fa-arrow-alt-circle-left" style="color:#457B9D;"></i> <input type="number" value="0" min="0" class="abneg"> <small>unit(s)</small></span>
						</div>
					</div>
					<div class="row px-1">
						<button type="button" class="btn btn-block btn-primary submit-btn">Submit <i class="fa "></i></button>
						<div class="errorUpdate"></div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- popperJS, botstrap JS CDNs -->
	<script type="text/javascript" src="js/main.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<!-- texillate.js cdn for text animation -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/textillate/0.4.0/jquery.textillate.min.js" integrity="sha512-0bHMhYsdpiur1bT84kDH4D7cpxFQ9O7uA5yxVAqWC87h552Xt0swX4M+ZlXMKE8oPVRIJ5lAwXWO2UWeDwJJOw==" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lettering.js/0.6.1/jquery.lettering.min.js" integrity="sha512-VJ/iYbiu1eJ6yLimfTi65t2R9TFcG5D9X8ZCfbbEFhTfPnKJh8byoKXEawi5ScJZBYL1eiirL1+MczZDx0Tz9Q==" crossorigin="anonymous"></script>
	
	<!-- sweet alert cdn -->
	<script src="js/sweet-alert/package/dist/sweetalert2.all.min.js"></script>


	<!-- submit and refresh functionality -->
	<script type="text/javascript" src="js/addBloodInfo.js"></script>

	<!-- extra checks -->
	<script type="text/javascript">
		$(document).ready(function(){
			$('.info').addClass('active');
			if($('body').hasClass('hasReq')){
				
				$('.requests i').addClass('fa-circle');
			}
		});
	</script>
</body>
</html>
