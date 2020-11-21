<?php
session_start();
require_once 'php_modules/main_functions.php';
require_once 'php_modules/config.php';

	

	$id = $_GET["id"];
	// $id = 34;
	$sql = "SELECT hos_name, hos_phone_no, address_line, state,a_positive, a_negative, b_positive, b_negative, o_positive, o_negative, ab_positive, ab_negative FROM hospital WHERE hid = ?";
	
	if($stmt = mysqli_prepare($con,$sql))
	{
		//Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt,"s",$param_id);

		//set parameter
		$param_id = $id;
		if (mysqli_stmt_execute($stmt)) {
			
			//store result
			mysqli_stmt_store_result($stmt);

			mysqli_stmt_bind_result($stmt,$hos_name,$hos_phone,$address,$state,$a_pos,$a_neg,$b_pos,$b_neg,$o_pos,$o_neg,$ab_pos,$ab_neg);

			
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
	<link rel="stylesheet" type="text/css" href="css/req.css">
	<!-- bootstrap, fontawesome and jquery CDNs -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
	 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Amaranth&display=swap" rel="stylesheet">
	<!-- animate.css cdn -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" />
		<!-- Tipso tooltip css -->
	<link rel="stylesheet" href="js/tipso/src/tipso.css">
</head>
<body>

	<header>
		<div class="container">
			<nav class="navbar fixed-top navbar-expand-sm navbar-light " style="background-color: #fff !important; box-shadow: 2px 2px 3px #aaa;">
  				<a class="navbar-brand" href="index.php"><span class="heading">Blood<img src="images/blood.png" class="heading-img">Bank</span></a>
  				<button class="navbar-toggler toggle-btn" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    				<span class="navbar-toggler-icon"></span>
  				</button>
  			</nav>
  		</div>
  	</header>

  	<div class="container-fluid main-container pb-4">
		<div class="row ">
			<div class="col-md-6 pt-3" style="background-color: #DFF2FF;">
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
				
			</div>
			<div class="col-md-6 bg-change-input pt-3" >
				<center><span class="add-info-heading"><?php echo $hos_name?><br><small style="font-size: 0.6em; padding-top: 3px;"><?php echo "Phone No : ".$hos_phone ; ?></small><br><small style="font-size: 0.6em;"><?php echo $address.', '.$state ; ?></small></span></center>
				<form >
					<div class="md-form mb-4">
					    <input type="text" id="Form-name" class="form-control validate" placeholder="Patient's Name" value="" required>
					    <label data-error="wrong" data-success="right" for="Form-name">Patient's Name</label>
					    <div class="errorName"></div>
				    </div>
				    <div class="md-form mb-4">
					    <input type="email" id="Form-email" class="form-control validate" placeholder="Patient's Email Id / Your Email Id" value="" required>
					    <label data-error="wrong" data-success="right" for="Form-email">Patient's Email Id</label> <i class="fas fa-info-circle" id="infoTooltip" data-toggle="tooltip" data-placement="top" title="An email will be sent on acceptance of your request"></i>
					    <div class="errorEmail"></div>
				    </div>

				    <div class="md-form mb-4">
					    <select id="Form-select3" class="form-control validate" required>
						    <option value="" selected>--Choose Blood Group--</option>
					    	<option value="a_positive">A+</option>
					    	<option value="a_negative">A-</option>
					    	<option value="b_positive">B+</option>
					    	<option value="b_negative">B-</option>
					    	<option value="o_positive">O+</option>
					    	<option value="o_negative">O-</option>
					    	<option value="ab_positive">AB+</option>
					    	<option value="ab_negative">AB-</option>
					    </select>
					    <label data-error="wrong" data-success="right" for="Form-select3">Patient's Blood Group</label>
					    <div class="errorBlood"></div>
				    </div>

				   <div class="md-form pb-3">
					    <input type="number" id="Form-num" class="form-control validate" min="1" value="1" required>
					    <label data-error="wrong" data-success="right" for="Form-num">Number of samples</label>
				        <div class="errorNumber"></div>
				    </div>
				      <input type="hidden" id="hosid" value="<?php echo $id;?>">
				    <div class="text-center mb-3">
				    	<button type="button" class="btn btn-block btn-rounded blue-bg z-depth-1a request">Request <i class="fa "></i></button>
				    </div>
				    
				</form>
			</div>
		</div>
	</div>
	



	<script type="text/javascript" src="js/main.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<!-- texillate.js cdn for text animation -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/textillate/0.4.0/jquery.textillate.min.js" integrity="sha512-0bHMhYsdpiur1bT84kDH4D7cpxFQ9O7uA5yxVAqWC87h552Xt0swX4M+ZlXMKE8oPVRIJ5lAwXWO2UWeDwJJOw==" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lettering.js/0.6.1/jquery.lettering.min.js" integrity="sha512-VJ/iYbiu1eJ6yLimfTi65t2R9TFcG5D9X8ZCfbbEFhTfPnKJh8byoKXEawi5ScJZBYL1eiirL1+MczZDx0Tz9Q==" crossorigin="anonymous"></script>
	
	<!-- sweet alert cdn -->
	<script src="js/sweet-alert/package/dist/sweetalert2.all.min.js"></script>

	<script type="text/javascript" src="js/req.js"></script>

  </body>
</html>


