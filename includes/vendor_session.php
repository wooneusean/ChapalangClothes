<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['vendorid'])) {
  die(header("location:loginpage.php"));
}
