document.getElementById("menuToggle").addEventListener("click", function () {
    var navbar = document.getElementById("navbar");
    var menuToggle = document.getElementById("menuToggle");
    var container = document.querySelector(".container-fluid");

    if (navbar.style.left === "0px") {
        navbar.style.left = "-200px";
        menuToggle.style.left = "90%"; // Move the toggle button back to the original position
        container.style.marginLeft = "0"; // Adjust content when the navbar is hidden
    } else {
        navbar.style.left = "0px";
        menuToggle.style.left = "215px"; // Move the toggle button to the right side of the navbar
        container.style.marginLeft = "200px"; // Adjust content when the navbar is shown
    }
});
