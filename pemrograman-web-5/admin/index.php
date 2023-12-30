<?php
  session_start();
  if(!$_SESSION["role"]) {
    header("Location: ../index.php?msg=You Dont Have an Access!");
    die();
  }
  include("sidebar.php");
  $news = "Admin";
?>
