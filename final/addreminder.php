<?php
  session_start();
  //used to check if someone login
  if(isset($_SESSION['name']) & !empty($_SESSION['name'])){
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
      <form method="post" action="addreminder.php">
      <table class="table">
        <tr>
          <tr>
          <td>Date :</td>
          <td><input type=text name="date" maxlength=30 pattern="[0-9]{4}[-][0-9]{1,2}[-][0-9]{1,2}" value= "<?php echo $_POST[date];?>"></td>
        </tr>
        <tr>
          <td>Title :</td>
          <td><input type=text name="title" maxlength=30 pattern="[a-zA-Z]+" value= "<?php echo $_POST[title];?>"></td>
        </tr>
        <tr>
          <td valign="top">Description: </td>
          <td><textarea name="description" rows="3" cols="40"></textarea></td>
        </tr>
        <tr>
					<td colspan="2" style="padding-top:15px;"><input type="submit" name="Add" value="Submit" id="button" class=""></td>
				</tr>
        </table>

        <input type="hidden" name="am" value="pm">
      </form>
  <?php
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
  //used to insert data into my contact table
      $query= "INSERT INTO reminder (id, user_id, date, title, description) VALUES ('','$_SESSION[id]', '$date', '$title', '$description')";
          $result= mysql_query($query);
 //used to show output after insert of data
    	if($result){
        audit(	$_SESSION['id'],"add reminder to the database successful,..");
      	header("location:reminder.php");
      }
        else {
            echo "Unsuccessful.<br/>".mysql_error();

        }
    }
  }
  ?>
  <div class="footer_adm">Copyright &copy; 2018 ER IT Consultants. All Rights Reserved</div>
    </body>
</html>
<?php } ?>
