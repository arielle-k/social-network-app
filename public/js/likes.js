document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('#form-js');
    console.log(forms);
    forms.forEach(form => {
      const button = form.querySelector('button');
      const count = form.querySelector('#count-js');

      form.addEventListener('submit', function(e) {
        e.preventDefault();
        console.log('formulaire cliqué');
        const url = form.getAttribute('action');
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const postId = form.querySelector('#post-id-js').value;

        fetch(url, {
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
          },
          method: 'post',
          body: JSON.stringify({
            id: postId
          })
        }).then(response => {
          response.json().then(data => {
            count.innerHTML = data.count+'likes';
          });
        }).catch(error => {
          console.log(error);
        });
      });
    });
  });
