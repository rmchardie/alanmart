const updatesContainer = document.querySelector(".display-updates");
const newsletterContainer = document.getElementById("newsletterContainer");
const uploadNewsletterModalBtn = document.getElementById("uploadNewsletterBtn");
const uploadNewsletterBtn = document.getElementById("uploadNewsletter");
const closeNewsletterModalBtn = document.getElementById(
  "closeNewsletterModalBtn"
);
const closeReuploadBtn = document.getElementById("closeReuploadBtn");
const reuploadNewsletterBtn = document.getElementById("reuploadNewsletterBtn");
const confirmOverlay = document.querySelector(".confirm-modal-overlay");
const deleteModal = document.querySelector("#deleteModal");
const logOutModal = document.querySelector("#logOutModal");
const logOutBtn = document.querySelector("#logOutBtn");
const mobileSignOutBtn = document.querySelector("#mobileSignOut");
const confirmCancelBtn = document.querySelector("#no");
const confirmDeleteBtn = document.getElementById("yes");
const confirmCancelLogOutBtn = document.querySelector("#logOutNo");
const confirmLogOutBtn = document.querySelector("#logOutYes");
const blogContainer = document.querySelector(".blogContainer");
const closeBtn = document.getElementById("closeBtn");
const warningText = document.querySelector("#warning-text");
const formPostID = document.getElementById("formPostID");
const imageFile = document.getElementById("postImageFile");
const imageFileName = document.getElementById("postImage");

let selectedPostID;
let newsletterToUpload = document.getElementById("newsletterToUpload");

// When cancel or close button is clicked/pressed hide all modals and overlays
function hideOverlay() {
  confirmOverlay.classList.add("hidden");
}

// Get contents of JSON file and display them on the screen, create function to show delete confirmation modal
function displayPosts() {
  // Display contents of JSON file
  fetch("../posts.json")
    .then((response) => response.json())
    // parsed contains the parsed JSON file
    .then((parsed) => {
      // If JSON file isn't empty, display it's contents
      formPostID.setAttribute("value", parsed.length);
      if (parsed.length != 0) {
        parsed.forEach((post) => {
          // Create div for each post item
          const postID = document.createElement("div");
          const postItem = document.createElement("div");
          const postDate = document.createElement("div");
          const postTitle = document.createElement("div");
          const deleteIconContainer = document.createElement("div");
          const deleteIcon = document.createElement("i");

          // Add class name to each div
          postID.classList.add("post-id");
          postItem.classList.add("update");
          postDate.classList.add("post-date");
          postTitle.classList.add("post-title");
          deleteIconContainer.classList.add("delete");
          deleteIcon.classList.add("fas");
          deleteIcon.classList.add("fa-trash-alt");
          deleteIcon.classList.add("deleteIcon");

          // Set attributes of each div
          postItem.style.borderBottom = "solid 1px rgba(0, 119, 255, 0.4)";
          postID.textContent = post.postID;
          postDate.textContent = post.postDate;
          postTitle.textContent = post.postTitle;

          // When user clicks the delete icon, show confirmation modal
          function showOverlay() {
            warningText.textContent =
              "Are you sure you want to delete '" + post.postTitle + "'";
            selectedPostID = post.postID;
            blogContainer.classList.add("hidden");
            logOutModal.hidden = true;
            deleteModal.hidden = false;
            confirmOverlay.classList.remove("hidden");
          }
          deleteIcon.addEventListener("click", showOverlay);

          // Add div to parent container
          deleteIconContainer.append(deleteIcon);
          postItem.append(postID, postTitle, postDate, deleteIconContainer);
          updatesContainer.append(postItem);
        });
      } else {
        // If JSON file is empty, tell the user that
        updatesContainer.style.textAlign = "center";
        updatesContainer.style.fontSize = "48px";
        updatesContainer.textContent = "No posts to show";
      }
    });
}

// When user clicks the ok button, delete selected post
function deletePost() {
  fetch("http://localhost/alanmart/admin/update-json.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body: `postID=${selectedPostID}`,
  })
    .then((response) => response.text())
    .then(location.reload(true));
}

// Upload newsletter to file store
function uploadNewsletter() {
  fetch("http://localhost/alanmart/admin/upload-newsletter.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body: `newsletterToUpload=${newsletterToUpload}`,
  })
    .then((response) => response.text())
    .catch(() => {
      newsletterContainer.classList.add("hidden");
      uploadErrorContainer.classList.remove("hidden");
    });
}

// When the user clicks Log out, show the confirmation modal
function showLogOutModal() {
  logOutModal.hidden = false;
  deleteModal.hidden = true;
  blogContainer.classList.add("hidden");
  newsletterContainer.classList.add("hidden");
  confirmOverlay.classList.remove("hidden");
}

// Event Listeners
confirmDeleteBtn.addEventListener("click", deletePost);
logOutBtn.addEventListener("click", showLogOutModal);
mobileSignOutBtn.addEventListener("click", showLogOutModal);
confirmCancelBtn.addEventListener("click", hideOverlay);
confirmCancelLogOutBtn.addEventListener("click", hideOverlay);
closeBtn.addEventListener("click", hideOverlay);
closeNewsletterModalBtn.addEventListener("click", hideOverlay);
uploadNewsletterBtn.addEventListener("click", uploadNewsletter);

confirmLogOutBtn.addEventListener("click", () => {
  location.href = "logout.php";
});

newUpdateBtn.addEventListener("click", () => {
  deleteModal.hidden = true;
  logOutModal.hidden = true;
  newsletterContainer.classList.add("hidden");
  blogContainer.classList.remove("hidden");
  confirmOverlay.classList.remove("hidden");
});

uploadNewsletterModalBtn.addEventListener("click", () => {
  deleteModal.hidden = true;
  logOutModal.hidden = true;
  blogContainer.classList.add("hidden");
  confirmOverlay.classList.remove("hidden");
  newsletterContainer.classList.remove("hidden");
});

// When the user selects an image to upload, get it's filename to store in the JSON file.
imageFile.addEventListener("change", (event) => {
  const files = event.target.files;
  for (const file of files) {
    imageFileName.setAttribute("value", file.name);
  }
});

// On load
displayPosts();
