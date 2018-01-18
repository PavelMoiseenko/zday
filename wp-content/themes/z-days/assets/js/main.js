jQuery(document).ready(function($) {

   $('.register').on('click', function() {

            var action = 'ajaxregister',
                surname = $('.surname').val(),
                name = $('.name').val(),
                email = $('.email').val(),
                specialization = $('.specialization').val(),
                telephone = $('.telephone').val(),
                event_id = $('.event_id').val(),
                q_1 = $('input[name="question_1"]').val(),
                q_2 = $('input[name="question_2"]').val(),
                q_3 = $('input[name="question_3"]').val(),
                q_4 = $('input[name="question_4"]').val(),
                q_5 = $('input[name="question_5"]').val();

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
                    'event_id': event_id,
                    'question_1': q_1,
                    'question_2': q_2,
                    'question_3': q_3,
                    'question_4': q_4,
                    'question_5': q_5
                },
                success: function (response) {
                    $('.name-err').text(response.nameErr);
                    $('.surname-err').text(response.surnameErr);
                    $('.email-err').text(response.emailErr);
                    $('.specialization-err').text(response.specializationErr);
                    $('.telephone-err').text(response.telephoneErr);
                    $('.success-message').html(response.messageErr);
                }
            });

    });
});