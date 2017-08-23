jQuery(function() {
	forms();
	initScroll();
	jQuery(".form").validate({
		errorPlacement: function(error,element) {
			return true;
		},
		rules: {
			nameField: {
				required: true
			},
			surnameField: {
				required: true
			},
			emailField: {
				required: true,
				email: true
			},
			specializationField: {
				required: true
			},
			telField: {
				digits: true
			}
		},
        submitHandler: function(form) {
            ajaxFormSubmit();
        }
	});
	//var rellax = new Rellax('.img-triangles');
});

function forms(){
	jQuery('form').on('focus pageload', 'input[type="text"], input[type="email"], input[type="number"], input[type="tel"], input[type="password"], textarea', function(){
		thisInput = jQuery(this);
		thisInput.parent().addClass('filled');
	});

	jQuery('form').on('blur pageload', 'input[type="text"], input[type="email"], input[type="number"], input[type="tel"], input[type="password"], textarea', function(){
		thisInput = jQuery(this);
		if(thisInput.val() === ''){
			thisInput.parent().removeClass('filled');
		}
	});

	jQuery('form input, form select, form textarea').each(function(){
		jQuery(this).trigger('pageload');
	});
}

function initScroll() {
	jQuery('a').click(function(){
		jQuery('html, body').animate({
			scrollTop: jQuery( jQuery(this).attr('href') ).offset().top
		}, 800);
		return false;
	});
}

function ajaxFormSubmit(){
	var action = 'ajaxregister',
		surname = $('.surname').val(),
		name = $('.name').val(),
		email = $('.email').val(),
		specialization = $('.specialization').val(),
		telephone = $('.telephone').val();
		event_id = $('.event_id').val();

	$.ajax({
		type: 'POST',
		url: objectName.ajaxurl,
		data: {
			'action': action,
			'nonce': objectName.nonce,
			'surname': surname,
			'name': name,
			'email': email,
			'specialization': specialization,
			'telephone': telephone,
			'event_id': event_id
		},
		success: function (response) {
			$('.name-err').text(response.nameErr);
			$('.surname-err').text(response.surnameErr);
			$('.email-err').text(response.emailErr);
			$('.specialization-err').text(response.specializationErr);
			$('.telephone-err').text(response.telephoneErr);
			var parent = $('.form-box');
			if(response.messageErr){
				$('.success-message').html(response.messageErr);
			}else{
				$('.success-message').html(response.message);
			}
			parent.addClass('success-form');
			parent.find('.form').hide();
			parent.find('.success-message').fadeIn('slow');
		}
	});
}