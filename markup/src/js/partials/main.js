jQuery(function() {
    forms();
    initScroll();
    initPopup();
    jQuery(".form").submit(function(e) {
        e.preventDefault();
    }).validate({
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

        	jQuery('.form').find('.button').addClass('disabled');

            var action = 'ajaxregister',
                surname = jQuery('.surname').val(),
                name = jQuery('.name').val(),
                email = jQuery('.email').val(),
                specialization = jQuery('.specialization').val(),
                telephone = jQuery('.telephone').val();
            event_id = jQuery('.event_id').val();

            jQuery.ajax({
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
                    jQuery('.name-err').text(response.nameErr);
                    jQuery('.surname-err').text(response.surnameErr);
                    jQuery('.email-err').text(response.emailErr);
                    jQuery('.specialization-err').text(response.specializationErr);
                    jQuery('.telephone-err').text(response.telephoneErr);
                    var parent = jQuery('.form-box');
                    if(response.messageErr){
                        jQuery('.success-message').html(response.messageErr);
                    }else if(response.emailErr) {
                        jQuery('.success-message').html(response.emailErr);
                    }
                    else {
                        jQuery('.success-message').html(response.message);
                    }
                    parent.addClass('success-form');
                    parent.find('.form').hide();
                    parent.find('.success-message').fadeIn('slow');
                }
            });
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

    if (swiper_slidecount < 1 ) {
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

function mobileHover() {
	jQuery('*').on('touchstart', function () {
		jQuery(this).addClass('hover');
	}).on('touchend', function () {
		jQuery(this).removeClass('hover');
	});
}

function initPopup(){
    jQuery('.link-holder').on('click', function (e) {
        e.preventDefault();
        jQuery('.popup-holder').addClass('active');
        jQuery('.ico-loader').show();
        var action = 'popup',
            event_id = jQuery(this).attr('data-id');

        jQuery.ajax({
            type: 'POST',
            url: objectName.ajaxurl,
            data: {
                'action': action,
                'nonce': objectName.nonce,
                'event_id': event_id
            },
            success: function (response) {
            	jQuery('.ico-loader').hide();
                jQuery('#popup1').css({'display': 'block'});
                jQuery("#popup1 .heading h2").text(response.event_title);
                jQuery("#popup1 .popup-description").html(response.event_content);
                jQuery("#popup1 .image img").attr("src", response.event_image_url);
                var speakers_string = 'Спикеры: ';
                for (var i = 0; i < response.event_speakers_title.length; i++) {

                    speakers_string += response.event_speakers_title[i] + " (" + response.event_speakers_position[i] + ")";
                }
                jQuery("#speakers-string").text(speakers_string);

                var galleryTop = new Swiper('.gallery-top', {
                    observer: true,
                    observeParents: true,
                    preloadImages: false,
                    lazyLoading: true,
                    nextButton: '.swiper-next',
                    prevButton: '.swiper-prev',
                });
                var galleryThumbs = new Swiper('.gallery-thumbs', {
                    spaceBetween: 30,
                    slidesPerView: 3,
                    slideToClickedSlide: true,
                    centeredSlides: true,
                    centerMode: true,
                    focusOnSelect: true,
                    observer: true,
                    observeParents: true,
                    preloadImages: false,
                    lazyLoading: true,
                    breakpoints: {
                        1024: {
                            slidesPerView: 2,
                            spaceBetween: 10
                        }
                    }
                });

                galleryTop.params.control = galleryThumbs;
                galleryThumbs.params.control = galleryTop;

                var swiperThumb_slidecount = galleryThumbs.slides.length - 3;
                if (swiperThumb_slidecount < 1 ) {
                    jQuery('.slider-holder').addClass('no-pagination');
                    jQuery('.swiper-prev, .swiper-next').remove();
                }
            }
        });

    });

    jQuery('.pop-close').on('click', function(e){
        e.preventDefault();


        jQuery(this).closest('.popup').fadeOut();
        jQuery('.popup-holder').removeClass('active');
    })
}