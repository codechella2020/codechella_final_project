<?php
require_once 'config.php';
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$uid = (int) $_POST["uid"];
		$hid = (int) $_POST["hid"];
		$name = filter_var(trim($_POST["name"]),FILTER_SANITIZE_STRING);
		$email = filter_var(trim($_POST["email"]),FILTER_SANITIZE_STRING);
		$blood = filter_var(trim($_POST["blood"]),FILTER_SANITIZE_STRING);
		$amount = (int) $_POST["amount"];

		// prepare a select statement to fetch the amount of blood type available in the hospital's blood bank
		$sql = 'SELECT '.$blood.' FROM hospital WHERE hid = ?';

		if($stmt = mysqli_prepare($con,$sql)){
			mysqli_stmt_bind_param($stmt, "i", $param_hid);
			$param_hid = $hid;
			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_store_result($stmt);
				if(mysqli_stmt_num_rows($stmt)>0){
					mysqli_stmt_bind_result($stmt,$fetchedValue);
					mysqli_stmt_fetch($stmt);
					
					// check if the value in the database is greater than the amount requested
					if($fetchedValue>=$amount){

						$sql1 = 'SELECT rid from requests WHERE uid = ? and hid = ? and email = ? and patient_name = ? and blood_group = ? and status = 0';
						
						if($stmt1 = mysqli_prepare($con,$sql1)){
							echo $fetchedValue;
							mysqli_stmt_bind_param($stmt1,"iisss",$uid,$hid,$email,$name,$blood);
							if(mysqli_stmt_execute($stmt1)){
								mysqli_stmt_store_result($stmt1);
								if(mysqli_stmt_num_rows($stmt1)>0){

									// if it is already requested
									echo "requested";
								}
								else{
									$sql2 = 'INSERT INTO requests(uid,hid,patient_name,email,blood_group,bottles) VALUES (?,?,?,?,?,?)';
									if($stmt2 = mysqli_prepare($con,$sql2)){
										mysqli_stmt_bind_param($stmt2, "iisssi", $uid, $hid,$name, $email, $blood, $amount);
										if(mysqli_stmt_execute($stmt2)){

											// requested successfully
											echo "successful";
										}
										else{
											echo mysqli_stmt_error( $stmt2 );
										}
									}
									else{
											echo "Error2";
									}
								}
							}
						}else{
						echo "Error3";
					}
						
					}
					else{
						echo "reject";
					}
				}
				else{
					echo "Error4";
				}
		
	}


}

}
?>