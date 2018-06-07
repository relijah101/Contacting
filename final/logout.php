<?php
  session_start();
  unset($_SESSION['name']);
  unset($_SESSION['id']);
  require_once "conn/connect.php";
  require_once "logs.php";
  session_destroy();
    audit(	$_SESSION['id'],"logout to the system successful,..");
  header("location:index.php");
 ?>
