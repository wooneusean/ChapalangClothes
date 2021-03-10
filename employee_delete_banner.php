<?php
include("includes/employee_session.php");
include_once("includes/database.php");

if (isset($_GET["bannerid"])) {
  $bannerId = mysqlidb::escape($_GET["bannerid"]);
  $sql = "DELETE FROM banner WHERE BannerId=$bannerId";
  try {
    mysqlidb::query($sql);
  } catch (\Throwable $th) {
    die(header("Location:employee_banner.php?error=true"));
  }
  if (mysqlidb::getAffectedRows() > 0) {
    die(header("Location:employee_banner.php?success=true"));
  } else {
    die(header("Location:employee_banner.php?error=true"));
  }
}
