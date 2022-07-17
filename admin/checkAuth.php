<?php
// Create new session
session_start();

// Create variables for entered code and authorisation code
$enteredCode = $_POST["authCode"];
$authCode = "Alanmart2013";
$sessionCode;

// Check to see if both codes match, if they do, create session variable
if (isset($enteredCode)) {
    if ($enteredCode == $authCode) {
        $_SESSION["authCode"] = $enteredCode;
        $sessionCode = $_SESSION["authCode"];
    }
}

// Check if session variable is set, if it is, grant access to admin page
if (isset($sessionCode)) {
    header("Location: index.php");
    exit();
} else {
    echo '
    <!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login - Alanmart</title>
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
      <form action="checkAuth.php" id="loginForm" method="post">
        <label for="authCode" class="invalidCode">
        <i class="fas fa-warning lockIcon"></i>
        Incorrect code entered.
        <p>Try again!</p>
        </label>
        <div class="formGroup">
          <input type="password" name="authCode" id="authCode" autofocus />
          <p id="emptyInput">
            <i class="fas fa-warning lockIcon"></i>
            Please enter an authorisation code!
          </p>
          <button type="submit">
            <i class="fas fa-lock lockIcon"></i>
            Login
          </button>
        </div>
      </form>
    </main>
    <script src="js/login.js"></script>
  </body>
</html>';
}
?>