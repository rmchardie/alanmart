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
    <title>Upload Newsletter - Alanmart Admin</title>
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

      <?php

        $newsletterToUpload = $_FILES['newsletterToUpload']['name'];
        // check if a file has been selected, if it has, upload it
        if (isset($newsletterToUpload)) {
            $file_name = $_FILES['newsletterToUpload']['name'];
            $file_tmp =$_FILES['newsletterToUpload']['tmp_name'];
            
            if (move_uploaded_file($file_tmp, "../".$file_name)) {
                echo '
                <!-- Container for the display success message -->
            <div class="blogContainer" id="uploadSuccess">
                <div class="successIcon">
                <i class="fas fa-check-to-slot"></i>
                </div>
                <div class="successText">
                Upload successful!
                </div>
                <div class="closeMessage">
                <a href="index.php">
                    <i class="fa-solid fa-circle-arrow-left" style="margin-left: 20px; margin-right: 5px"></i>
                    Go back
                </a>
                </div>
            </div>';
            } else {
                echo '
            <!-- Container for the error in uploading a newsletter form -->
            <div class="blogContainer" id="uploadError">
                <div class="errorIcon">
                <i class="fas fa-file-circle-xmark"></i>
                </div>
                <div class="errorText">
                Something went wrong, try again!
                </div>
                <!-- Add new newsletter form -->
                <form
                class="blogPostForm"
                id="blogReuploadForm"
                action="upload-newsletter.php"
                method="post"
                enctype="multipart/form-data"
                >
                <div class="formGroup">
                    <label for="postImage">Select file to upload</label>
                    <input type="file" name="newsletterToUpload" id="newsletterToUpload" accept=".pdf" />
                </div>
                <div class="formGroup">
                    <button class="addPost" id="reuploadNewsletterBtn">Upload</button>
                </div>
                </form>
            </div>';
            }
        }
        ?>