<?php
session_start();

if(!isset($_SESSION['name'])){
  header("location:index.php");
  exit;
}

if(!isset($_GET['reminder_id'])){
  header("location:reminder.php");
  exit;
}

if(!isset($_GET['status'])){
  header("location:reminder.php");
  exit;
}

$table_name = "reminder";

require_once "conn/connect.php";
require_once "logs.php";
require_once "clean.php";

if($_GET['status'] == "activate"){
  $query= "UPDATE reminder SET flag= '1' WHERE id='$_GET[reminder_id]'";
      $result= mysql_query($query);
//used to show output after update of data
  if($result){
      audit(	$_SESSION['id'],"reminder deleted to the database successful,..");
    header("location:reminder.php");
  }
}else if($_GET['status'] == "deactivate"){
  $query= "UPDATE reminder SET flag= '0' WHERE id='$_GET[reminder_id]'";
      $result= mysql_query($query);
//used to show output after update of data
  if($result){
    header("location:reminder.php");
  }
}else if($_GET['status'] == "delete"){
  $query= "DELETE FROM reminder WHERE id='$_GET[reminder_id]'";
      $result= mysql_query($query);
//used to show output after update of data
  if($result){
    header("location:reminder.php");
  }
}
?>
