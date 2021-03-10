<!DOCTYPE HTML>
<html>

<head>
  <link rel="shortcut icon" href="images/shirtlogo.png" type="image/x-icon">
  <link href="styles/template.css" type="text/css" rel="stylesheet">
  <link href="styles/khor.css" type="text/css" rel="stylesheet">
  <title>Forgot Password Page</title>
</head>

<body class="bg-ruby">

  <div class="center-in-page-abs">
    <div class="login-logo">
      <a href="index.php">
        <img src="images/logo.png" alt="ChapalangClothing">
      </a>
    </div>


    <form action="reset_password.php" method="POST">
      <div class="login-area container">
        <div class="flex login-header">
          <div>
            <h1>Forgot Password?</h1>
          </div>
          <div class="flex login-header-link">
            <div class="cultured-dark login-pad-top">
              Already have an account? | <a href="loginpage.php" class="ruby visited-ruby">Login</a>
            </div>
          </div>
        </div>

        <div class="p-2">
          <h3>Please enter your email here</h3>
          <input type="email" name="email" placeholder="E-Mail" required>
          <br><br>
          <select name="userrole" id="userrole" required>User Role :
            <option value="" selected disabled>User Role</option>
            <option value="member">Member</option>
            <option value="vendor">Vendor</option>
          </select>
          <br><br>
          <input type="submit" value="SEND E-MAIL">
        </div>
      </div>
    </form>


  </div>
</body>
<script src="scripts/khor.js"></script>

</html>