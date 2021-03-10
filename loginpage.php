<?php
session_start();
?>

<!DOCTYPE HTML>
<html>

<head>
    <link rel="shortcut icon" href="images/shirtlogo.png" type="image/x-icon">
    <link href="styles/template.css" type="text/css" rel="stylesheet">
    <link href="styles/khor.css" type="text/css" rel="stylesheet">
    <title>Login Page</title>
</head>

<body class="bg-ruby">
    <div class="center-in-page-abs">
        <div class="login-logo">
            <a href="index.php">
                <img src="images/logo.png" alt="ChapalangClothing">
            </a>
        </div>


        <form action="login.php" method="POST" >
            <div class="login-area container">
                <div class="flex login-header">
                    <div>
                        <h1>Login</h1>
                    </div>
                    <div class="flex login-header-link">
                        <div class="cultured-dark login-pad-top">
                            New To Chapalang? | 
                            <a href="registerpage.php" class="ruby visited-ruby">Sign Up</a>
                        </div>
                    </div>
                </div>

                <div class="p-2">
                    <input type="text" name="username" placeholder="Username" required>
                    <br><br>
                    <input type="password" name="password" placeholder="Password" required>
                    <br><br>
                    <select name="userrole" id="userrole" required>User Role :
                        <option value="" selected disabled>User Role</option>
                        <option value="member">Member</option>
                        <option value="vendor">Vendor</option>
                        <option value="employee">Employee</option>
                    </select>
                    <br><br>
                    <input type="submit" value="LOGIN">
                    <br>
                    <a class="ruby visited-ruby" href="forgotpassword.php">Forgot Password?</a>
                </div>
            </div>
        </form>


    </div>
</body>
<script src="scripts/khor.js"></script>
</html>