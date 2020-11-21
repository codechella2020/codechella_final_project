<?php
session_start();

require_once 'php_modules/main_functions.php';
require_once 'php_modules/config.php';

	// check login status
	$login = checkLogin();	
	$output = '';
	$requestCheck = "";
	if(!$login){
		
		//navigation bar when not logged in
		$output = whenNotLoggedIn();
	}
	else{
		if($_SESSION["type"]=="receiver"){

			//navigation bar when logged in as receiver
			$output = loggedInAsReceiver();
		}else{
			//navigation bar when not logged in as hospital
			$output = loggedInAsHospital();

			// notification if hospital has some pending request
			checkRequests();
			if(isset($_SESSION["hasRequests"]) && $_SESSION["hasRequests"]==true && !isset($_SESSION["dontShowRequest"])){
				$requestCheck = 'hasReq';
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
	<!-- bootstrap, fontawesome and jquery CDNs -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Amaranth&display=swap" rel="stylesheet">
	<!-- animate.css cdn -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" />
	<!-- Tipso tooltip css -->
	<link rel="stylesheet" href="js/tipso/src/tipso.css">
</head>
<body class='<?php echo $requestCheck;?>'>

	<!-- ---------------------- -->
	<!-- Navigation bar portion -->
    <!-- ---------------------- -->

	<header>
		<div class="container">
			<nav class="navbar fixed-top navbar-expand-sm navbar-light ">
  				<a class="navbar-brand" href="#" ><span class="heading">Blood<img src="images/blood.png" class="heading-img">Bank</span></a>
  				<button class="navbar-toggler toggle-btn" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    				<span class="navbar-toggler-icon"></span>
  				</button>

	  			<div class="collapse navbar-collapse front" id="navbarSupportedContent">
	    			<ul class="navbar-nav ml-lg-auto">
	      				<li class="nav-item active home">
	        				<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
	      				</li>
	      				<li class="nav-item">
	        				<a class="nav-link" href="availability.php">Check Availability</a>
	      				</li>
	      				<li class="nav-item">
	        				<a class="nav-link" href="#about">About Us</a>
	      				</li>
	      				
	      				<?php echo $output;?>
	    			</ul>
	    			
	 			</div>
			</nav>
		</div>
	</header>
								<!-- ------- -->
								<!-- Tagline -->
								<!-- ------- -->

	<section>
		
		<div class="banner" >
                  <?php include 'php_modules/background.php';?>  
        </div>
		<div class="tagline">
			<center>
				<span class="tagline-main">The gift of blood is the gift of life</span><br>
			</center>
		</div>
	</section>
	<div>
   <?php include 'images/twitterBird.php';?> 
</div>
<div id="about"></div>

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
				    	<div class="errorButton"></div>
				    </div>
				       
				       
			    </div>
		    </form>
		    
		</div>
		  
	  </div>
	</div>
							<!-- ------------ -->
							<!-- Body Content -->
							<!-- ------------ -->
	
	<div class="container" style="margin-top: 30px;">
		<center><span class="sub-heading">About Us</span></center>
		<div class="row first-row" >

			<div class="col-md-4 justify-content-center align-self-center ">
				<img src="images/aboutUs.jpg" class="about-us-img">
			</div>	
			<div class="col-md-8 justify-content-center align-self-center sub-topic">
				Blood Bank is aimed at promoting the awareness of blood donation among the public. It is committed to stay ahead of all linguistic-rational-religious-political differences and shall be fully focusing its objectives in health care activities, with technology support from WebCastle Media Pvt. Ltd., Cochin.

				Blood Bank Society is registered as per The TCLSCS Registration Act XII of 1956 under the Government of West Bengal. 

				Blood donation refers to a practice where people donate their blood to people so it helps them with their health problems. Blood is one of the most essential fluids of our body that helps in the smooth functioning of our body. If the body loses blood in excessive amounts, people to get deadly diseases and even die. Thus, we see how blood donation is literally life-saving which helps people. It is also a sign of humanity that unites people irrespective of caste, creed, religion and more.
			</div>
		</div>
	</div>
	<div class="bg-change">
		<div class="container" style="margin-top: 30px;">
			
			<center><span class="sub-heading">Why Donate Blood?</span></center>
			<div class="row first-row" id="donate">
					
				<div class="col-md-4 justify-content-center align-self-center ">
						<img src="images/donate.jpg" class="about-us-img">
				</div>	
				<div class="col-md-8 justify-content-center align-self-center sub-topic">
					Our nation requires 4 Crore Units of Blood while only 40 lakh units are available. Every two seconds, someone needs Blood. There is no substitue for human blood as it cannot be manufactured.
					Blood donation is an extremely noble deed, yet there is a scarcity of regular donors across India.
					From one unit of blood, red blood cells can be extracted for use in trauma or surgical patients. Plasma, the liquid part of blood, is administered to patients with clotting problems. The third component of blood, platelets, clot the blood when cuts or other open wounds occur, and are often used in cancer and transplant patients. Cryoprecipitated anti-hemophilic factor (AHF) is also used for clotting factors.
				</div>
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
	<!-- texillate.js cdn for text animation -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/textillate/0.4.0/jquery.textillate.min.js" integrity="sha512-0bHMhYsdpiur1bT84kDH4D7cpxFQ9O7uA5yxVAqWC87h552Xt0swX4M+ZlXMKE8oPVRIJ5lAwXWO2UWeDwJJOw==" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lettering.js/0.6.1/jquery.lettering.min.js" integrity="sha512-VJ/iYbiu1eJ6yLimfTi65t2R9TFcG5D9X8ZCfbbEFhTfPnKJh8byoKXEawi5ScJZBYL1eiirL1+MczZDx0Tz9Q==" crossorigin="anonymous"></script>
	<!-- animation -->
	<script type="text/javascript" src="js/animation.js"></script>

	<!-- login using ajax -->
	<script type="text/javascript" src="js/login.js"></script>

	<!-- Tipso Tooltip -->
	<script src="js/tipso/src/tipso.min.js"></script>


	<!-- extra checks -->
	<script type="text/javascript">
		$(document).ready(function(){
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

<!-- background picture courtesy -> <a href='https://www.freepik.com/vectors/infographic'>Infographic vector created by pch.vector - www.freepik.com</a> 
Icons made by <a href="https://www.flaticon.com/authors/srip" title="srip">srip</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a>-->