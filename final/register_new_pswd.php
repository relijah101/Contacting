<?php
session_start();

//used to check if someone login

 ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Recover</title>
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
    <h1 class="ui-widget-header">Recover your password</h1>
    <h6><a href="index.php">&laquo; Return to Main Menu</a></h6>
    <form method="post" action="register_new_pswd.php">
    <table class="table">
      <tr>
        <td>Enter new password:</td>
        <td><input type=password name="new" maxlength=30 pattern="[a-zA-Z0-9 ]{8,}" value= "<?php echo $_POST['new'];?>"></td>
      </tr>
      <tr>
        <td>Retype password:</td>
        <td><input type=password name="renew" maxlength=30 pattern="[a-zA-Z0-9 ]{8,}" value= "<?php echo $_POST['renew'];?>"></td>
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
      $Password   = $_POST['new'];
      $Password_2 = $_POST['renew'];
      $error;
      $send;
      if(empty($_POST['new'])){
        $error="*new password field is empty.<br>";
        $send ="no";
      }
      if(empty($_POST['renew'])){
        $error .="*retype password field is empty.<br>";
        $send ="no";
      }
      if($Password != $Password_2){
        $error .= "Passwords do not match!";
        $send ="no";
      }
      if($send=="no"){
        echo "<span id=\"error_msg\">$error</span>";
      }else{
        require_once "conn/connect.php";
        require_once "logs.php";
        require_once "clean.php";

        $userId  = $_SESSION['User_Id'];
        $sql = "UPDATE users SET password = password(\"$Password\") WHERE id ='$userId'";
        $update = mysql_query($sql, $con) or die("Error In Changing Password".mysql_error());
        audit(	$_SESSION['id'],"Password is changed successful,..");
        header("location:index.php");
     }
  }
  ?>

<div class="footer_adm"> Copyright &copy; 2018 ER IT Consultants. All Rights Reserved </div>

  </body>
</html>
