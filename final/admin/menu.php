<?php
session_start();
 ?>
<!DOCTYPE html>
<html>
  <head>
    <title>menu</title>
    <title>admin</title>
		<script type="text/javascript" src="script/jquery.js"></script>
		<script type="text/javascript" src="script/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="styles/jquery-ui.min.css"/>
		<link rel="stylesheet" href="styles/mystyle.css"/>
		<style>
		  .action{
			font-size: 10pt;
			text-align: center;
			font-style: italic;
			padding: .1em .6em;
		  }
		</style>
		<script>
			$(function(){
				$("#menu1").menu();
        $("#menu2").menu();

			});
		</script>
  </head>
  <body class="ui-widget">
    <h1 class="ui-widget-header">Admin</h1>
    <p><strong>Welcome,  Admin</strong></p>



    <p><strong>Management</strong></p>
 		<ul id="menu1" class="ui-menu">
       <li><a href="admin.php"> View Active Users</a></li>
       <li><a href="block.php"> View blocked users</a></li>
       <li><a href="report.php"> View Report of activities</a></li>
       <li><a href="activity.php">View All Activities Perfomed </a></li>
       <li><a href="change_pwd.php">Change Password</a></li>
 		</ul>
    <p><strong>Leave</strong></p>
 		<ul id="menu2" class="ui-menu">
 			<li><a href="logout_admin.php">Logout</a></li>
 		</ul>


<div class="footer_adm">Copyright &copy; 2018 ER IT Consultants. All Rights Reserved</div>
  </body>
</html>
