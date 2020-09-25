$(document).on('submit', '#login-form',  function(e) {

    // Stop submitting form by itself
    e.preventDefault();

    $('#formContent').removeClass('shake-effect');

    $.post('/loginCheck.php', {
        'password': $('#password').val(),
        'email': $('#email').val()
    }, function(response) {
        console.log(1, response);
        $('#locked-message').slideUp();
        if (window.PasswordCredential) {
            var c = new PasswordCredential(e.target);

            return navigator.credentials.store(c);
        } else {
            return Promise.resolve(profile);
        }
    }).then(function() {
        window.location.replace('/');
    }).fail(function(response) {
        if (423 === response.status) {
            $('#locked-minutes').html(response.responseText);
            $('#locked-message').slideDown();

            return;
        }

        $('#locked-message').slideUp();
        $('#formContent').addClass('shake-effect');
    });

});