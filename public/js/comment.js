document.addEventListener('keydown', function(event) {
    if (event.keyCode === 13 && event.target.classList.contains('comment-input')) {
      event.preventDefault();

      var commentInput = event.target;
      var comment = commentInput.value;
      var postId = commentInput.getAttribute('data-post-id');
      var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      // Effectuer la requête Ajax
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '/posts/' + postId + '/comments');
      xhr.setRequestHeader('Content-Type', 'application/json');
      xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
      xhr.onload = function() {
        if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          if (response.success) {
            // Réinitialiser le champ de commentaire
            commentInput.value = '';

            // Récupérer l'URL de l'avatar
            var avatarUrl = response.avatarUrl;


            // Afficher le nouveau commentaire dans la liste des commentaires
            var commentList = document.querySelector('.box-footer.box-comments');
            var newComment = document.createElement('div');
            newComment.className = 'box-comment';


            var commentUser = document.createElement('span');
            commentUser.className = 'username';
            commentUser.innerHTML = '<img class="img-circle img-sm" src="' + avatarUrl + '" alt="User Image">' + response.comment.user.name;




            var commentText = document.createElement('div');
            commentText.className = 'comment-text';


            var commentContent = document.createElement('p');
            commentContent.innerText = response.comment.comment;

            commentText.appendChild(commentUser);
            commentText.appendChild(commentContent);

            newComment.appendChild(commentText);

            commentList.appendChild(newComment);
          } else {
            console.log(response.message);
          }
        } else {
          console.log('Erreur lors de la requête Ajax');
        }
      };
      xhr.send(JSON.stringify({ comment: comment }));
    }
  });
