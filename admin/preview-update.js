const form = document.getElementById("updateForm");
const postDate = new Date();
const previewDate = document.getElementById("preview-date");
const titleInput = document.getElementById("postTitle");
const title = document.getElementById("preview-title");
const contentInput = document.getElementById("postContent");
const content = document.getElementById("preview-content");
const linkInput = document.getElementById("postLink");
const link = document.getElementById("preview-link");
let monthName = "";
let formattedContent = "";
let linkText = "";

function formatMonth() {
  let months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];
  monthName = months[postDate.getMonth()];
  previewDate.style.color = "#d81e5b";
  previewDate.textContent =
    postDate.getDate() + " " + monthName + " " + postDate.getFullYear();
}

function formatLink() {
  linkText = linkInput.value;
  if (linkText.includes("http")) {
    link.setAttribute("href", linkText);
  } else {
    linkText = "http://" + linkInput.value;
    link.setAttribute("href", linkText);
  }
}

form.addEventListener("input", () => {
  title.textContent = titleInput.value;
  content.textContent = contentInput.value;
  content.style.height = content.scrollHeight + "px";
  if (linkInput.value != "") {
    formatLink();
    link.textContent = linkText;
  } else {
    linkText = "";
    link.textContent = linkText;
  }
});

formatMonth();
