<!DOCTYPE HTML>
<html>

<head>
  <link rel="shortcut icon" href="images/shirtlogo.png" type="image/x-icon">
  <link href="styles/template.css" type="text/css" rel="stylesheet">
  <link href="styles/khor.css" type="text/css" rel="stylesheet">
  <title>Sign Up Page</title>
</head>

<body class="bg-ruby">

  <div class="center-in-page-abs">
    <div class="login-logo">
      <a href="index.php">
        <img src="images/logo.png" alt="ChapalangClothing">
      </a>
    </div>


    <form action="register.php" method="POST" name="register">
      <div class="login-area container">
        <div class="flex login-header">
          <div>
            <h1>Sign Up</h1>
          </div>
          <div class="flex login-header-link">
            <div class="cultured-dark login-pad-top">
              Already have an account? | <a href="loginpage.php" class="ruby visited-ruby">Login</a>
            </div>
          </div>
        </div>

        <div class="p-2">
          <input type="text" name="username" placeholder="Username" required>
          <br><br>
          <input type="email" name="email" placeholder="E-Mail" required onblur="return validateEmail()">
          <span class="error hidden" id="emailerror"></span>
          <br><br>
          <input type="password" name="password" id="pass" placeholder="Password" required>
          <br><br>
          <input type="password" name="confirmpassword" id="passcfm" placeholder="Confirm Password" required onblur="return valpassword()">
          <span class="error hidden" id="passerror"></span>
          <br><br>
          <select name="userrole" id="userrole" required>User Role :
            <option value="" selected disabled>User Role</option>
            <option value="member">Member</option>
            <option value="vendor">Vendor</option>
          </select>
          <br><br>
          <input type="submit" value="SIGN UP">
        </div>
      </div>
    </form>


  </div>
</body>
<script src="scripts/khor.js"></script>

</html>