<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Logged out - Alanmart</title>
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
    <link rel="stylesheet" href="css/login.css" />
    <!-- Font Awesome stylesheet -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
    <link rel="shortcut icon" href="../images/favico.png" type="image/x-icon" />
  </head>
  <body>
    <main class="container">
      <a href="index.html" title="Go to Homepage">
        <img src="images/admin-logo.png" alt="Alanmart Admin logo" />
      </a>
      <!-- <h1>Admin Area</h1> -->
      <h3>You have been logged out!</h3>
      Not finished? 
      <button id="logOutBtn">
        Log back in
        <i class="fas fa-sign-in lockIcon"></i>
    </button>
      <a href="../index.html">Back to Homepage</a>
        </div>
      </form>
    </main>
    <script src="js/logout.js"></script>
  </body>
</html>