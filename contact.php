<?php
if (
  isset($_POST["name"]) &&
  isset($_POST["email"]) &&
  isset($_POST["message"])
) {
  include("includes/database.php");

  $sql = "INSERT INTO feedback (`FeedbackName`, `FeedbackEmail`, `FeedbackMessage`) VALUES ('$_POST[name]', '$_POST[email]', '$_POST[message]')";

  try {
    mysqlidb::query($sql);
  } catch (\Throwable $th) {
    echo "<script>
    alert('Error: Message failed to be sent.');
    window.location.href = 'index.php';
    </script>";
  }

  echo "<script>
    alert('Message successfully sent!');
    window.location.href = 'index.php';
    </script>";
}
