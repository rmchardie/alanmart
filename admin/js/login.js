const loginForm = document.getElementById("loginForm");
const authCode = document.getElementById("authCode");
const emptyInputMessage = document.getElementById("emptyInput");

// If the input field is empty, don't submit the form and display an error message
function checkInput(e) {
  if (authCode.value === "") {
    e.preventDefault();
    emptyInputMessage.style.display = "block";
    emptyInputMessage.classList.add("error");
  }
}

authCode.addEventListener("focus", () => {
  emptyInputMessage.style.display = "none";
  emptyInputMessage.classList.remove("error");
});

loginForm.addEventListener("submit", checkInput);
