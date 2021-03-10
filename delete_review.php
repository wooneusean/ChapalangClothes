<?php
include "includes/employee_session.php";

if (isset($_GET["id"]) && isset($_SESSION["employeeid"])) {
  include("includes/database.php");

  $reviewId = $_GET["id"];

  $sql = "DELETE FROM review WHERE ReviewId=$reviewId";

  try {
    mysqlidb::query($sql);
  } catch (\Throwable $th) {
    echo "<script>
    alert('Failed to delete review.');
    window.location.href = 'index.php';
    </script>";
  }

  echo "<script>
    alert('Successfully deleted review.');
    window.location.href = 'index.php';
    </script>";
}
