$(document).ready(function(){

	$('.reg-rec').click(function(){
		if($('div').hasClass('alert')){
			
			$('div.alert').remove();
		}
		$('.reg-rec').attr("disabled", true);
		$('.reg-rec').removeClass("btn-primary");
		$('.reg-rec').addClass("btn-secondary");
		var name = $('#inputName').val();
		var email = $('#inputEmail').val();
		var pass = $('#inputPassword').val();
		var phone = $('#inputPhone').val();
		var address = $('#inputAddress').val();
		var city = $('#inputCity').val();
		var state = $('#inputState').val();
		var code = $('#inputCode').val();
		var blood = $('#inputBlood').val();
		if(name==""){
			var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Please enter your name<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
			$('.regErrorName').html(out);
			removeDisableButton();	
		}
		else if(email=="" || !validateEmail(email)){
			var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Please enter valid email<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
			$('.regErrorMail').html(out);
			removeDisableButton();	
		}
		else if(pass=="" || pass.length<6){
			var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Please enter valid password<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
			$('.regErrorPass').html(out);
			removeDisableButton();
		}
		else if(phone=="" || phone.length!=10){
			var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Please enter valid phone number<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
			$('.regErrorPhone').html(out);
			removeDisableButton();
		}
		else if(address==""){
			var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Please enter your address<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
			$('.regErrorAddress').html(out);
			removeDisableButton();
		}
		else if(city==""){
			var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Please enter your city<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
			$('.regErrorCity').html(out);
			removeDisableButton();
		}
		else if(state==""){
			var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Please enter your state<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
			$('.regErrorState').html(out);
			removeDisableButton();
		}
		else if(code==""  || !validatePostalCode(code)){
			var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Please enter valid postal code<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
			$('.regErrorCode').html(out);
			removeDisableButton();
		}
		else if(blood==""){
			var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Please enter your blood group<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
			$('.regErrorBlood').html(out);
			removeDisableButton();
		}
		else{
			$('.reg-rec i').addClass('fa-spinner fa-spin');
			$.ajax({
				url: "php_modules/regReceiverBackend.php",
				method: "POST",
				data:{name:name,email:email,password:pass,phone:phone,address:address,city:city,state:state,code:code,blood:blood},
				success: function(data)
				{
					if(data.indexOf("successful")!=-1){
						
						Swal.fire({
						  icon: 'success',
						  title: 'Registered Successfully',
						  text: 'Sign In to continue!',
						  
						  confirmButtonText: '<a href="#" data-toggle="modal" data-target="#signinModalForm" style="color:white;text-decoration:none;">Sign In</a>',
						  
						});
						
					
					}
					else if(data.indexOf("This email is already taken.")!=-1){
						var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> This email id is already taken.<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
						$('.regErrorMail').html(out);
					}
					else if(data.indexOf("Password must have atleast 6 characters.")!=-1){
						var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Password must be minimum of six characters.<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
						$('.regErrorPass').html(out);
					}
					else{
						var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Some error occurred, refresh the page and try sometimes later.<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
						$('.someError').html(out);
					}
					$('.reg-rec i').removeClass('fa-spinner fa-spin');
					removeDisableButton();	
				}
			});
		}
	});



	function removeDisableButton(){
		$('.reg-rec').attr("disabled", false);
		$('.reg-rec').removeClass("btn-secondary");
		$('.reg-rec').addClass("btn-primary");
	}

// stack overflow	
	function validateEmail(email) {
	  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	  
	  return emailReg.test( email );
	}

	function validatePostalCode(code){
		var zipRegex = /^\d{6}$/;
		return zipRegex.test(code);
	}
});