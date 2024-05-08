// addFriend.js

$(document).ready(function () {
    $('.add-friend-btn').on('click', function (e) {
        e.preventDefault();
        var userId = $(this).data('ami-id');

        $.ajax({
            url: '/add-friend',
            type: 'POST',
            data: {
                user_id: userId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.success) {
                    // Mettre à jour l'apparence du bouton "Add Friend"
                    var button = $('.add-friend-btn[data-ami-id="' + userId + '"]');
                    button.removeClass('btn-success').addClass('btn-warning');
                    button.text('Following');

                    // Afficher une notification
                    var message = response.message;
                    // Code pour afficher la notification ici
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});
