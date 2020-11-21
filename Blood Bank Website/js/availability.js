$(document).ready(function(){
	$('.search').click(function(){
		var hospitalName = $('#inputHospital').val();
		var hospitalId = "";
		if(hospitalName.length>0){
			hospitalId = $('#hospitalId').val();
		}		
		var bloodType = $('#inputBlood').val();

		if(hospitalId!="" || bloodType!=""){
			$('.data-container').html("");
			$('.pre-loader i').addClass('fa-spinner fa-spin');


			$.ajax({
				url: 'php_modules/searchQuery.php',
				method: "POST",
				data: {id:hospitalId,blood:bloodType},
				success: function(data){
					$('.pre-loader i').removeClass('fa-spinner fa-spin');

					$('.data-container').html(data);
					$('.clear').removeClass('disabled');

				}
			});

		}

	});

	$('.show-all').click(function(){
		$('#hospitalId').val("");
		$('#inputHospital').val("");
		$('#inputBlood').val("");
		$('.data-container').html("");
		$('.pre-loader i').addClass('fa-spinner fa-spin');
		$.ajax({
			url: 'php_modules/showAll.php',
			method: "POST",
			success: function(data){
				$('.pre-loader i').removeClass('fa-spinner fa-spin');

				$('.data-container').html(data);
				$('.clear').removeClass('disabled');
			}
		});
	});
	$('.clear').click(function(){
		location.reload(true);
	})
});