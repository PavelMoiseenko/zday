jQuery(document).ready(function($) {

   $('.link-holder').on('click', function(e){
       e.preventDefault();
       var action = 'popup',
           event_id = $(this).attr('data-id');
       //alert(event_id);

       $.ajax({
           type: 'POST',
           url: objectName.ajaxurl,
           data: {
               'action': action,
               'nonce': objectName.nonce,
               'event_id': event_id
           },
           success: function (response) {
               $('#popup1').css({'display':'block'});
               $("#popup1 .heading h2").text(response.event_title);
               $("#popup1 .popup-description").html(response.event_content);
               $("#popup1 .image img").attr("src" , response.event_image_url);
               var speakers_string = 'Спикеры: ';
               for (var i=0; i<response.event_speakers_title.length; i++){

                   speakers_string += response.event_speakers_title[i]+ " (" + response.event_speakers_position[i] + ") " ;
               }
               $("#speakers-string").text(speakers_string);

           }
       });

    });
});
