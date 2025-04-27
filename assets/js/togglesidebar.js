// Mobile menu toggle
document.addEventListener("DOMContentLoaded", function () {
    const burger = document.querySelector(".burger-menu");
    const nav = document.querySelector(".main-nav");
    const menuIcon = document.querySelector(".burger-menu i");

    burger.addEventListener("click", function () {
        nav.classList.toggle("active");
        menuIcon.classList.toggle("fa-bars");
        menuIcon.classList.toggle("fa-times");
    });
});