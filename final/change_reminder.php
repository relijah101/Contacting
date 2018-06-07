<?php
  session_start();
  //used to check if someone login
  if(!isset($_SESSION['name'])){
    header("location: index.php");
  }
  require_once "conn/connect.php";

    //used to compare name entered is equal to the value assigned
    if($_POST['am'] == "pm"){
          $error;
          $send;
    //used to check if all fields are filled
        if(empty($_POST['date'])){
            $error .="*Date field is empty</br>";
            $send ="no";
          }
          if(empty($_POST['title'])){
            $error .="*Title field is empty</br>";
            $send ="no";
          }
          if(empty($_POST['description'])){
            $error .="*Description field is empty</br>";
            $send ="no";
          }
          if($send=="no"){
    				echo "<span id='error'>$error</span>";
    			}
          else{
    //use conn file to excute these code
                require_once "conn/connect.php";
                require_once "logs.php";
                require_once "clean.php";
                $date= clean_input($_POST['date']);
                $title= clean_input($_POST['title']);
                $description= clean_input($_POST['description']);
    //used to update data into my contact table
        $query= "UPDATE reminder SET date='$date', title='$title', description='$description' WHERE id='$_GET[reminder_id]'";
            $result= mysql_query($query);
   //used to show output after update of data
      	if($result){
            audit(	$_SESSION['id'],"reminder changed to the database successful,..");
        	header("location:reminder.php");
        }
          else {
              echo "Unsuccessful.<br/>".mysql_error();

          }
      }
    }

    $sql="SELECT * FROM reminder WHERE id='$_GET[reminder_id]'";
    $result=@mysql_query($sql,$con) or die(mysql_error());

    while($row=mysql_fetch_array($result)){
      $id=$row['id'];
      $date=$row['date'];
      $title=$row['title'];
      $description=$row['description'];
    }
?>
<html>
  <head>
    <title>add reminder</title>
    <script type="text/javascript" src="script/jquery.js"></script>
    <script type="text/javascript" src="script/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="styles/jquery-ui.min.css"/>
    <link rel="stylesheet" href="styles/mystyle.css"/>
    <script>
    	$(function(){
    $("#button").button();
    });
    </script>
  </head>
    <body class="ui-widget">
  		<h1 class="ui-widget-header">Add Reminder</h1>
      <h6><a href="administration.php">&laquo; Return to Main Menu</a></h6>
  		<p><strong>My Reminder</strong></p>
      <form method="post" action="change_reminder.php?reminder_id=<?php echo $_GET['reminder_id']; ?>">
      <table class="table">
        <tr>
          <tr>
          <td>Date :</td>
          <td><input type=text name="date" maxlength=30 pattern="[0-9]{4}[-][0-9]{1,2}[-][0-9]{1,2}" value= "<?php echo $date; ?>"></td>
        </tr>
        <tr>
          <td>Title :</td>
          <td><input type=text name="title" maxlength=30 pattern="[a-zA-Z]+" value= "<?php echo $title;?>"></td>
        </tr>
        <tr>
          <td valign="top">Description: </td>
          <td><textarea name="description" rows="3" cols="40"><?php echo $description;?></textarea></td>
        </tr>
        <tr>
					<td colspan="2" style="padding-top:15px;"><input type="submit" name="Add" value="Change" id="button" class=""></td>
				</tr>
        </table>

        <input type="hidden" name="am" value="pm">
      </form>
  <div class="footer_adm">Copyright &copy; 2018 ER IT Consultants. All Rights Reserved</div>
    </body>
</html>
