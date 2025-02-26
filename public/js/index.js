document.addEventListener('DOMContentLoaded', function() {
    const showCards = document.querySelectorAll('.show-box');
    showCards.forEach(card => {
        card.addEventListener('click', function() {
            const showId = this.dataset.show_id;
            window.location.href = `shows/${showId}`;
        });
    });

    const users = document.querySelectorAll('.user-card');
    users.forEach(card => {
        card.addEventListener('click', function() {
            const userId = this.dataset.user_id;
            window.location.href = `users/${userId}`;
        });
    });

    const backButton = document.querySelector('.back-button');
    if (backButton) {
        backButton.addEventListener('click', function() {
            window.history.back();
        });
    }

    const popup = document.querySelector('.popup-message');
    if (popup) {
        setTimeout(() => {
            popup.style.display = 'none';
        }, 5000);
    }

    const deleteButton = document.querySelector('.delete-button');
    if (deleteButton) {
        deleteButton.addEventListener('click', function() {
            const result = confirm('Tem certeza que deseja continuar?');
            if (result) {
                const form = document.getElementById('delete-form');
                
                form.submit();
            }
        });
    }
});