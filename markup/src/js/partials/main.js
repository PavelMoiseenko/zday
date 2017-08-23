jQuery(function() {
	forms();
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
			// var parent = jQuery('.form-box');

			// parent.addClass('success-form');
			// parent.find('.form').hide();
			// parent.find('.success-message').fadeIn('slow');
		}
	});
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