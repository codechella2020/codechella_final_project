$(document).ready(function(){
	$('.signin').click(function(){
		if($('div').hasClass('alert')){
			
			$('div.alert').remove();
		}
		var type = $('#Form-select1').val();
		var email = $('#Form-email1').val();
		var pass = $('#Form-pass1').val();
		if(!validateEmail(email)){
			var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Please enter a valid email id.<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
			$('.errorMail').html(out);
		}
		else if(type!="" && email!="" && pass!=""){
			$('.signin').attr("disabled", true);
			$('.signin').removeClass("blue-bg");
			$('.signin').addClass("btn-secondary");
			if(type=="receiver"){
				$('.signin i').addClass('fa-spinner fa-spin');
				$.ajax({
					url: "php_modules/loginReceiver.php",
					method: "POST",
					data:{email:email,password:pass},
					success: function(data)
					{
						
						if(data.indexOf("receiver")!=-1){
							location.reload(true);
						}
						else if(data.indexOf("The password you entered is incorrect")!=-1){
							var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Incorrect password.<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
							$('.errorPass').html(out);
						}
						else if(data.indexOf("email not found")!=-1){
							var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Email not found.<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
							$('.errorMail').html(out);
						}
						else{
							var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Unexpected error occurred.<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
							$('.errorButton').html(out);
						}

						$('.signin i').removeClass('fa-spinner fa-spin');
						removeDisableButton();
					}
				});
			}
			else{
				$('.signin i').addClass('fa-spinner fa-spin');
				$.ajax({
					url: "php_modules/loginHospital.php",
					method: "POST",
					data:{email:email,password:pass},
					success: function(data)
					{
						if(data.indexOf("hospital")!=-1){
							location.reload(true);
						}
						else if(data.indexOf("The password you entered is incorrect")!=-1){
							var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Incorrect password.<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
							$('.errorPass').html(out);
						}
						else if(data.indexOf("email not found")!=-1){
							var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Email not found.<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
							$('.errorMail').html(out);
						}
						else{
							var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Unexpected error occurred.<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
							$('.errorButton').html(out);
						}
						$('.signin i').removeClass('fa-spinner fa-spin');
						removeDisableButton();
					}
				});

			}
			
		}
		else if(email==""){
			var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Please enter a valid email id.<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
			$('.errorMail').html(out);
		}
		else if(type==""){
			var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Please enter what type of user you are.<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
			$('.errorType').html(out);
		}
		else if(pass==""){
			var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Please enter a valid password.<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
			$('.errorPass').html(out);
		}

	});
	
	function removeDisableButton(){
		$('.signin').attr("disabled", false);
		$('.signin').removeClass("btn-secondary");
		$('.signin').addClass("blue-bg");
	}

	function validateEmail($email) {
	  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	  
	  return emailReg.test( $email );
	}

});