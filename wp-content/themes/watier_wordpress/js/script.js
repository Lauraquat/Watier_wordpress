$(function() {
    $('#contact_form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
                'action': 'send_contact_form',
                'form_to': $('#form_to').val(),
                'form_email': $('#form_email').val(),
                'form_message': $('#form_message').val(),
            }
        }).done(function(response) {
            if (response.data.send == true) {
                $('#form_email').val('');
                $('#form_message').val('');
                $('#form_action').fadeOut(250, function() {
                    $('#form_cta').hide();
                    $('#form_action').html('<p>Message envoyé</p>');
                    $('#form_action').fadeIn(250);
                });
            }
        });
    });
});