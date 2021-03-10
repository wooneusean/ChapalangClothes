<?php
include "includes/sessioncheck.php";
$oldPassword = $_POST["password"];
$newPassword = $_POST["newpassword"];
$userId = $_SESSION["userid"];

include_once "includes/database.php";

if (mysqlidb::checkRecordExists("SELECT * FROM user WHERE UserId=$userId AND `Password`=sha1('$oldPassword')")) {
  if ($newPassword != $oldPassword) {
    if (!mysqlidb::query("UPDATE user SET `Password`=sha1('$newPassword') WHERE UserId=$userId")) {
      die(header("Location:user_profile.php?message=error"));
    } else {
      die(header("Location:user_profile.php?message=ok_password#change-password"));
    }
  } else {
    die(header("Location:user_profile.php?message=same_password#change-password"));
  }
} else {
  die(header("Location:user_profile.php?message=wrong_password#change-password"));
}
