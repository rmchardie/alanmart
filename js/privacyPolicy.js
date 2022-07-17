const cookieNotice = document.querySelector(".notification");
const dismissBtn = document.querySelector(".dismiss-notification");
const desktopDiv = document.querySelector(".desktop");
const userPreference = localStorage.getItem("user-preference");
const removeConsentBtn = document.querySelector(".remove-consent");

// When user clicks OK button, store their choice
dismissBtn.addEventListener("click", () => {
  cookieNotice.style.display = "none";
  desktopDiv.style.flexDirection = "row";
  localStorage.setItem("user-preference", "yes");
});

// On load
if (userPreference) {
  cookieNotice.style.display = "none";
} else {
  desktopDiv.style.flexDirection = "column";
  cookieNotice.style.display = "flex";
}
