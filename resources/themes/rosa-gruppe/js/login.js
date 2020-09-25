$(document).on('submit', '#login-form',  function(e) {

    // Stop submitting form by itself
    e.preventDefault();

    $('#formContent').removeClass('shake-effect');


    $.post('/loginCheck.php', {
        'password': $('#password').val(),
        'email': $('#email').val()
    }, function(response) {
        $('#locked-message').slideUp();
        if (window.PasswordCredential) {
            var c = new PasswordCredential(e.target);
            return navigator.credentials.store(c);
        } else {
            return Promise.resolve(profile);
        }
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




/*

    // Try sign-in with AJAX
    fetch('/loginCheck.php', {
        method: 'POST',
        body: new FormData(e.target),
        credentials: 'include'
    }).then(res => {
        if (res.status == 200) {
            return Promise.resolve();
        } else {
            return Promise.reject('Sign-in failed');
        }
    }).then(profile => {
        // Instantiate PasswordCredential with the form
        if (window.PasswordCredential) {
            var c = new PasswordCredential({
                id: $('#email').val(),
                password: $('#password').val(),
                name: 'Fotos Rosa Gruppe',
                iconURL: 'https://rosa.hascha.de'
            });

            var result = navigator.credentials.store(c);
            return result;
        } else {
            return Promise.resolve(profile);
        }
    }).then(profile => {

        // console.log(profile);
        // Successful sign-in
        // if (profile) {
        //     window.location.replace('/');
        // }
    }).catch(error => {
        $('#formContent').addClass('shake-effect');
    });
*/

});