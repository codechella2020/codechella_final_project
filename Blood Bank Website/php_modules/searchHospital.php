<?php
require_once 'config.php';
	$out = "";
	if(isset($_POST["text"])){
		$name = filter_var(trim($_POST["text"]),FILTER_SANITIZE_STRING);

		// find the hospital from the ajax call made using jquery
		$sql = "SELECT hid,hos_name,city FROM hospital WHERE hos_name like ?";

		if($stmt = mysqli_prepare($con,$sql)){
			mysqli_stmt_bind_param($stmt,"s",$param_name);
			$param_name = "%{$name}%";

			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_store_result($stmt);
				
				if(mysqli_stmt_num_rows($stmt)>0){
					mysqli_stmt_bind_result($stmt,$id,$hos_name,$city);

					while(mysqli_stmt_fetch($stmt)){
						$out .= '<li class="list-group-item">'.$hos_name.'<br><small>City - '.$city.'</small> <span style="visibility:hidden;">hid'.$id.'</span></li>';
					}
				}
				else{
					$out .= '<li class="list-group-item disabled">Hospital Not Found!</li>';
				}
				echo $out;
			}

		}

	}

?>