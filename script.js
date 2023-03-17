

document.querySelectorAll('.add-friend').forEach(button => {
    button.addEventListener('click', () => {
        const userId = button.getAttribute('data-user-id');
        fetch('ajouter_amis.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `user_id2=${userId}`
        }).then(response => response.text()).then(text => {
            alert(text);
        });
    });
});

document.querySelectorAll('.remove-friend').forEach(button => {
    button.addEventListener('click', () => {
        const userId = button.getAttribute('data-user-id');
        fetch('supprimer_amis.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `user_id2=${userId}`
        }).then(response => response.text()).then(text => {
            alert(text);
        });
    });
});


const pageTitle = document.querySelector('h1');

// Modifiez sa couleur de texte
pageTitle.style.color = 'blue';

// Sélectionnez le bouton de soumission
const submitButton = document.querySelector('input[type="submit"]');

// Modifiez sa couleur d'arrière-plan
submitButton.style.backgroundColor = 'red';

document.querySelectorAll('.add-friend').forEach(function (button) {
    button.addEventListener('click', function (event) {
        // ...
    });
});

document.querySelectorAll('.remove-friend').forEach(function (button) {
    button.addEventListener('click', function (event) {
        // ...
    });
});