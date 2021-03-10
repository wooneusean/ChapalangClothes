<?php
include("conn.php");

$username = mysqli_real_escape_string($con, $_POST["username"]);
$password = mysqli_real_escape_string($con, $_POST["password"]);

$password = sha1($password);

$userlogin =
  "SELECT UserId FROM user 
  WHERE Username='$username'AND Password='$password'";
$vendorlogin =
  "SELECT VendorId FROM vendor 
  WHERE Username='$username'AND Password='$password'";
$employeelogin =
  "SELECT EmployeeId FROM employee 
  WHERE Username='$username'AND Password='$password'";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if ($_POST["userrole"] === "member") {

    if ($userresult = mysqli_query($con, $userlogin)) {

      $rowcount = mysqli_num_rows($userresult);
      while ($row = mysqli_fetch_array($userresult)) {
        $userid = $row["UserId"];
      }

      if ($rowcount === 1) {
        session_start();
        $_SESSION["mySession"] = $username;
        $_SESSION["userid"] = $userid;
        header("location:index.php");
      } else {
        echo "<script>
                alert('Username and Password does not match! Please try again.');
                window.location.href = 'loginpage.php'
                </script>";
      }
    }
  } elseif ($_POST["userrole"] === "vendor") {

    if ($vendorresult = mysqli_query($con, $vendorlogin)) {

      $rowcount = mysqli_num_rows($vendorresult);
      while ($row = mysqli_fetch_array($vendorresult)) {
        $vendorid = $row["VendorId"];
      }

      if ($rowcount === 1) {
        session_start();
        $_SESSION["mySession"] = $username;
        $_SESSION["vendorid"] = $vendorid;
        header("location:vendor_profile.php");
      } else {
        echo "<script>
                alert('Username and Password does not match! Please try again.');
                window.location.href = 'loginpage.php'
                </script>";
      }
    }
  } else {

    if ($employeeresult = mysqli_query($con, $employeelogin)) {

      $rowcount = mysqli_num_rows($employeeresult);
      while ($row = mysqli_fetch_array($employeeresult)) {
        $employeeid = $row["EmployeeId"];
      }

      if ($rowcount === 1) {
        session_start();
        $_SESSION["mySession"] = $username;
        $_SESSION["employeeid"] = $employeeid;
        header("location:employee_approval.php");
      } else {
        echo "<script>
                alert('Username and Password does not match! Please try again.');
                window.location.href = 'loginpage.php'
                </script>";
      }
    }
  }
}
