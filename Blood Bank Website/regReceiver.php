<?php
session_start();
require_once 'php_modules/main_functions.php';
	//check login
	$login = checkLogin();
	$output = '';
	if(!$login){
		// nav bar when not logged in
		$output = whenNotLoggedIn();
	}
	else{
		// if loggedin then headover to index page
		header("Location: index.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Blood Bank</title>
	<!-- css files -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/regHospital.css">
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
			
							<!-- -------------- -->
							<!-- navbar portion -->
							<!-- -------------- -->
	<header>
		<div class="container ">
			<nav class="navbar fixed-top navbar-expand-sm navbar-light">
  				<a class="navbar-brand" href="#"><span class="heading">Blood<img src="images/blood.png" class="heading-img">Bank</span></a>
  				<button class="navbar-toggler toggle-btn" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    				<span class="navbar-toggler-icon"></span>
  				</button>

	  			
	  			<div class="collapse navbar-collapse front" id="navbarSupportedContent">
	    			<ul class="navbar-nav ml-lg-auto">
	      				<li class="nav-item">
	        				<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
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
					    <label data-error="wrong" data-success="right" for="Form-email1">Who you are?</label>
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

	
	<div class="container form-container" >
		<div class="row">
			<div class="col-md-7">

				<!-- registration form background in svg forat -->
		
				<div class="banner bg-has" >
		        	<?php include 'php_modules/regReceiverBackground.php';?>
		        </div>
								

								<!-- ----------------- -->
								<!-- registration form -->
								<!-- ----------------- -->

			</div>
			<div class="col-md-5">
				<form> 
					<div class="form-group">
						<span class="regHos">Register As Receiver</span>
					</div>
					<div class="form-group">
					    <label for="inputName">Full Name</label>
					    <input type="text" class="form-control" id="inputName" placeholder="Full Name" required>
					    <div class="regErrorName"></div>
				  	</div>
				    <div class="form-row">
					    <div class="form-group col-md-6">
					      <label for="inputEmail">Email</label>
					      <input type="email" class="form-control" id="inputEmail" placeholder="Email" required>
					      <div class="regErrorMail"></div>
					    </div>
					    <div class="form-group col-md-6">
					      <label for="inputPassword">Password <small>(min 6 characters)</small></label>
					      <input type="password" class="form-control" id="inputPassword" placeholder="Password" required>
					      <div class="regErrorPass"></div>
					    </div>
				    </div>
				    <div class="form-group">
					    <label for="inputPhone">Phone Number<small> Enter 10 digit number</small></label>
					    <input type="tel" class="form-control" id="inputPhone" pattern="[0-9]{10}"  placeholder="Phone Number" required>
					    <div class="regErrorPhone"></div>
				  	</div>
					<div class="form-group">
					    <label for="inputAddress">Address</label>
					    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" required>
					    <div class="regErrorAddress"></div>
				  	</div>
				  	
				    <div class="form-row">
					    <div class="form-group col-md-5">
					      <label for="inputCity">City</label>
					      <input type="text" class="form-control" id="inputCity" placeholder="City" required>
					      <div class="regErrorCity"></div>
					    </div>
					    <div class="form-group col-md-4">
						    <label for="inputState">State</label>
						    <select id="inputState" class="form-control" required>
							    <option value="" selected>Choose...</option>
		                		<option value="Andhra Pradesh">Andhra Pradesh</option>
		                		<option value="Arunachal Pradesh">Arunachal Pradesh</option>
		                		<option value="Assam">Assam</option>
		                		<option value="Bihar">Bihar</option>
		                		<option value="Chhattisgarh">Chhattisgarh</option>
		                		<option value="Goa">Goa</option>
		                		<option value="Gujarat">Gujarat</option>
		                		<option value="Haryana">Haryana</option>
		                		<option value="Himachal Pradesh">Himachal Pradesh</option>
		                		<option value="Jammu and Kashmir">Jammu and Kashmir</option>
		                		<option value="Jharkhand">Jharkhand</option>
		                		<option value="Karnataka">Karnataka</option>
		                		<option value="Kerala">Kerala</option>
		                		<option value="Madhya Pradesh">Madhya Pradesh</option>
		                		<option value="Maharashtra">Maharashtra</option>
		                		<option value="Manipur">Manipur</option>
		                		<option value="Meghalaya">Meghalaya</option>
		                		<option value="Mizoram">Mizoram</option>
		                		<option value="Nagaland">Nagaland</option>
		                		<option value="Odisha">Odisha</option>
		                		<option value="Punjab">Punjab</option>
		                		<option value="Rajasthan">Rajasthan</option>
		                		<option value="Sikkim">Sikkim</option>
		                		<option value="Tamil Nadu">Tamil Nadu</option>
		                		<option value="Telangana">Telangana</option>
		                		<option value="Tripura">Tripura</option>
		                		<option value="Uttar Pradesh">Uttar Pradesh</option>
		                		<option value="Uttarakhand">Uttarakhand</option>
		                		<option value="West Bengal">West Bengal</option>
		                		<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
		                		<option value="Chandigarh">Chandigarh</option>
		                		<option value="Delhi">Delhi</option>
		                		<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
		                		<option value="Daman and Diu">Daman and Diu</option>
		                		<option value="Lakshadweep">Lakshadweep</option>
		                		<option value="Puducherry">Puducherry</option>
		                		
						    </select>
						    <div class="regErrorState"></div>
					    </div>
					   	<div class="form-group col-md-3">
					      <label for="inputCode">Postal Code</label>
					      <input type="text" class="form-control" id="inputCode" placeholder="Code" required>
					      <div class="regErrorCode"></div>
					    </div>
				    </div>
				  	<div class="form-group">
					    <label for="inputBlood">Blood Group</label>
					    <select id="inputBlood" class="form-control" required>
					    	<option value="" selected>--Choose Blood Group--</option>
					    	<option value="A+">A+</option>
					    	<option value="A-">A-</option>
					    	<option value="B+">B+</option>
					    	<option value="B-">B-</option>
					    	<option value="O+">O+</option>
					    	<option value="O-">O-</option>
					    	<option value="AB+">AB+</option>
					    	<option value="AB-">AB-</option>
					    </select>
					    <div class="regErrorBlood"></div>
				  	</div>
				   
				  	<button type="button" class="btn btn-block btn-primary reg-rec">Register <i class="fa "></i></button>
				  	<div class="someError"></div>
				</form>
			</div>
		</div>
	</div>


<footer class="text-center small tm-footer">
          <p class="mb-0">©2020 All Right Reserved | Developed with &#10084;&#65039; for CodeChella 2020</p>

    </footer>



	<!-- popperJS, botstrap JS CDNs -->
	<script type="text/javascript" src="js/main.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<!-- sweet alert cdn -->
	<script src="js/sweet-alert/package/dist/sweetalert2.all.min.js"></script>

	<!-- login using ajax -->
	<script type="text/javascript" src="js/login.js"></script>
	<!-- register receiver using ajax -->
	<script type="text/javascript" src="js/regReceiver.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.dropdown-toggle').addClass('active');
			$('#infoTooltip').tooltip();
		});
	</script>
</body>
</html>