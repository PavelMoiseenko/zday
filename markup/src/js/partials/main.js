jQuery(function() {
	forms();
	initScroll();
	mobileHover();
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
	var rellax = new Rellax('.img-triangles .layer');

	var wow = new WOW();
	wow.init();

	WOW.prototype.addBox = function(element){
		this.boxes.push(element);
	};

	jQuery('.wow').on('scrollSpy:exit', function() {
		jQuery(this).css({
			'visibility': 'hidden',
			'animation-name': 'none'
		}).removeClass('animated');
		wow.addBox(this);
	}).scrollSpy();

	var mySwiper = new Swiper ('.slider', {
        slidesPerView: 3,
        spaceBetween: 30,
        nextButton: '.next',
        prevButton: '.prev',
        breakpoints: {
        	1024: {
        		slidesPerView: 3,
        		spaceBetween: 15
        	},
            767: {
                slidesPerView: 2,
                spaceBetween: 15
            },
            500: {
                slidesPerView: 1,
                spaceBetween: 0
            }
        }
    });

	var swiper_slidecount = mySwiper.slides.length - 3;
	if (swiper_slidecount < 1) {
		jQuery('.slider-holder').addClass('no-pagination');
		jQuery('.prev, .next').remove();
	}
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

function mobileHover() {
	jQuery('*').on('touchstart', function () {
		jQuery(this).addClass('hover');
	}).on('touchend', function () {
		jQuery(this).removeClass('hover');
	});
}