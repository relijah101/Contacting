<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>reset</title>
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
  		<h1 class="ui-widget-header">Reset your password</h1>
      <h2><p>Write the phone number that used in registration</p></h2>
  		<form method="post" action="forget_password.php">
  			<table class="login_table" style="width:40%; margin: 0px auto;">
  				<tr>
  					<td><strong>Enter Phone number: </strong></td>
  					<td><input type="text" name="phonenumber" size="15" maxlength="30" pattern="[0][0-9]{9}"></td>
  				</tr>
          <tr>
  					<td colspan="2" style="padding-top:15px;"><input type="submit" name="submit" value="check number" id="button"></td><br>
  						<input type="hidden" name="qw" value="er"></td>
  					</tr>
        </table>
      </form>
        <?php
          //chech if user is coming from a form (value posted == value entered by user kwenye form)
          if($_POST['qw'] == "er"){
            $error;
            $send;
            if(empty($_POST['phonenumber'])){
              $error="*phonenumber field  is empty.<br>";
              $send ="no";
            }
            if($send=="no"){
              echo "<span id=\"error_msg\">$error</span>";
              }else{
                $number = $_POST['phonenumber'];
                require_once "conn/connect.php";
                require_once "logs.php";
                require_once "clean.php";

                $sql = mysql_query("SELECT * FROM users WHERE phonenumber ='$number'");
                $num = mysql_num_rows($sql);
                if($num == 1) {
                     while($row = mysql_fetch_array($sql)){
                      $userid = $row['id'];
                    }
                    // if number entered is available in a database go to the page of create new password
                    $_SESSION['User_Id'] = $userid;
                      audit(	$_SESSION['id'],"Correct phone number is posted to the database successful,..");
                    header("location:register_new_pswd.php");
                }else{
                  echo "***Supplied phone number doesn’t exist  in our system try another one";
                }

            }
          }

        ?>
        <div class="footer_adm"> Copyright &copy; 2018 ER IT Consultants. All Rights Reserved </div>
      </body>
</html>
