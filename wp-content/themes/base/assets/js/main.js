jQuery(document).ready(function($) {

    $('.registration .register').on('click', function() {

        var action   = 'ajaxregister',
            surname = $('.surname').val(),
            name = $('.name').val(),
            email    = $('.email').val(),
            event_id = $('.event_id').val();

        $.ajax({
            type: 'POST',
            //dataType: 'json',
            url: objectName.ajaxurl,
            data: {
                'action': action,
                'nonce': objectName.nonce,
                'surname': surname,
                'name': name,
                'email': email,
                'event_id': event_id
            },
            success: function (response) {

                $('.message').text(response.message);
            }
        });

        //event.preventDefault();
    });
});