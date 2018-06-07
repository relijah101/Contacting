<?php
session_start();

//used to check if someone login
if(isset($_SESSION['name']) & !empty($_SESSION['name'])){
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>change user password</title>
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
    <h1 class="ui-widget-header">Change Password</h1>
    <h6><a href="administration.php">&laquo; Return to Main Menu</a></h6>
    <form method="post" action="change_user_pwd.php">
    <table class="table">
      <tr>
        <td>Enter old password:</td>
        <td><input type=password name="old" maxlength=30 pattern="[a-zA-Z0-9 ]{8,}" value= "<?php echo $_POST['old'];?>"></td>
      </tr>
      <tr>
        <td>Enter new password:</td>
        <td><input type=password name="new" maxlength=30 pattern="[a-zA-Z0-9 ]{8,}" value= "<?php echo $_POST['new'];?>"></td>
      </tr>
      <tr>
        <td>Retype new password:</td>
        <td><input type=password name="renew" maxlength=30 pattern="[a-zA-Z0-9 ]{8,}" value= "<?php echo $_POST['new'];?>"></td>
      </tr>
      <tr>
        <td colspan="2" style="padding-top:15px;"><input type="submit" name="submit" value="change" id="button"><br>
          <input type="hidden" name="ab" value="cd"></td>
      </tr>
    </table>
  </form>
    <?php
    //chech if user is coming from a form (value posted == value entered by user kwenye form)
    if($_POST['ab'] == "cd"){
      $error;
      $send;
      if(empty($_POST['old'])){
        $error="*old password field is empty.<br>";
        $send ="no";
      }
      if(empty($_POST['new'])){
        $error .="*new password field is empty.<br>";
        $send ="no";
      }
      if(empty($_POST['renew'])){
        $error .="*retype new password field is empty.<br>";
        $send ="no";
      }
      if($_POST['new'] !=$_POST['renew']){
          $error .="* new passwords do not match, please retype again.<br>";
          $send = "no";
      }
      if($send=="no"){
        echo "<span id=\"error_msg\">$error</span>";

      }else{
      require_once "conn/connect.php";
      require_once "logs.php";
      require_once "clean.php";
      $table_name="users";
      $old_password = $_POST['old'];
      $new_password = $_POST['new'];

       $sql= "SELECT * FROM $table_name WHERE id='$_SESSION[id]' AND password = password(\"$old_password\")";
        $result = @mysql_query($sql,$con) or die(mysql_error());
            if (mysql_num_rows($result)==1){

              $sql="UPDATE $table_name SET password = password(\"$new_password\") WHERE id = '$_SESSION[id]'";
              $res =  @mysql_query($sql,$con) or die(mysql_error());
                audit(	$_SESSION['id'],"user password changer to the database successful,..");
              header('location:index.php');

           }else{
               echo "<span id=error_msg>Wrong old password. Please try again.</span>";
           }
   }
 }

  ?>
<div class="footer_adm"> Copyright &copy; 2018 ER IT Consultants. All Rights Reserved </div>

  </body>
</html>
<?php } ?>
