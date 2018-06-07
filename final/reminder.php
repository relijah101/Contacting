<?php
session_start();

if(!isset($_SESSION['name'])){
  header("location:index.php");
  exit;
}

$table_name = "reminder";

  require_once "conn/connect.php";

$sql = "SELECT * FROM $table_name WHERE user_id='$_SESSION[id]'";
$result = @mysql_query($sql,$con) or die(mysql_error());

?>

<!DOCTYPE html>
<html>
  <head>
    <title>reminder</title>
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
  </head>
  <body class="ui-widget">
		<h1 class="ui-widget-header">About Reminder</h1>
    <h6><a href="administration.php">&laquo; Return to Main Menu</a></h6>
		<p><strong>My Reminder</strong></p>

    <table cellspacing = "5" style="font-size:15pt; width:100%;" rules = "groups" id="table">
      <thead>
      <tr>
        <th>Date</th>
        <th>Title</th>
        <th>Description</th>
        <th>Status</th>
        <th>Action</th>
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
            if($row['flag'] == '1'){
              echo "Active";
            }else{
              echo "Inactive";
            }
          ?>
        </td>
        <td style="text-align:center;">
          <?php
            if($row['flag'] == '1'){
              echo "<a class='action' href='delete_reminder.php?reminder_id=$row[id]&status=deactivate'>Deactivate</a>";
            }else{
              echo "<a class='action' href='delete_reminder.php?reminder_id=$row[id]&status=activate'>Activate</a>";
            }
          ?>
          <a class='action' href="change_reminder.php?reminder_id=<?php echo $row['id']; ?>">Change</a>
          <a class='action' href="delete_reminder.php?reminder_id=<?php echo $row['id']; ?>&status=delete">Delete</a>
        </td>
      </tr>
      <?php } ?>
    </table>

  	<div class="footer_adm">Copyright &copy; 2018 ER IT Consultants. All Rights Reserved</div>
  </body>
</html>
