<?php
session_start();

require_once "conn/connect.php";

$table="my_contact";
$table_name="users";
$t_name="reminder";
$sql="SELECT count(*) as total FROM $table";
$result=mysql_query($sql) or die(mysql_error());

while($row=mysql_fetch_array($result)){
  $count=$row['total'];

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>report</title>
    <script type="text/javascript" src="script/jquery.js"></script>
		<script type="text/javascript" src="script/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="styles/jquery-ui.min.css"/>
		<link rel="stylesheet" href="styles/mystyle.css"/>
  </head>
  <body class="ui-widget">
    <h1 class="ui-widget-header">Report</h1>
      <h6><a href="menu.php">&laquo; Go back</a></h6>
    <p><strong>Report of system</strong></p>


<div class="footer_adm">Copyright &copy; 2018 ER IT Consultants. All Rights Reserved</div>
<?php
echo "total contacts is: $count";
}
 ?>
  </body>
</html>
