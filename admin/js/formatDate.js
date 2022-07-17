const addDate = new Date();
const blogForm = document.getElementById("blogPostForm");
const postDate = document.getElementById("postDate");

let monthName = "";

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
  monthName = months[addDate.getMonth()];
}

//   Event Listener
blogForm.addEventListener("submit", () => {
  formatMonth();
  postDate.value =
    addDate.getDate() + " " + monthName + " " + addDate.getFullYear();
});
