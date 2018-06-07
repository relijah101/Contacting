<?php
  //check for required form variable
  if((!isset($_POST['f_name'])) || (!isset($_POST['l_name']))){
    header("location: delete.php");
    exit;
  }else{
    //if form  variable are present, start a session
    session_start();
  }
  //check for validity of user
  if(!isset($_SESSION['name'])){
    header("location: index.php");
    exit;
  }
  //set up table names
  $table_name = "my_contact";
  //connect to server and select database
require_once "conn/connect.php";
//file to sho any changes occur
require_once "logs.php";
//file to clear all bad character
require_once "clean.php";

//$db = @mysql_select_db($db_name, $connectio) or die(mysql_error());
//build and issue query
$sql = "DELETE FROM $table_name WHERE id = '$_POST[id]' AND user_id='$_SESSION[id]'";
$result = @mysql_query($sql, $con) or die(mysql_error());
  audit(	$_SESSION['id'],"deleted to the database successful,..");
?>
<html>
  <head>
    <title>My Contact Management System - Delete Contact </title>
    <script type="text/javascript" src="script/jquery.js"></script>
    <script type="text/javascript" src="script/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="styles/jquery-ui.min.css"/>
    <link rel="stylesheet" href="styles/mystyle.css"/>
  </head>
  <body class="ui-widget">
    <h2 class="ui-widget-header">Delete a Contact - Contact Deleted</h2>
    <p><?php echo "$_POST[f_name] $_POST[l_name]"; ?> has been deleted from <?php echo "$table_name" ;?></p>
    <br><p><a href = "administration.php"> &laquo; Return to Main Menu</a></p>

  <div class="footer_adm">Copyright &copy; 2018 ER IT Consultants. All Rights Reserved</div>
  </body>
</html>
