<?php
include("includes/employee_session.php");

if (isset($_POST['bannername']) && isset($_POST['bannerdesc'])) {

  if (
    !isset($_FILES['bannerimage']['error']) ||
    is_array($_FILES['bannerimage']['error'])
  ) {
    die(header("Location:employee_banner.php?error=true"));
  }

  $imageUrl = "";
  if ($_FILES['bannerimage']['error'] !== UPLOAD_ERR_NO_FILE) {
    try {
      // DO NOT TRUST $_FILES['picture']['mime'] VALUE !!
      // Check MIME Type by yourself.
      $finfo = new finfo(FILEINFO_MIME_TYPE);
      if (false === $ext = array_search(
        $finfo->file($_FILES['bannerimage']['tmp_name']),
        array(
          'jpg' => 'image/jpeg',
          'png' => 'image/png',
          'gif' => 'image/gif',
        ),
        true
      )) {
        die(header("Location:employee_banner.php?error=true"));
      }

      // You should name it uniquely.
      // DO NOT USE $_FILES['picture']['name'] WITHOUT ANY VALIDATION !!
      // On this example, obtain safe unique name from its binary data.
      if (!move_uploaded_file(
        $_FILES['bannerimage']['tmp_name'],
        $imageUrl = sprintf(
          'images/banners/%s.%s',
          sha1_file($_FILES['bannerimage']['tmp_name']),
          $ext
        )
      )) {
        die(header("Location:employee_banner.php?error=true"));
      }
    } catch (RuntimeException $e) {
      die(header("Location:employee_banner.php?error=true"));
    }
  } else {
    die(header("Location:employee_banner.php?error=true"));
  }

  if (!empty($_POST['bannername']) && !empty($_POST['bannerdesc'])) {
    try {
      include_once("includes/database.php");
      $bannerName = mysqlidb::escape($_POST['bannername']);
      $bannerDesc = mysqlidb::escape($_POST['bannerdesc']);
      $sql = "INSERT INTO banner (BannerName,BannerDescription,BannerImage) VALUES('$bannerName','$bannerDesc','$imageUrl')";
      try {
        mysqlidb::query($sql);
      } catch (\Throwable $th) {
        die(header("Location:employee_banner.php?error=true"));
      }
      die(header("Location:employee_banner.php?success=true"));
    } catch (\Throwable $th) {
      die(header("Location:employee_banner.php?error=true"));
    }
  } else {
    die(header("Location:employee_banner.php?error=true"));
  }
}
