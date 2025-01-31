document.addEventListener('DOMContentLoaded', function() {
    const showCards = document.querySelectorAll('.show-card');
    showCards.forEach(card => {
        card.addEventListener('click', function() {
            const showId = this.dataset.show_id;
            window.location.href = `shows/${showId}`;
        });
    });

    const popup = document.querySelector('.popup-message');
    if (popup) {
        setTimeout(() => {
            popup.style.display = 'none';
        }, 5000);
    }
});