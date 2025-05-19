document.addEventListener("DOMContentLoaded", function () {
    const boxes = document.querySelectorAll(".restaurant-selector");
    const containers = document.querySelectorAll(".restaurant-dates");

    function activateRestaurant(restaurantId) {
        boxes.forEach((box) => {
            box.classList.toggle("active", box.dataset.id === restaurantId);
        });

        containers.forEach((container) => {
            container.classList.toggle("active", container.id === restaurantId);
        });
    }

    boxes.forEach((box) => {
        box.addEventListener("click", () => {
            activateRestaurant(box.dataset.id);
        });
    });

    if (boxes.length > 0) {
        activateRestaurant(boxes[0].dataset.id);
    }
});
