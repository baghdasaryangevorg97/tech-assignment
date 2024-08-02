$(function () {
    $('#logout-btn').on('click', function (e) {
        localStorage.removeItem('auth_token');
        window.location.href = '/auth/signin';
    });
});


