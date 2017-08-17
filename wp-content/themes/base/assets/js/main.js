jQuery(document).ready(function($) {

   $('.register').on('click', function() {

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
                    $('.message').html(response.message);
                }
            });

    });
});