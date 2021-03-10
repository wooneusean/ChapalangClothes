<?php

include("conn.php");
include_once("includes/database.php");

$user = "INSERT INTO user (Username, Password, Email)
 VALUES ('$_POST[username]',(sha1('$_POST[password]')),'$_POST[email]')";

$vendor = "INSERT INTO vendor (Username, Password, Email)
VALUES ('$_POST[username]',(sha1('$_POST[password]')),'$_POST[email]')";

$username = mysqlidb::fetchRow("SELECT * FROM user WHERE Username = '$_POST[username]'");
$vendorname = mysqlidb::fetchRow("SELECT * FROM vendor WHERE Username = '$_POST[username]'");

$useremail = mysqlidb::fetchRow("SELECT * FROM user WHERE Email = '$_POST[email]'");
$vendoremail = mysqlidb::fetchRow("SELECT * FROM vendor WHERE Email = '$_POST[email]'");


if ($_POST["password"] === $_POST["confirmpassword"]) {

  if ($_POST["userrole"] === "member" && is_null($username) && is_null($useremail)) {

    if (!mysqli_query($con, $user)) {
      die('Error: ' . mysqli_error($con));
    } else {
      echo '<script>
            alert("User has been registered. You will now be redirected to the login page");
            window.location.href = "./loginpage.php"
            </script>';
    }
  } elseif ($_POST["userrole"] === "vendor" && is_null($vendorname) && is_null($vendoremail)) {

    if (!mysqli_query($con, $vendor)) {
      die('Error: ' . mysqli_error($con));
    } else {
      echo '<script>
            alert("User has been registered. You will now be redirected to the login page");
            window.location.href = "./loginpage.php"
            </script>';
    }
  } else {
    echo '<script>
            alert("User with the same Username or Email already exists");
            window.location.href = "./registerpage.php"
            </script>';
  }
} else {
  echo '<script>
    alert("Passwords do not match. Please re-enter the passwords");
    window.location.href = "./registerpage.php"
    </script>';
}
mysqli_close($con);
