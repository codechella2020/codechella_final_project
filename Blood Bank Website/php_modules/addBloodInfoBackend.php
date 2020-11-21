<?php


include_once 'config.php';
session_start();

var_dump($_POST);
	if($_SERVER["REQUEST_METHOD"] == "POST"){
echo "hi";
		$apos = (int)$_POST["apos"];
		$aneg = (int)$_POST["aneg"];
		$bpos =(int) $_POST["bpos"];
		$bneg = (int)$_POST["bneg"];
		$opos = (int)$_POST["opos"];
		$oneg =(int) $_POST["oneg"];
		$abpos =(int) $_POST["abpos"];
		$abneg =(int) $_POST["abneg"];
		$id = $_SESSION["id"];
		
		
		$sql="UPDATE `hospital` SET `a_positive`=`a_positive`+?,`a_negative`=`a_negative`+?,`b_positive`=`b_positive`+?,`b_negative`=`b_negative`+?,`o_positive`=`o_positive`+?,`o_negative`=`o_negative`+?,`ab_positive`=`ab_positive`+?,`ab_negative`=`ab_negative`+? WHERE `hid` = ?";
		
		if($stmt = mysqli_prepare($con, $sql)){
			mysqli_stmt_bind_param($stmt, "iiiiiiiii",$apos, $aneg, $bpos, $bneg, $opos, $oneg, $abpos, $abneg, $id);
			if(mysqli_stmt_execute($stmt)){
				echo "successful";
			}else{
				echo "error";
			}
		}
		

}
?>

