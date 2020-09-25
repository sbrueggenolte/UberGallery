$(document).on('submit', '#login-form',  function(e) {

    // fetch('/loginCheck.php', {
    //     method: 'POST',
    //     body: new FormData(e.target),
    //     credentials: 'include'
    // });

    // $.post('/loginCheck.php', {
    //     'password': $('#password').val(),
    //     'email': $('#email').val()
    // }, function(response) {
    //     if (window.PasswordCredential) {
    //         var c = new PasswordCredential(e.target);
    //         console.log(c);
    //         return navigator.credentials.store(c);
    //     } else {
    //         console.log('weißbnich');
    //         return Promise.resolve(profile);
    //     }
    // });


    // Stop submitting form by itself
    e.preventDefault();

    $('#formContent').removeClass('shake-effect');

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
                iconURL: 'https://rosa.dev.localhost.de'
            });

            console.log(c);
            var result = navigator.credentials.store(c);
            console.log(result);
            return result;
        } else {
            return Promise.resolve(profile);
        }
    }).then(profile => {

        console.log(profile);
        // Successful sign-in
        // if (profile) {
            window.location.replace('/');
        // }
    }).catch(error => {
        $('#formContent').addClass('shake-effect');
    });

});