  <?php
session_start();

if(!isset($_SESSION['name'])){
  header("location:index.php");
  exit;
}

$table_name = "users";

  require_once "conn/connect.php";

$sql = "SELECT * FROM $table_name WHERE id='$_GET[user]'";
$result = @mysql_query($sql,$con) or die(mysql_error());


while($row= mysql_fetch_array($result)){
	$id = $row['id'];
	$first_name = $row['f_name'];
	$last_name = $row['l_name'];
	$phonenumber = $row['phonenumber'];
	$email = $row['email'];
	$username = $row['username'];
	$password = $row['password'];
	$date = $row['date'];
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>user information</title>
    <script type="text/javascript" src="script/jquery.js"></script>
		<script type="text/javascript" src="script/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="styles/jquery-ui.min.css"/>
		<link rel="stylesheet" href="styles/mystyle.css"/>
  </head>
  <body class="ui-widget " style="width:100%;">
    <h1 class="ui-widget-header">User Information</h1>
	 <h5><a href="menu.php">&laquo; Go back</a></h5>
	<table cellspacing = "10" style="font-size:10pt; width: 20%; margin:0px auto;" rules = "groups" id="table">
      <thead>
      <tr>
        <td>id</td>
		<td><?php echo $id; ?></td>
	  </tr>
      <tr>
		<td>First Name</td>
		<td><?php echo $first_name; ?></td>
	  </tr>
      <tr>
		<td> Last Name</td>
		<td><?php echo $last_name; ?></td>
	  </tr>
      <tr>
		<td>Phone Number</td>
		<td><?php echo $phonenumber; ?></td>
	  </tr>
      <tr>
		<td>email </td>
		<td><?php echo $email; ?></td>
	  </tr>
      <tr>
		<td> Username</td>
		<td><?php echo $username; ?> </td>
	  <tr>
      <tr>
		<td>password</td>
		<td><?php echo $password; ?></td>
	  <tr>
    </thead>
 </table>

 <?php
	$table_name = "my_contact";

	$sql = "SELECT * FROM $table_name WHERE user_id='$_GET[user]'";
	$result = @mysql_query($sql,$con) or die(mysql_error());

?>
 <h2 class="ui-widget-header"> Contact <h2>
<table cellspacing = "10" style="font-size:10pt; width:100%;" rules = "groups" id="table">
      <thead>
      <tr>
        <th style="padding-right:30px;">id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>P.O.Box</th>
        <th>Region </th>
        <th>District</th>
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
	<?php
	$table_name = "reminder";

	$sql = "SELECT * FROM $table_name WHERE user_id='$_GET[user]'";
	$result = @mysql_query($sql,$con) or die(mysql_error());

	?>
	 <h2 class="ui-widget-header"> Reminder </h2>
	 <table cellspacing = "5" style="font-size:15pt; width:70%; margin:0px auto" rules = "groups" id="table">
      <thead>
      <tr>
        <th>Date</th>
        <th>Title</th>
        <th>Description</th>
        <th>Status</th>
      </tr>
    </thead>
      <?php
      while($row=mysql_fetch_array($result)){
      ?>
      <tr>
        <td>
          <?php echo $row['date']; ?>
        </td>
        <td>
          <?php echo $row['title']; ?>
        </td>
        <td>
          <?php echo $row['description']; ?>
        </td>
        <td>
          <?php
            if($row['flag'] == 1){
              echo "Active";
            }else{
              echo "Inactive";
            }
          ?>
        </td>
		</tr>
      <?php } ?>
    </table>


  <div id="footer" style="margin-top:20px;">Copyright &copy; 2018 ER IT Consultants. All Rights Reserved</div>
  </body>
</html>
