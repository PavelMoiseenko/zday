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