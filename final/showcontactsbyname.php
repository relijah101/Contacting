<?php
session_start();

if(!isset($_SESSION['name'])){
  header("location:index.php");
  exit;
}

$table_name = "my_contact";

  require_once "conn/connect.php";

$sql = "SELECT * FROM $table_name WHERE user_id='$_SESSION[id]' ORDER BY f_name ASC";
$result = @mysql_query($sql,$con) or die(mysql_error());

?>
<!DOCTYPE html>
<html>
  <head>
    <title>show contact by name</title>
    <script type="text/javascript" src="script/jquery.js"></script>
		<script type="text/javascript" src="script/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="styles/jquery-ui.min.css"/>
		<link rel="stylesheet" href="styles/mystyle.css"/>
  </head>
  <body class="ui-widget" style="width:100%;">
    <h1 class="ui-widget-header">Show Contact Order by Name </h1>
      <h5><a href="administration.php">&laquo; Return to Main Menu</a></h5>
    <table cellspacing = "10" style="font-size:10pt; width:100%;" rules = "groups" id="table">
      <thead>
      <tr>
        <th style="padding-right:30px;">id</th>
        <th>First Name</th>
        <th> Last Name</th>
        <th>P.O.Box</th>
        <th>Region </th>
        <th>  District</th>
        <th>Country</th>
        <th>Zip Code</th>
        <th>Primary phone No</th>
        <th>secondary phone No</th>
        <th>Email</th>
        <th>Birthday</th>

      </tr>
    </thead>
      <?php
      while($row=mysql_fetch_array($result)){
      ?>
      <tr>
        <td >
          <?php echo $row['id']; ?>
        </td>
        <td>
          <?php echo $row['f_name']; ?>
        </td>
        <td>
          <?php echo $row['l_name']; ?>
        </td>
        <td>
          <?php echo $row['address1']; ?>
        </td>
        <td>
          <?php echo $row['address2']; ?>
        </td>
        <td>
          <?php echo $row['address3']; ?>
        </td>
        <td>
          <?php echo $row['country']; ?>
        </td>
        <td>
          <?php echo $row['postcode']; ?>
        </td>
        <td>
          <?php echo $row['prim_tel']; ?>
        </td>
        <td>
          <?php echo $row['sec_tel']; ?>
        </td>
        <td>
          <?php echo $row['email']; ?>
        </td>
        <td>
          <?php echo $row['birthday']; ?>
        </td>

      </tr>
      <?php
     }
     ?>
   </table>
<div id="footer" style="margin-top:20px;">Copyright &copy; 2018 ER IT Consultants. All Rights Reserved</div>
  </body>
</html>
