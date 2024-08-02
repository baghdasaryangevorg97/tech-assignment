$(function () {

    $('#signinForm').on('submit', function (e) {

        e.preventDefault();
        $('#emailError').text('');
        $('#passwordError').text('');
        $('#everyError').text('');

        $.ajax({
            url: '/api/v1/auth/login',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                localStorage.setItem('auth_token', response.token);
                window.location.href = '/websites';
            },
            error: function(jqXHR, textStatus, errorThrown) {
                if(jqXHR.status == '422'){
                    var errors = jqXHR.responseJSON.errors;

                    if (errors.email) {
                        $('#emailError').text(errors.email[0]);
                    }
                    if (errors.password) {
                        $('#passwordError').text(errors.password[0]);
                    }
                } else {
                    $('#everyError').text(jqXHR.responseJSON.message);
                }
            }
        });
    });

    $('#signupForm').on('submit', function (e) {

        e.preventDefault();
        $('#emailError').text('');
        $('#passwordError').text('');
        $('#passwordConfirmationError').text('');

        $.ajax({
            url: '/api/v1/auth/register',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                console.log(response, "responsee");
                localStorage.setItem('auth_token', response.token);
                window.location.href = '/websites';
            },
            error: function(jqXHR) {
                var errors = jqXHR.responseJSON.errors;
                if (errors.email) {
                    $('#emailError').text(errors.email[0]);
                }
                if (errors.password) {
                    $('#passwordError').text(errors.password[0]);
                }
                if (errors.password_confirmation) {
                    $('#passwordConfirmationError').text(errors.password_confirmation[0]);
                }
            }
        });
    });


});


