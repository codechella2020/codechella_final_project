<?php
session_start();
require_once 'php_modules/main_functions.php';
require_once 'php_modules/config.php';
	// check login status
	$login = checkLogin();
	$requestCheck = "";
	$output = '';
	if(!$login){
		
		// navigation bar when not logged in
		$output = whenNotLoggedIn();
	}
	else{
		
		if($_SESSION["type"]=="receiver"){
			// navigation bar when logged in as receiver
			$output = loggedInAsReceiver();
		}else{
			// navigation bar when logged in as hospital
			$output = loggedInAsHospital();
			checkRequests();
			if(isset($_SESSION["hasRequests"]) && $_SESSION["hasRequests"]==true && !isset($_SESSION["dontShowRequest"])){
				$requestCheck = 'hasReq';
			}
		}
	}
	$content = "";
	if($login){
		if($_SESSION["type"]=="receiver"){
			$blood_group = $_SESSION["blood"];

			// check whic blood group data to be shown to the receiver
			$sql = checkEligibility($blood_group);
			
			$content = "";
			if($stmt = mysqli_prepare($con,$sql)){

				if(mysqli_stmt_execute($stmt)){
					mysqli_stmt_store_result($stmt);

					//store the output data in a variable

					if(mysqli_stmt_num_rows($stmt)>0){
						$content = '<span class="sorting">The blood samples are sorted according to your eligibility. To check other samples, apply filters!</span><br>';
						mysqli_stmt_bind_result($stmt,$id,$hos_name,$hos_phone_no,$city,$apos,$aneg,$bpos,$bneg,$opos,$oneg,$abpos,$abneg,$address,$state);
						while(mysqli_stmt_fetch($stmt)){
							$content .= '<div class="col-md-6 mt-2">
							<div class="container main-content">
								<div class="row">
									<div class="col">
										<center>
											<span class="hospital-heading">'.$hos_name.'</span>
											<br>
											<small class="address">'.$address.', '.$city.', '.$state.'</small>
											<br>
											<small class="phoneno">Phone No: '.$hos_phone_no.'</small>
											<span class="hosid" style="visibility: hidden;">'.$id.'</span>
										</center>
									</div>
								</div>
								<div class="row justify-content-center">
									<div class="col-xs-3 mx-2">
										<img src="images/blood-icons/apos.svg" class="blood-icon">
										<h4 class="apos">&nbsp;&nbsp;'.$apos.'</h4>
									</div>
									<div class="col-xs-3 mx-2">
										<img src="images/blood-icons/aneg.svg" class="blood-icon">
										<h4  class="aneg">&nbsp;&nbsp;'.$aneg.'</h4>
									</div>
									<div class="col-xs-3 mx-2">
										<img src="images/blood-icons/bpos.svg" class="blood-icon">
										<h4 class="bpos">&nbsp;&nbsp;'.$bpos.'</h4>
									</div>
									<div class="col-xs-3 mx-2">
										<img src="images/blood-icons/bneg.svg" class="blood-icon">
										<h4 class="bneg">&nbsp;&nbsp;'.$bneg.'</h4>
									</div>
								</div>
								<div class="row justify-content-center mt-2">
									<div class="col-xs-3 mx-2">
										<img src="images/blood-icons/opos.svg" class="blood-icon">
										<h4 class="opos">&nbsp;&nbsp;'.$opos.'</h4>
									</div>
									<div class="col-xs-3 mx-2">
										<img src="images/blood-icons/oneg.svg" class="blood-icon">
										<h4 class="oneg">&nbsp;&nbsp;'.$oneg.'</h4>
									</div>
									<div class="col-xs-3 mx-2">
										<img src="images/blood-icons/abpos.svg" class="blood-icon">
										<h4 class="abpos">&nbsp;&nbsp;'.$abpos.'</h4>
									</div>
									<div class="col-xs-3 mx-2">
										<img src="images/blood-icons/abneg.svg" class="blood-icon">
										<h4 class="abneg">&nbsp;&nbsp;'.$abneg.'</h4>
									</div>
								</div>
								<div class="row justify-content-center mt-2">
								<div class="col-md-6 mt-1">
												<button class="btn btn-block btn-primary myself" type="button" data-toggle="modal" data-target="#requestMyselfModalForm">Request for myself<input type="hidden" value="'.$id.'"></button>
											</div>
											<div class="col-md-6 mt-1">
												<button class="btn btn-block btn-primary other" type="button" data-toggle="modal" data-target="#requestOtherModalForm">Request for other<input type="hidden" value="'.$id.'"></button>
											</div>
										</div>
									</div>
								</div>';
						}
					}
					else{
						// if there is no data to show 

						$content .= '<div class="col-md-12 mt-2">
							<div class="container main-content"><div class="row justify-content-center">
									<div class="col-xs-12 mx-2">
										<img src="https://img.icons8.com/fluent/96/000000/nothing-found.png"/>
										<h4 class="nodata">No Data Found!! </h4>
									</div></div></div>';
					}
				}
			}
		}
		else{

			// show all the data when the user is loggedin as hospital


			$sql = 'SELECT hid,hos_name,hos_phone_no,city,a_positive,a_negative,b_positive,b_negative,o_positive,o_negative,ab_positive,ab_negative,address_line,state FROM hospital';
		
		if($stmt = mysqli_prepare($con,$sql)){

			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_store_result($stmt);

				if(mysqli_stmt_num_rows($stmt)>0){
					mysqli_stmt_bind_result($stmt,$id,$hos_name,$hos_phone_no,$city,$apos,$aneg,$bpos,$bneg,$opos,$oneg,$abpos,$abneg,$address,$state);
					while(mysqli_stmt_fetch($stmt)){
								$content .= '<div class="col-md-6 mt-2">
						<div class="container main-content">
							<div class="row">
								<div class="col">
									<center>
										<span class="hospital-heading">'.$hos_name.'</span>
										<br>
										<small class="address">'.$address.', '.$city.', '.$state.'</small>
										<br>
										<small class="phoneno">Phone No: '.$hos_phone_no.'</small>
										<span class="hosid" style="visibility: hidden;">'.$id.'</span>
									</center>
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/apos.svg" class="blood-icon">
									<h4 class="apos">&nbsp;&nbsp;'.$apos.'</h4>
								</div>
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/aneg.svg" class="blood-icon">
									<h4 class="aneg">&nbsp;&nbsp;'.$aneg.'</h4>
								</div>
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/bpos.svg" class="blood-icon">
									<h4 class="bpos">&nbsp;&nbsp;'.$bpos.'</h4>
								</div>
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/bneg.svg" class="blood-icon">
									<h4 class="bneg">&nbsp;&nbsp;'.$bneg.'</h4>
								</div>
							</div>
							<div class="row justify-content-center mt-2">
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/opos.svg" class="blood-icon">
									<h4 class="opos">&nbsp;&nbsp;'.$opos.'</h4>
								</div>
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/oneg.svg" class="blood-icon">
									<h4 class="oneg">&nbsp;&nbsp;'.$oneg.'</h4>
								</div>
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/abpos.svg" class="blood-icon">
									<h4 class="abpos">&nbsp;&nbsp;'.$abpos.'</h4>
								</div>
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/abneg.svg" class="blood-icon">
									<h4 class="abneg">&nbsp;&nbsp;'.$abneg.'</h4>
								</div>
							</div>
							<div class="row justify-content-center mt-2">
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

				}
				else{

					// if there is no data to show

					$content .= '<div class="col-md-12 mt-2">
						<div class="container main-content"><div class="row justify-content-center">
								<div class="col-xs-12 mx-2">
									<img src="https://img.icons8.com/fluent/96/000000/nothing-found.png"/>
									<h4 class="nodata">No Data Found!! </h4>
								</div></div></div>';
				}
				
			}

		}
		}
	}
	else{
		//show data accordingly when user is not logged in

		$sql = 'SELECT hid,hos_name,hos_phone_no,city,a_positive,a_negative,b_positive,b_negative,o_positive,o_negative,ab_positive,ab_negative,address_line,state FROM hospital';
		
		if($stmt = mysqli_prepare($con,$sql)){

			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_store_result($stmt);

				if(mysqli_stmt_num_rows($stmt)>0){
					mysqli_stmt_bind_result($stmt,$id,$hos_name,$hos_phone_no,$city,$apos,$aneg,$bpos,$bneg,$opos,$oneg,$abpos,$abneg,$address,$state);
					while(mysqli_stmt_fetch($stmt)){
								$content .= '<div class="col-md-6 mt-2">
						<div class="container main-content">
							<div class="row">
								<div class="col">
									<center>
										<span class="hospital-heading">'.$hos_name.'</span>
										<br>
										<small class="address">'.$address.', '.$city.', '.$state.'</small>
										<br>
										<small class="phoneno">Phone No: '.$hos_phone_no.'</small>
										<span class="hosid" style="visibility: hidden;">'.$id.'</span>
									</center>
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/apos.svg" class="blood-icon">
									<h4 class="apos">&nbsp;&nbsp;'.$apos.'</h4>
								</div>
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/aneg.svg" class="blood-icon">
									<h4 class="aneg">&nbsp;&nbsp;'.$aneg.'</h4>
								</div>
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/bpos.svg" class="blood-icon">
									<h4 class="bpos">&nbsp;&nbsp;'.$bpos.'</h4>
								</div>
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/bneg.svg" class="blood-icon">
									<h4 class="bneg">&nbsp;&nbsp;'.$bneg.'</h4>
								</div>
							</div>
							<div class="row justify-content-center mt-2">
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/opos.svg" class="blood-icon">
									<h4 class="opos">&nbsp;&nbsp;'.$opos.'</h4>
								</div>
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/oneg.svg" class="blood-icon">
									<h4 class="oneg">&nbsp;&nbsp;'.$oneg.'</h4>
								</div>
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/abpos.svg" class="blood-icon">
									<h4 class="abpos">&nbsp;&nbsp;'.$abpos.'</h4>
								</div>
								<div class="col-xs-3 mx-2">
									<img src="images/blood-icons/abneg.svg" class="blood-icon">
									<h4 class="abneg">&nbsp;&nbsp;'.$abneg.'</h4>
								</div>
							</div>
							<div class="row justify-content-center mt-2">
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
				else{
					// if there is no data to show

					$content .= '<div class="col-md-12 mt-2">
						<div class="container main-content"><div class="row justify-content-center">
								<div class="col-xs-12 mx-2">
									<img src="https://img.icons8.com/fluent/96/000000/nothing-found.png"/>
									<h4 class="nodata">No Data Found!! </h4>
								</div></div></div>';
				}
				
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
	<link rel="stylesheet" type="text/css" href="css/availability.css">
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
<body class="<?php echo $requestCheck; ?>">

	<header>
		<div class="container">
			<nav class="navbar fixed-top navbar-expand-sm navbar-light " style="background-color: #fff !important; box-shadow: 2px 2px 3px #aaa;">
  				<a class="navbar-brand" href="#"><span class="heading">Blood<img src="images/blood.png" class="heading-img">Bank</span></a>
  				<button class="navbar-toggler toggle-btn" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    				<span class="navbar-toggler-icon"></span>
  				</button>

	  			
	  			<div class="collapse navbar-collapse front" id="navbarSupportedContent">
	    			<ul class="navbar-nav ml-lg-auto">
	      				<li class="nav-item ">
	        				<a class="nav-link" href="index.php">Home </a>
	      				</li>
	      				<li class="nav-item">
	        				<a class="nav-link active" href="availability.php">Check Availability<span class="sr-only">(current)</span></a>
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
	<div>
   <?php include 'images/twitterBird.php';?> 
</div>
							<!-- ----------------- -->
							<!-- signin modal form -->
							<!-- ----------------- -->
									
	<div class="modal fade" id="signinModalForm" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	   
	    <div class="modal-content form-elegant">
	      
		    <div class="modal-header text-center">
			    <h3 class="modal-title w-100 dark-grey-text font-weight-bold my-3" id="myModalLabel"><strong>Sign in</strong></h3>
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        <span aria-hidden="true">&times;</span>
			    </button>
		    </div>
	      	<form method="post" action="" autocomplete="off" accept-charset="utf-8">
			    <div class="modal-body mx-4">

			        
				    <div class="md-form mb-4">
					    <input type="email" id="Form-email1" class="form-control validate" placeholder="abc@email.com" value="" required>
					    <label data-error="wrong" data-success="right" for="Form-email1">Your email</label>
					    <div class="errorMail"></div>
				    </div>

				    <div class="md-form mb-4">
					    <select id="Form-select1" class="form-control validate" required>
						    <option name="" value="">--Select Option--</option>
						    <option name="hos" value="hospital">Hospital</option>
						    <option name="rec" value="receiver">Receiver</option>
					    </select>
					    <label data-error="wrong" data-success="right" for="Form-select1">Who you are?</label>
					    <div class="errorType"></div>
				    </div>

				    <div class="md-form pb-3">
					    <input type="password" id="Form-pass1" class="form-control validate" placeholder="**********" value="" required>
					    <label data-error="wrong" data-success="right" for="Form-pass1">Your password</label>
				        <div class="errorPass"></div>
				    </div>

				    <div class="text-center mb-3">
				    	<button type="button" class="btn btn-block btn-rounded blue-bg z-depth-1a signin">Sign in <i class="fa "></i></button>
				    </div>
				       
				       
			    </div>
		    </form>
		    
		</div>
		  
	  </div>
	</div>
   
				    <!-- ------------------------------------------ -->
					<!-- request blood sample for myself modal form -->
					<!-- ------------------------------------------ -->


		
	<div class="modal fade" id="requestMyselfModalForm" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	   
	    <div class="modal-content form-elegant">
	      
		    <div class="modal-header text-center">
			    <h3 class="modal-title w-100 dark-grey-text font-weight-bold my-3" id="myModalLabel"><strong>Request Blood Sample For Myself</strong></h3>
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        <span aria-hidden="true">&times;</span>
			    </button>
		    </div>
	      	<form method="post" action="" autocomplete="off" accept-charset="utf-8">
			    <div class="modal-body mx-4">


				    <div class="md-form mb-4">
					    <select id="bloodType" class="form-control validate" required>
						    <?php echo $_SESSION["options"];?>
					    </select>
					    <label data-error="wrong" data-success="right" for="bloodType">Blood Group You Need</label>
					    <div class="errorBloodType"></div>
				    </div>

				    <div class="md-form pb-3">
					    <input type="number" id="amount1" class="form-control validate" min="1" value="1" required>
					    <label data-error="wrong" data-success="right" for="amount1">Number of samples</label>
				        <div class="errorNumSum"></div>
				    </div>
				    <input type="hidden" id="receiverId" value="<?php echo $_SESSION['id'];?>">
					<input type="hidden" id="receiverName" value="<?php echo $_SESSION['name'];?>">
					<input type="hidden" id="receiverEmail" value="<?php echo $_SESSION['email'];?>">
				    <div class="text-center mb-3">
				    	<button type="button" class="btn btn-block btn-rounded blue-bg z-depth-1a reqMyself">Request <i class="fa "></i></button>
				    </div>
				       
				       
			    </div>
		    </form>
		    
		</div>
		  
	  </div>
	</div>

						<!-- ------------------------------- -->
						<!-- request blood sample for others -->
						<!-- ------------------------------- -->
		
	<div class="modal fade" id="requestOtherModalForm" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	   
	    <div class="modal-content form-elegant">
	      
		    <div class="modal-header text-center">
			    <h3 class="modal-title w-100 dark-grey-text font-weight-bold my-3" id="myModalLabel"><strong>Request Sample For Others</strong></h3>
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        <span aria-hidden="true">&times;</span>
			    </button>
		    </div>
	      	<form method="post" action="" autocomplete="off" accept-charset="utf-8">
			    <div class="modal-body mx-4">

			        
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
				      <input type="hidden" id="receiverIdOth" value="<?php echo $_SESSION['id'];?>">
				    <div class="text-center mb-3">
				    	<button type="button" class="btn btn-block btn-rounded blue-bg z-depth-1a reqOther">Request <i class="fa "></i></button>
				    </div>
				       
				       
			    </div>
		    </form>
		    
		</div>
		  
	  </div>
	</div>

	<div class="container-fluid" style="margin-top: 100px;">
		<form>
			<div class="form-row">
				
				<div class="form-group col-md-4">
					<input class="form-control search-hos" type="text" value="" id="inputHospital" placeholder="Search by hospital name.." autocomplete="off">
					<input type="hidden" id="hospitalId" value="">
					<div class="list-search">

					<ul class="list-group search-li" id="searchList" ></ul>
				</div>
				</div>
				<div class="form-group col-md-2">
					<select id="inputBlood" class="form-control" >
					    	<option value="" selected>Choose Blood Group..</option>
					    	<option value="a_positive">A+</option>
					    	<option value="a_negative">A-</option>
					    	<option value="b_positive">B+</option>
					    	<option value="b_negative">B-</option>
					    	<option value="o_positive">O+</option>
					    	<option value="o_negative">O-</option>
					    	<option value="ab_positive">AB+</option>
					    	<option value="ab_negative">AB-</option>
					</select>
				</div>
				<div class="form-group col-md-2">
					<button class="btn btn-block btn-outline-primary search" type="button">Search</button>
				</div>
				<div class="form-group col-md-2">
					<button class="btn btn-block btn-primary show-all" type="button">Show All</button>
				</div>
				<div class="col-md-2">
					<button class="btn btn-block btn-secondary disabled clear" type="button">Clear Filters &times;</button>
				</div>
			</div>
		</form>

	</div>	
							
								<!-- ------------------ -->
								<!-- div for pre-loader -->
								<!-- ------------------ -->

	<div class="container-fluid" >

		<div class="row">
			<div class="col-md-12">
				<center>
					<span class="pre-loader" style="font-size: 40px; color: #31587A;">
						<i class="fa "></i>
					</span>
				</center>
			</div>
			
		</div>		
	</div>
	<div class="container ">
		<div class="row data-container">
			<?php echo $content; ?>
		</div>
	</div>

	<!-- popperJS, botstrap JS CDNs -->
	<script type="text/javascript" src="js/main.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<!-- sweet alert cdn -->
	<script src="js/sweet-alert/package/dist/sweetalert2.all.min.js"></script>

	<!-- request using ajax -->
	<script type="text/javascript" src="js/availabilityModal.js"></script>

	<!-- login using ajax -->
	<script type="text/javascript" src="js/login.js"></script>

		<!-- Tipso Tooltip -->
	<script src="js/tipso/src/tipso.min.js"></script>

	<!-- main js file for search -->
	<script type="text/javascript" src="js/availability.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			
			$('#infoTooltip').tooltip();
			if($('body').hasClass('hasReq')){
				
				$('.requests i').addClass('fa-circle');
			}
jQuery('#body').tipso({
				position: 'top',
				background: '#5DA8DC',
				useTitle: false,
				width: false,
				maxWidth: 500,
				size: 'medium',
				color: '#fff',
				tooltipHover: true,
				content: function(){
					return '<span style="font-family: Amaranth,sans-serif;">Post a tweet by mentioning <b>@BloodBankBot1</b><br>'+
							'and add required blood group name<br>'+
							'and your city, we will find a blood<br>'+
							'bank for you!</span>'

					;
				}
			});
		});
	</script>
	
</body>
</html>