<?php
include "includes/sessioncheck.php";

$email = $_POST['email'];
$gender = $_POST['gender'];
$dob = date('Y-m-d', strtotime($_POST['dob']));
$address = $_POST['address'];
$imageUrl = "";
$imageQuery = "";
$userId = $_SESSION["userid"];

if (
  !preg_match('/^[a-zA-Z0-9.!#$%&’*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/', $email)
  || empty($gender) || (strtotime($_POST['dob']) > time()) || empty($address)
) {
  die(header("Location:user_profile.php?message=error"));
}

// https://www.php.net/manual/en/features.file-upload.php - upload image

// Undefined | Multiple Files | $_FILES Corruption Attack
// If this request falls under any of them, treat it invalid.
if (
  !isset($_FILES['picture']['error']) ||
  is_array($_FILES['picture']['error'])
) {
  die(header("Location:user_profile.php?message=error"));
}

if ($_FILES['picture']['error'] !== UPLOAD_ERR_NO_FILE) {
  try {
    // DO NOT TRUST $_FILES['picture']['mime'] VALUE !!
    // Check MIME Type by yourself.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
      $finfo->file($_FILES['picture']['tmp_name']),
      array(
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
      ),
      true
    )) {
      die(header("Location:user_profile.php?message=error"));
    }

    // You should name it uniquely.
    // DO NOT USE $_FILES['picture']['name'] WITHOUT ANY VALIDATION !!
    // On this example, obtain safe unique name from its binary data.
    if (!move_uploaded_file(
      $_FILES['picture']['tmp_name'],
      $imageUrl = sprintf(
        'images/users/%s.%s',
        sha1_file($_FILES['picture']['tmp_name']),
        $ext
      )
    )) {
      die(header("Location:user_profile.php?message=error"));
    }
    $imageQuery = "UserImage='$imageUrl',";
  } catch (RuntimeException $e) {
    die(header("Location:user_profile.php?message=error"));
  }
}

include_once "includes/database.php";

$email_esc = mysqlidb::escape($email);
$gender_esc = mysqlidb::escape($gender);
$address_esc = mysqlidb::escape($address);

mysqlidb::query("UPDATE user SET $imageQuery Email='$email_esc',Gender='$gender_esc',DOB='$dob',Address='$address_esc' WHERE UserId = $userId");

die(header("Location: user_profile.php?message=edited"));
