<?php
session_start();

if(!isset($_SESSION['name'])){
  header("location:../index.php");
  exit;
}

$table_name = "users";

  require_once "conn/connect.php";

  $query="UPDATE $table_name SET status='1' WHERE id='$_GET[id]'";
  $result= mysql_query($query) or die('ERROR');

$sql = "SELECT * FROM $table_name WHERE role='user' and status='1'";
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
    <h6><a href="menu.php">&laquo; Go back</a></h6>
	   <h2> <p><strong>These are all users who registered in the system</strong></p></h2>
	    <table cellspacing = "10" style="font-size:10pt; width:100%;" rules = "groups" id="table">
        <thead>
        <tr>
          <th style="width:3%">id</th>
          <th style="width:15%">First Name</th>
          <th style="width:15%"> Last Name</th>
          <th style="width:15%">Phone Number</th>
          <th style="width:10%">email </th>
          <th style="width:10%"> Username</th>
          <th style="width:15%">Date</th>
  		    <th style="width:17%">Action</th>
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
          <?php echo $row['phonenumber']; ?>
        </td>
        <td>
          <?php echo $row['email']; ?>
        </td>
        <td>
          <?php echo $row['username']; ?>
        </td>
        <td>
          <?php echo $row['date']; ?>
        </td>
		 <td style="text-align:center;">

          <a class='action' href="userinfo.php?user=<?php echo $row['id']; ?>">View</a>
          <a class='action' href="block.php?id=<?php echo $row['id']; ?>"> Block</a>
      </tr>

      </tr>
      <?php
     }
     ?>

   </table>

    <div class="footer_adm">Copyright &copy; 2018 ER IT Consultants. All Rights Reserved</div>
  </body>
</html>
