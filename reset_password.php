<?php
include_once "includes/database.php";
include_once "helpers/randompassword.php";

$email = mysqlidb::escape($_POST["email"]);
$userrole = mysqlidb::escape($_POST["userrole"]);
$username = "";
$newpassword = "";

if (strtolower($userrole) == "member") {
  if ($user = mysqlidb::fetchRow("SELECT * FROM user WHERE Email='$email'")) {
    $userid = $user["UserId"];
    $email = $user["Email"];
    $username = $user["Username"];
    $newpassword = random_password();
    mysqlidb::query("UPDATE user SET `Password`=sha1('$newpassword') WHERE UserId=$userid");
  } else {
    echo "<script>alert('User with that email does not exist!'); window.location.href='forgotpassword.php'</script>";
    die();
  }
} else if (strtolower($userrole) == "vendor") {
  if ($vendor = mysqlidb::fetchRow("SELECT * FROM vendor WHERE Email='$email'")) {
    $vendorid = $vendor["VendorId"];
    $email = $vendor["Email"];
    $username = $vendor["Username"];
    $newpassword = random_password();
    mysqlidb::query("UPDATE vendor SET `Password`=sha1('$newpassword') WHERE VendorId=$vendorid");
  } else {
    echo "<script>alert('User with that email does not exist!'); window.location.href='forgotpassword.php'</script>";
    die();
  }
}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

$mail = new PHPMailer(true);

try {
  //Server settings
  $mail->SMTPDebug = 0;                                       // Enable verbose debug output
  $mail->isSMTP();                                            // Send using SMTP
  $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
  $mail->Username   = 'EMAILHERE';              // SMTP username
  $mail->Password   = 'PASSWORDHERE';                          // SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
  $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

  //Recipients
  $mail->setFrom('noreply@chapalang.com.my', 'Chapalang Clothes');
  $mail->addAddress($email);     // Add a recipient

  // Content
  $mail->isHTML(true);
  $mail->Subject = 'Your Chapalang Account: Reset Password';
  $mail->Body = "<h1>You have requested a password reset.</h1>
  <h2>Your username is: <strong>$username</strong></h2>
  <h2>Your new password is: <strong>$newpassword</strong></h2>";

  $mail->send();

  echo "<script>alert('Successfully sent email!'); window.location.href='loginpage.php'</script>";
  die();
} catch (Exception $e) {
  echo "<script>alert('Failed to send email!'); window.location.href='forgotpassword.php'</script>";
  die();
}
