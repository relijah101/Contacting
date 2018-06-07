<?php
session_start();
require_once "conn/connect.php";

if(isset($_GET['log_id'])){
  $log_id = $_GET['log_id'];
  $qry = "DELETE FROM logs WHERE id = '$log_id'";
  $res =  @mysql_query($qry,$con) or die("Error Occured.".mysql_error());
  header("location: activity.php");
}


$table_name = "logs";
$table = "users";



  $sql = "SELECT users.id as user_id, users.f_name, logs.id as id, logs.activity, logs.time FROM $table_name, $table WHERE $table.id=$table_name.user_id";
  $result = @mysql_query($sql,$con) or die(mysql_error());


?>

<!DOCTYPE html>
<html>
  <head>
    <title>admin</title>
		<script type="text/javascript" src="script/jquery.js"></script>
		<script type="text/javascript" src="script/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="styles/jquery-ui.min.css"/>
		<link rel="stylesheet" href="styles/mystyle.css"/>
    <title>activities</title>
  </head>
  <body class="ui-widget">
    <h1 class="ui-widget-header">Admin</h1>
    <p><strong>Welcome,  Admin</strong></p>
    	<h6><a href="admin.php">&laquo; Go back</a></h6>
	<h2> <p><strong>These are all Activities perfomed in the system</strong></p></h2>
  <table cellspacing = "10" style="font-size:10pt; width:100%;" rules = "groups" id="table">
    <thead>
    <tr>
      <th style="padding-right:30px;">User_Id</th>
      <th>Name</th>
      <th>Activity</th>
      <th>Time</th>
      <th>Action</th>
    </tr>
  </thead>
  <?php
  while($row=mysql_fetch_array($result)){
  ?>
  <tr>
    <td >
      <?php echo $row['user_id']; ?>
    </td>
    <td>
      <?php echo $row['f_name']; ?>
    </td>
    <td>
      <?php echo $row['activity']; ?>
    </td>
    <td>
      <?php echo $row['time']; ?>
    </td>
    <td>
      <a class='action' href="activity.php?log_id=<?php echo $row['id']; ?>">Delete</a>
    </td>
  </tr>
  <?php
 }
 ?>
</table>


  <div class="footer_adm">Copyright &copy; 2018 ER IT Consultants. All Rights Reserved</div>
  </body>
</html>
