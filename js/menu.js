const header = document.querySelector(".mobile");
const icon = document.getElementById("icon");
const menu = document.querySelector(".hamburger-menu");
const menuContainer = document.getElementById("hamburger-menu-container");
const icon1 = document.getElementById("a");
const icon2 = document.getElementById("b");
const icon3 = document.getElementById("c");

icon.addEventListener("click", function () {
  icon1.classList.toggle("a");
  icon2.classList.toggle("c");
  icon3.classList.toggle("b");
  menu.classList.toggle("show");
  menuContainer.classList.toggle("slide");
  if (menu.classList.contains("show")) {
    header.style.height = "100vh";
    header.style.alignItems = "flex-start";
    menu.style.display = "block";
    menuContainer.style.display = "block";
  } else {
    header.style.height = "70px";
    header.style.alignItems = "center";
    menu.style.display = "none";
    menuContainer.style.display = "none";
  }
});

menu.style.display = "none";
menuContainer.style.display = "none";
