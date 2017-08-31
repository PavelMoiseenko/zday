jQuery(document).ready(function($) {

   $('.link-holder').on('click', function(e){
       e.preventDefault();

       jQuery('.popup-holder').addClass('active');
       jQuery('.ico-loader').show();

       var action = 'popup',
           event_id = $(this).attr('data-id');

       $.ajax({
           type: 'POST',
           url: objectName.ajaxurl,
           data: {
               'action': action,
               'nonce': objectName.nonce,
               'event_id': event_id
           },
           success: function (response) {
               $("#popup1 .heading h2").text(response.event_title);
               $("#popup1 .popup-description").html(response.event_content);

               var speakers_string = 'Спикеры: ';
               for (var i=0; i<response.event_speakers_title.length; i++){

                   speakers_string += response.event_speakers_title[i]+ " (" + response.event_speakers_position[i] + ") " ;
               }
               $("#speakers-string").text(speakers_string);
               if (response.images){
                   $('.top-picture').html('');
                   $('.bottom-picture').html('');
                   for(var i=0; i < response.images.length; i++){
                       $('.top-picture').append("<div class=\"swiper-slide\"><img data-src='" +response.images[i]+ "' class=\"swiper-lazy\"></div>");
                       $('.bottom-picture').append("<div class=\"swiper-slide\"><img data-src='" +response.images[i] +"' class=\"swiper-lazy\"></div>");
                   }
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
                   if (i <= 3 ) {
                       jQuery('.swiper-prev, .swiper-next').remove();
                   }
               }

               jQuery('.ico-loader').hide();
               $('#popup1').css({'display':'block'});

           }
       });

   });
    jQuery('.pop-close').on('click', function(e){
        e.preventDefault();


        jQuery(this).closest('.popup').fadeOut();
        jQuery('.popup-holder').removeClass('active');
    })
});
