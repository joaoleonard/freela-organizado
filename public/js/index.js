document.addEventListener("DOMContentLoaded", function () {
    const showCards = document.querySelectorAll(".show-box");
    showCards.forEach((card) => {
        card.addEventListener("click", function () {
            const showId = this.dataset.show_id;
            window.location.href = `shows/${showId}`;
        });
    });

    const restaurantBox = document.querySelectorAll(".restaurant-box");
    restaurantBox.forEach((card) => {
        card.addEventListener("click", function () {
            const showId = this.dataset.restaurant_id;
            window.location.href = `restaurants/${showId}`;
        });
    });

    const users = document.querySelectorAll(".user-card");
    users.forEach((card) => {
        card.addEventListener("click", function () {
            const userId = this.dataset.user_id;
            window.location.href = `users/${userId}`;
        });
    });

    const musicianWaitlist = document.querySelectorAll(".musician-waitlist-card");
    musicianWaitlist.forEach((card) => {
        card.addEventListener("click", function () {
            const userId = this.dataset.user_id;
            window.location.href = `waitlist/${userId}`;
        });
    });

    const backButton = document.querySelector(".back-button");
    if (backButton) {
        backButton.addEventListener("click", function () {
            const goTo = this.dataset.go_to;

            if (goTo) {
                window.location.href = goTo;
            }
        });
    }

    const popup = document.querySelector(".popup-message");
    if (popup) {
        setTimeout(() => {
            popup.style.display = "none";
        }, 5000);
    }

    const deleteButton = document.querySelector(".delete-button");
    if (deleteButton) {
        deleteButton.addEventListener("click", function () {
            const result = confirm("Tem certeza que deseja continuar?");
            if (result) {
                const form = document.getElementById("delete-form");

                form.submit();
            }
        });
    }
});
