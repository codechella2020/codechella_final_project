<?php
require_once 'config.php';

	$email = $password = "";
	$email_err = $password_err = "";

	//processing form data when form is submitted

	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		//check if email is empty
		if(empty(trim($_POST["email"])))
		{
			$email_err = "Please enter a valid email";
		}
		else
		{
			$email = trim($_POST["email"]);
			$email = filter_var($email,FILTER_SANITIZE_EMAIL);

		}

		//check if password is empty
		if(empty(trim($_POST["password"])))
		{
			$password_err = "Please enter a valid password";
		}
		else
		{
			$password = trim($_POST["password"]);
			$password = filter_var($password,FILTER_SANITIZE_EMAIL);
		}

		
		if(empty($email_err) && empty($password_err))
		{
			$sql = "SELECT hid, email, password, hos_name, hos_phone_no FROM hospital WHERE email = ?";

			if($stmt = mysqli_prepare($con,$sql))
			{
				//Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt,"s",$param_email);

				//set parameters
				$param_email = $email;

				//attempt to execute the prepared statement
				if (mysqli_stmt_execute($stmt)) {
					# code...
					//store result
					mysqli_stmt_store_result($stmt);

					//check if email exist, if yes the verify password.

					if(mysqli_stmt_num_rows($stmt) == 1)
					{
						//bind result variables
						mysqli_stmt_bind_result($stmt,$hid,$email,$passwd,$name,$phone);
						if (mysqli_stmt_fetch($stmt)) {
							$passwd = base64_decode($passwd);
							if($password == $passwd )
							{
								session_start();
								$_SESSION["loggedin"] = true;
								$_SESSION["type"] = "hospital";
								$_SESSION["id"] = $hid;
								$_SESSION["email"] = $email;
								$_SESSION["name"] = $name;
								$_SESSION["phone"] = $phone;
								echo $_SESSION["type"];
								header("Refresh: 0");
							}
							
							else
							{
								$password_err = "The password you entered is incorrect";
							
								echo $password_err;
							}
						}
					}
					else
					{
						$email_err = "email not found";
						
						echo $email_err;
					}
				}
				else
				{
					echo "Oops! Something went wrong. Please try again later.";
				}
			}
			mysqli_stmt_close($stmt);
		}
	}
?>