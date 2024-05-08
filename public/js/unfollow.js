document.addEventListener('click', function(event) {
    console.log('ok');
    if (event.target && event.target.classList.contains('toggle-button')) {
        event.preventDefault();

        var button = event.target;
        var amiId = button.getAttribute('data-ami-id');
        console.log(amiId);
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (button.innerHTML === 'Unfollow') {
            // Envoyer une requête pour unfollow l'ami
            $.ajax({
                url: '/friends/' + amiId + '/unfollow',
                type: 'DELETE',
                data: {
                    _token: csrfToken
                },
                success: function(response) {
                    if (response.success) {
                        // Mettre à jour le texte du bouton
                        button.innerHTML = 'Follow';

                        // Changer la classe du bouton si nécessaire
                        button.classList.remove('btn-danger');
                        button.classList.add('btn-primary');
                    }
                }
            });
        } else if (button.innerHTML === 'Follow') {
            // Envoyer une requête pour follow l'ami
            $.ajax({
                url: '/friends/' + amiId + '/follow',
                type: 'POST',
                data: {
                    _token: csrfToken
                },
                success: function(response) {
                    if (response.success) {
                        // Mettre à jour le texte du bouton
                        button.innerHTML = 'Unfollow';

                        // Changer la classe du bouton si nécessaire
                        button.classList.remove('btn-primary');
                        button.classList.add('btn-danger');
                    }
                }
            });
        }
    }
});







