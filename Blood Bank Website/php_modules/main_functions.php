<?php

	// function to check whether loggedin or not
	function checkLogin(){
		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	// function to determine how the nav bar will look like if user is not loggedin
	function whenNotLoggedIn(){
		$tab2 = '<li class="nav-item dropdown">
	        				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Register</a>
	        				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
	          					<a class="dropdown-item" href="regReceiver.php">As Receiver</a>
	          					<a class="dropdown-item" href="regHospital.php">As Hospital</a>
	        				</div>
	      				</li>
	      				<li class="nav-item">
	        				<a class="nav-link" href="#" data-toggle="modal" data-target="#signinModalForm">Sign In</a>
	      				</li>';
	      				
	    return $tab2;
	}

	// function to determine the navbar if the user is loggedin as receiver
	function loggedInAsReceiver(){
		$tab2 = '<li class="nav-item"><a class="nav-link" href="php_modules/logout.php">Sign out</a></li>';

		return $tab2;
	}


	// function to determine if the user is loggedin as hospital
	function loggedInAsHospital(){
		$tab2 = '<li class="nav-item"><a class="nav-link info" href="addBloodInfo.php">Add Blood Info</a></li><li class="nav-item"><a class="nav-link requests" href="viewRequests.php">View Requests<sup><i class="fas " style="font-size: 10px; color: rgba(244,0,0,0.7);"></i></sup></a></li><li class="nav-item"><a class="nav-link" href="php_modules/logout.php">Sign out</a></li>';

		return $tab2;
	}

	// function to find the eligible blood groups
	function checkEligibility($blood_group){

		
		$sql = "";
		if($blood_group == "A+"){

			$sql = 'SELECT hid,hos_name,hos_phone_no,city,a_positive,a_negative,b_positive,b_negative,o_positive,o_negative,ab_positive,ab_negative,address_line,state FROM `hospital` WHERE a_positive>0 or a_negative>0 or o_positive>0 or o_negative>0';
			$_SESSION["options"] = '<option value="a_positive">A+</option><option value="a_negative">A-</option><option value="o_positive">O+</option><option value="o_negative">O-</option>';
			
			$bloodGroupsArray = array();
			array_push($bloodGroupsArray, "a_positive","a_negative","o_positive","o_negative");
			$_SESSION["bloodEligibility"] = $bloodGroupsArray;

		}
		elseif($blood_group == "A-"){
			$sql = 'SELECT hid,hos_name,hos_phone_no,city,a_positive,a_negative,b_positive,b_negative,o_positive,o_negative,ab_positive,ab_negative,address_line,state FROM `hospital` WHERE  a_negative>0 or o_negative>0';
			$_SESSION["options"] = '<option value="a_negative">A-</option><option value="o_negative">O-</option>';
			$bloodGroupsArray = array();
			array_push($bloodGroupsArray, "a_negative","o_negative");
			$_SESSION["bloodEligibility"] = $bloodGroupsArray;
		}
		elseif($blood_group == "B+"){
			$sql = 'SELECT hid,hos_name,hos_phone_no,city,a_positive,a_negative,b_positive,b_negative,o_positive,o_negative,ab_positive,ab_negative,address_line,state FROM `hospital` WHERE  b_positive>0 or b_negative>0 or o_positive>0 or o_negative>0';
			$_SESSION["options"] = '<option value="b_positive">B+</option><option value="b_negative">B-</option><option value="o_positive">O+</option><option value="o_negative">O-</option>';
			$bloodGroupsArray = array();
			array_push($bloodGroupsArray, "b_positive","b_negative","o_positive","o_negative");
			$_SESSION["bloodEligibility"] = $bloodGroupsArray;
		}
		elseif($blood_group == "B-"){
			$sql = 'SELECT hid,hos_name,hos_phone_no,city,a_positive,a_negative,b_positive,b_negative,o_positive,o_negative,ab_positive,ab_negative,address_line,state FROM `hospital` WHERE  b_negative>0 or o_negative>0';
			$_SESSION["options"] = '<option value="b_negative">B-</option><option value="o_negative">O-</option>';
			$bloodGroupsArray = array();
			array_push($bloodGroupsArray, "b_negative","o_negative");
			$_SESSION["bloodEligibility"] = $bloodGroupsArray;
		}
		elseif($blood_group == "O+"){
			$sql = 'SELECT hid,hos_name,hos_phone_no,city,a_positive,a_negative,b_positive,b_negative,o_positive,o_negative,ab_positive,ab_negative,address_line,state FROM `hospital` WHERE  o_positive>0 or o_negative>0';
			$_SESSION["options"] = '<option value="o_positive">O+</option><option value="o_negative">O-</option>';
			$bloodGroupsArray = array();
			array_push($bloodGroupsArray, "o_positive","o_negative");
			$_SESSION["bloodEligibility"] = $bloodGroupsArray;
		}
		elseif($blood_group == "O-"){
			$sql = 'SELECT hid,hos_name,hos_phone_no,city,a_positive,a_negative,b_positive,b_negative,o_positive,o_negative,ab_positive,ab_negative,address_line,state FROM `hospital` WHERE  o_negative>0';
			$_SESSION["options"] = '<option value="o_negative">O-</option>';
			$bloodGroupsArray = array();
			array_push($bloodGroupsArray, "o_negative");
			$_SESSION["bloodEligibility"] = $bloodGroupsArray;
		}
		elseif($blood_group == "AB-"){
			$sql = 'SELECT hid,hos_name,hos_phone_no,city,a_positive,a_negative,b_positive,b_negative,o_positive,o_negative,ab_positive,ab_negative,address_line,state FROM `hospital` WHERE  ab_negative>0 or a_negative>0 or b_negative>0 or o_negative>0';
			$_SESSION["options"] = '<option value="ab_negative">AB-</option><option value="a_negative">A-</option><option value="b_negative">B-</option><option value="o_negative">O-</option>';
			$bloodGroupsArray = array();
			array_push($bloodGroupsArray, "ab_negative","a_negative","b_negative","o_negative");
			$_SESSION["bloodEligibility"] = $bloodGroupsArray;
		}
		else{
			$sql = 'SELECT hid,hos_name,hos_phone_no,city,a_positive,a_negative,b_positive,b_negative,o_positive,o_negative,ab_positive,ab_negative,address_line,state FROM `hospital` WHERE a_positive>0 or a_negative>0 or b_positive>0 or b_negative>0 or o_positive>0 or o_negative>0 or ab_positive>0 or ab_negative>0';
			$_SESSION["options"] = '<option value="a_positive">A+</option><option value="a_negative">A-</option><option value="b_positive">B+</option><option value="b_negative">B-</option><option value="o_positive">O+</option><option value="o_negative">O-</option><option value="ab_positive">AB+</option><option value="ab_negative">AB-</option>';
			$bloodGroupsArray = array();
			array_push($bloodGroupsArray, "a_positive","a_negative","b_positive","b_negative","o_positive","o_negative","ab_positive","ab_negative");
			$_SESSION["bloodEligibility"] = $bloodGroupsArray;
		}
		
		return $sql;
	}

	// function to show the blood type in a specified format

	function convertBloodType($blood){
		if($blood == "a_positive"){
			$blood = "A+";
		}
		else if($blood == "a_negative"){
			$blood = "A-";
		}
		else if($blood == "b_positive"){
			$blood = "B+";
		}
		else if($blood == "b_negative"){
			$blood = "B-";
		}
		else if($blood == "o_positive"){
			$blood = "O+";
		}
		else if($blood == "o_negative"){
			$blood = "O-";
		}
		else if($blood == "ab_positive"){
			$blood = "AB+";
		}
		else{
			$blood = "AB-";
		}
		return $blood;
	}

	// function to check if there is any pending requests for hospital or not
	function checkRequests(){
		include 'config.php';
		$id = (int)$_SESSION["id"];
		$sql = 'SELECT rid from requests where hid ='.$id.' and status=0';
		$result = mysqli_query($con,$sql);
		if(mysqli_num_rows($result)>0){
			$_SESSION["hasRequests"] = true;
		}
	}
?>