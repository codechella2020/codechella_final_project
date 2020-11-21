<?php
require_once 'config.php';

 
// Define variables and initialize with empty values
$email = $password =  "";
$email_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email id.";
    } else{
        // Prepare a select statement
        $sql = "SELECT uid FROM receiver WHERE email = ?";
        
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                    echo $email_err;
                } else{
                    $email = filter_var(trim($_POST["email"]),FILTER_SANITIZE_EMAIL);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";    
        echo $password_err; 
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
        echo $password_err;
    } else{
        $password = filter_var(trim($_POST["password"]),FILTER_SANITIZE_STRING);
    }
    
    
    
    // Check input errors before inserting in database
    if(empty($email_err) && empty($password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO receiver (name, phone_no, email, password, address_line, blood_group) VALUES (?, ?, ?, ?, ?, ?)";
       
        $name = filter_var(trim($_POST["name"]),FILTER_SANITIZE_STRING);
        
        $address = filter_var(trim($_POST["address"]),FILTER_SANITIZE_STRING);
        $city = filter_var(trim($_POST["city"]),FILTER_SANITIZE_STRING);
        $state = filter_var(trim($_POST["state"]),FILTER_SANITIZE_STRING);
        $code = filter_var(trim($_POST["code"]),FILTER_SANITIZE_STRING);
        $phone = filter_var(trim($_POST["phone"]),FILTER_SANITIZE_STRING);
       	$blood = filter_var(trim($_POST["blood"]),FILTER_SANITIZE_STRING);
	
       	$address .= ", ".$city.", ".$state.", ".$code;

         
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_name, $param_phone,$param_email, $param_password,  $param_address,  $param_blood);
            
            // Set parameters
            $param_name = $name;
            $param_phone = $phone;
            $param_email = $email;
           
            $param_password = base64_encode($password);
            
            $param_address = $address;
            
            $param_blood = $blood;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                echo "successful";
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
}
    
    

?>