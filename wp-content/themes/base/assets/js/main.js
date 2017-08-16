jQuery(document).ready(function($) {

    //Validation
    // function showError(container) {
    //     container.className = 'error';
    // }

    // function validate() {
    //
    //     var field_name = document.getElementsByClassName("name")[0],
    //         field_surname = document.getElementsByClassName("surname")[0],
    //         field_email = document.getElementsByClassName("email")[0],
    //         field_specialization = document.getElementsByClassName("specialization")[0];
    //
    //     if(!field_name.value){
    //         showError(field_name);
    //     }
    //
    //     if(!field_surname.value){
    //         showError(field_surname);
    //     }
    //
    //     if(!field_email.value){
    //         showError(field_email);
    //     }
    //
    //     if(!field_specialization.value){
    //         showError(field_specialization);
    //     }
    //
    //     if(field_name.value && field_surname.value && field_email.value && field_specialization.value){
    //         return true;
    //     }
    //     else{
    //         return false;
    //     }
    //
    // }


    $('.registration .register').on('click', function() {

            var action = 'ajaxregister',
                surname = $('.surname').val(),
                name = $('.name').val(),
                email = $('.email').val(),
                specialization = $('.specialization').val(),
                telephone = $('.telephone').val();
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