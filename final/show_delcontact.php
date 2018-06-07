<?php
  if(!isset($_POST['id'])){
    header("location: delete.php");
    exit;

  }else {
    session_start();
  }
  if(!isset($_SESSION ['name'])){
    header("location: index.php ");
    exit;
  }

  $table_name = "my_contact";
  // connect to a Server
  require_once "conn/connect.php";
  require_once "logs.php";
  require_once "clean.php";

   //to select all record except ID
   $sql = "SELECT f_name, l_name, address1, address2, address3, postcode, country, prim_tel, sec_tel, email, birthday
          FROM $table_name WHERE id ='$_POST[id]' AND user_id='$_SESSION[id]'";

   $result = @mysql_query($sql, $con) or die(mysql_error());
   while($row = mysql_fetch_array($result)){
       audit(	$_SESSION['id'],"Delete a contact to the database successful,..");
      $f_name = $row['f_name'];
      $l_name = $row['l_name'];
      $address1 = $row['address1'];
      $address2 = $row['address2'];
      $address3 = $row['address3'];
      $country = $row['country'];
      $postcode = $row['postcode'];
      $prim_tel = $row['prim_tel'];
      $sec_tel = $row['sec_tel'];
      $email = $row['email'];
      $birthday = $row['birthday'];
   }
?>
<html>
  <head>
    <title> My Contact Management System: Delete a Contact </title>
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
    <h1 class="ui-widget-header"> My Contact Management System </h1>
      <h5><a href="administration.php">&laquo; Return to Main Menu</a></h5>
    <h2><em> Delete a Contact </em></h2>
    <FORM METHOD = "POST" ACTION = "do_delcontact.php">
      <INPUT TYPE = "hidden" name = "id" value = "<?php echo "$_POST[id]"; ?>" >
        <INPUT TYPE = "hidden" name = "f_name" value = "<?php echo "$f_name"; ?>" >
          <INPUT TYPE = "hidden" name = "l_name" value = "<?php echo "$l_name"; ?>" >
            <table cellspacing = 10 cellpadding = 5 rules = "groups" id="table">
              <thead>
                <tr>
                  <th>NAME & ADDRESS INFORMATION </th>
                  <th>OTHER CONTACT/PERSONAL INFORMATION</th>
                </tr>
              </thead>
              <tr>
                <td valign = top>
                  <p><strong> First Name: </strong><br>
                    <?php echo "$f_name"; ?>
                  <p><strong> Last Name: </strong><br>
                    <?php echo "$l_name"; ?>
                  <p><strong> P.O.Box: </strong><br>
                    <?php echo "$address1"; ?>
                  <p><strong> Region: </strong><br>
                    <?php echo "$address2"; ?>
                  <p><strong> District: </strong><br>
                    <?php echo "$address3"; ?>
                  <p><strong> Country: </strong><br>
                    <?php echo "$country"; ?>
                  <p><strong>Zip Code:  </strong><br>
                    <?php echo "$postcode"; ?>
                </td>
                <td valign = top>
                  <p><strong> Primary Telephone Number: </strong><br>
                    <?php echo "$prim_tel"; ?>
                  <p><strong> secondary Telephone Number: </strong><br>
                    <?php echo "$sec_tel"; ?>
                  <p><strong> E-mail Address: </strong><br>
                    <?php echo "$email"; ?>
                  <p><strong> Birthday (yyyy-mm-dd): </strong><br>
                    <?php echo "$birthday"; ?>
                </td>
              </tr>
              <tr>
                <td align = center colspan = 2><br>
                  <p><INPUT TYPE="SUBMIT" NAME="submit" VALUE = "Delete this Contact" id="button"></p>
                </td>
             </tr>
           </table>
         </FORM>
<div id="footer">Copyright &copy; 2018 ER IT Consultants. All Rights Reserved</div>
  </body>
</html>
