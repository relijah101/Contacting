<?php

if(!isset($_POST['contact_id'])){
  header("location: modify.php");
  exit;
}else{
  session_start();
}
//send user to the login form
if(!isset($_SESSION['name'])){
  header("location: index.php");
  exit;
}
$table_name="my_contact";

//import connection;
require_once "conn/connect.php";
require_once "logs.php";

$sql="SELECT * FROM $table_name WHERE id='$_POST[contact_id]' AND user_id='$_SESSION[id]'";
$result=@mysql_query($sql,$con) or die(mysql_error());

while($row=mysql_fetch_array($result)){
    audit(	$_SESSION['id'],"view modified contacts information successful,..");
    $f_name=$row['f_name'];
    $l_name=$row['l_name'];
    $address1=$row['address1'];
    $address2=$row['address2'];
    $address3=$row['address3'];
    $postcode=$row['postcode'];
    $country=$row['country'];
    $prim_tel=$row['prim_tel'];
    $sec_tel=$row['sec_tel'];
    $email=$row['email'];
    $birthday=$row['birthday'];
}

?>
<html>
  <head>
    <title> My Contact Management System: Modfy a Contact</title>
    <script type="text/javascript" src="script/jquery.js"></script>
		<script type="text/javascript" src="script/jquery-ui.js"></script>
		<link rel="stylesheet" href="styles/jquery-ui.min.css"/>
		<link rel="stylesheet" href="styles/mystyle.css"/>
		<script>
      $(function(){
    			$("#button").button();
    	});
    </script>
  </head>
  <body class="ui-widget">
    <h1 class="ui-widget-header">My Contact Management System</h1>
      <h5><a href="administration.php">&laquo; Return to Main Menu</a></h5>
    <h2><em>Modify a Contact</em></h2>
    <FORM METHOD="POST" ACTION="update.php">
      <INPUT TYPE="hidden" name="id" value="<?php echo "$_POST[contact_id]"; ?>">
      <table cellspacing=3 cellpadding=5>
        <tr>
          <th>NAME & ADDRESS INFORMATION</th>
          <th>OTHER CONTACT/PERSONAL INFORMATION</th>
        </tr>
        <tr>
          <td valign=top>
            <p>
              <strong>First Name:</strong><br/>
              <INPUT TYPE="text" NAME="f_name" VALUE="<?php echo $f_name; ?>" SIZE="35" MAXLENGTH="75" pattern="[a-zA-Z]+"/>
            </p>
            <p>
              <strong>last Name:</strong><br>
              <INPUT TYPE="text" NAME="l_name" VALUE="<?php echo $l_name; ?>" SIZE="35" MAXLENGTH="75" pattern="[a-zA-Z]+">
            </p>
            <p>
              <strong>P.O.Box:</strong><br>
              <INPUT TYPE="text" NAME="address1" VALUE="<?php echo $address1;?>" SIZE="35" MAXLENGTH="100" pattern="[0-9]{1,}"></p>
            <p>
              <strong>Region:</strong><br>
              <INPUT TYPE="text" NAME="address2" VALUE="<?php echo $address2;?>" SIZE="35" MAXLENGTH="100" pattern="[a-zA-Z]+"></P>
            <p>
              <strong>District:</strong><br>
              <INPUT TYPE="text" NAME="address3" VALUE="<?php echo $address3;?>" SIZE="35" MAXLENGTH="100" pattern="[a-zA-Z\s]+"></P>
            <p>
                  <strong>Country:</strong><br>
                  <INPUT TYPE="text" NAME="country" VALUE="<?php echo $country;?>" SIZE="35" MAXLENGTH="100" pattern="[a-zA-Z]+"></P>
            <p>
              <strong>Zip Code:</strong><br>
              <INPUT TYPE="text" NAME="postcode" VALUE="<?php echo $postcode;?>" SIZE="35" MAXLENGTH="25" pattern="[+][0-9]{3}"></P>
          </td>
          <td valign=top>
            <p>
              <strong>Primary Telephone Number:</strong><br>
              <INPUT TYPE="text" NAME="prim_tel" VALUE="<?php echo $prim_tel;?>" SIZE="35" MAXLENGTH="35" pattern="[0][0-9]{9}"></P>
            <p>
              <strong>Secondary Telephone Number:</strong><br>
              <INPUT TYPE="text" NAME="sec_tel"VALUE="<?php echo $sec_tel;?>" SIZE="35" MAXLENGTH="35" pattern="[0][0-9]{9}"></P>
            <p>
              <strong>Email Address:</strong><br>
              <INPUT TYPE="text" NAME="email" VALUE="<?php echo $email;?>" SIZE="35" MAXLENGTH="100" pattern="[a-z0-9]+@[a-z]+[.][a-z]{2,3}"></P>
            <p>
              <strong>Birthday(yyyy-mm-dd):</strong><br>
            <INPUT TYPE="text" NAME="birthday" VALUE="<?php echo $birthday;?>" SIZE="10" MAXLENGTH="10" pattern="[0-9]{4}[-][0-9]{1,2}[-][0-9]{1,2}"></P>
          </td>
        </tr>
        <tr>
          <td colspan="2">  <INPUT TYPE="submit" NAME="submit" VALUE="send" id="button"></td>
        </tr>
      </table>
    </form>
  <div id="footer">Copyright &copy; 2018 ER IT Consultants. All Rights Reserved</div>
  </body>
</html>
