<?php
session_start();
if (!isset($_SESSION["authCode"])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Admin area - Alanmart</title>
    <meta name="application-name" content="Alanmart Day Care" />
    <meta
      name="description"
      content="Alanmart provides social care for adults in the Falkirk area, offering them the opportunity for companionship in an environment supported by qualified and caring staff. 
            Services available include Day Care, Respite and Outreach."
    />
    <meta name="author" content="Ross McHardie" />
    <meta name="ROBOTS" content="NOINDEX, NOFOLLOW" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Main stylesheet -->
    <link rel="stylesheet" href="../css/style.css" />
    <!-- Hamburger menu stylesheet -->
    <link rel="stylesheet" href="../css/menu.css" />
    <!-- Admin stylesheet -->
    <link rel="stylesheet" href="css/admin.css" />
    <!-- Font Awesome stylesheet -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
    <link rel="shortcut icon" href="../images/favico.png" type="image/x-icon" />
  </head>
  <body>
    <header>
      <!-- Will only display on smartphones -->
      <div class="mobile">
        <div class="mobile-logo">
          <img src="images/admin-logo.png" alt="Alanmart logo" />
        </div>
        <div class="mobile-sign-out" id="mobileSignOut">
          Log out<i class="fa-solid fa-sign-out"></i>
        </div>
      </div>
    </header>
    <!-- Start of Back to top button -->
    <a id="back-to-top-btn" title="Go to top">
      <i class="fa-solid fa-circle-chevron-up"></i>
    </a>
    <main class="container">
      <!-- Will only display on laptops and desktops -->
      <div class="desktop">
        <div class="logo">
          <a href="index.php">
            <img src="images/admin-logo.png" alt="Alanmart logo" />
          </a>
        </div>
        <div class="nav">
          <nav>
            <ul>
              <li>
                <a class="btn btn-primary" id="logOutBtn">
                  Log out
                  <i class="fa-solid fa-sign-out" style="margin-left: 10px"></i>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <h1>
        Current posts on
        <a href="../updates.html" style="margin-left: 10px">Latest updates</a>
        page
      </h1>
      <div class="navButtons">
        <div class="upload-newsletter-btn">
          <button class="btn btn-newsletter" id="uploadNewsletterBtn">
            <i class="fas fa-file-upload editIcon"></i>
            Upload newsletter
          </button>
        </div>
        <div class="new-update-btn">
          <button class="btn btn-newsletter" id="newUpdateBtn">
            <i class="fas fa-edit editIcon"></i>
            Add new post
          </button>
        </div>
      </div>
      <!-- Page content loaded from JSON file -->
      <div class="display-updates">
        <div class="updateHeader">
          <div class="IDHeader">Post ID</div>
          <div class="titleHeader">Post Title</div>
          <div class="dateHeader">Post Date</div>
          <div class="deleteHeader">Delete Post</div>
        </div>
      </div>
    </main>
    <div class="confirm-modal-overlay hidden">
      <!-- Confirms if the user wishes to delete the selected post -->
      <div class="confirm-modal" id="deleteModal" hidden>
        <h1>
          <i class="fas fa-exclamation-triangle"></i>
          Warning: You can't undo this action!
        </h1>
        <h2 id="warning-text"></h2>
        <div class="confirm-modal-buttons">
          <button class="btn btn-newsletter" id="yes">OK</button>
          <button class="btn btn-newsletter" id="no">Cancel</button>
        </div>
      </div>
      <!-- Container for new post form -->
      <div class="blogContainer hidden">
        <div class="header">
          <div class="title">
            <h2>Write new post</h2>
          </div>
          <div class="close">
            <h1>
              <i class="fas fa-times" id="closeBtn"></i>
            </h1>
          </div>
        </div>
        <!-- Add new post form -->
        <form
          class="blogPostForm"
          id="blogPostForm"
          action="addPost.php"
          method="post"
          enctype="multipart/form-data"
        >
          <div class="formGroup hidden">
            <input type="hidden" name="postID" id="formPostID" />
          </div>
          <div class="formGroup hidden">
            <input type="hidden" name="postDate" id="postDate" />
          </div>
          <div class="formGroup">
            <label for="postTitle">Post title</label>
            <input type="text" name="postTitle" id="postTitle" />
          </div>
          <div class="formGroup">
            <label for="postContent">Post content</label>
            <textarea name="postContent" id="postContent"></textarea>
          </div>
          <div class="formGroup">
            <label for="postImage">Post image <small>(Optional)</small></label>
            <input type="file" name="postImageFile" id="postImageFile" accept="image/*" />
          </div>
          <div class="formGroup">
            <label for="postLink">Post Link <small>(Optional)</small></label>
            <input type="url" name="postLink" id="postLink" />
          </div>
          <div class="formGroup hidden">
            <input type="hidden" name="postImage" id="postImage" />
          </div>
          <div class="formGroup">
            <button class="addPost" id="addPost">Add post</button>
          </div>
        </form>
      </div>
      <!-- Container for the uploading a newsletter form -->
      <div class="blogContainer hidden" id="newsletterContainer">
        <div class="header">
          <div class="title">
            <h2>Upload newsletter</h2>
          </div>
          <div class="close">
            <h1>
              <i class="fas fa-times" id="closeNewsletterModalBtn"></i>
            </h1>
          </div>
        </div>
        <!-- Add new newsletter form -->
        <form
          class="blogPostForm"
          id="blogUploadForm"
          action="upload-newsletter.php"
          method="post"
          enctype="multipart/form-data"
        >
          <div class="formGroup">
            <label for="postImage">Select file to upload</label>
            <input type="file" name="newsletterToUpload" id="newsletterToUpload" accept=".pdf" />
          </div>
          <div class="formGroup">
            <button class="addPost" id="uploadNewsletter">Upload</button>
          </div>
        </form>
      </div>
      <!-- Confirms if the user wishes to log out -->
      <div class="confirm-modal" id="logOutModal" hidden>
        <h1>
          <i class="fas fa-exclamation-triangle"></i>
          Are you sure you want to log out?
        </h1>
        <div class="confirm-modal-buttons">
          <button class="btn btn-newsletter" id="logOutYes">OK</button>
          <button class="btn btn-newsletter" id="logOutNo">Cancel</button>
        </div>
      </div>
    </div>
    <script src="js/updates.js"></script>
    <script src="../js/backToTop.js"></script>
    <script src="js/formatDate.js"></script>
  </body>
</html>