<?php
  //start a session
  session_start();

  //check validity of user
  if(!isset($_SESSION['name'])){
    header("location: index.php");
    exit;
  }
?>
<html>
  <head>
    <title>My Contact Management System</title>
    <script type="text/javascript" src="script/jquery.js"></script>
    <script type="text/javascript" src="script/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="styles/jquery-ui.css"/>
    <link rel="stylesheet" href="styles/mystyle.css"/>
    <script>
    	$(function(){
    			$("#button").button();
    	});
    </script>
  </head>
  <body class="ui-widget">
    <h2 class="ui-widget-header">Modify a contact - Select from List</h2>
    <p><h6><a href="administration.php">&laquo; Go back</a></h6></p>
    <p>Select a contact from the list below, to modfy the contact's record. </p>
    <form method="post" action="show_modcontact.php" >
      <table  style="width:40%; margin: 0px auto;">
        <tr>
          <td>Select </td>
          <td>Contact:</td>
          <td>
            <select class="select" name="contact_id" id="select">
              <?php
                //import connection;
                require_once "conn/connect.php";
                require_once "logs.php";
                require_once "clean.php";

                //build an issuequery
                $sql = "SELECT id, f_name, l_name FROM my_contact WHERE user_id='$_SESSION[id]' ORDER BY l_name";
                $result = @mysql_query($sql,$con) or die(mysql_error());

                //check number of result
                $num = @mysql_num_rows($result);

                if($num<1){
                  //if no result, display message
                  echo "<p id='error'><em>Sorry! No results.</em></p>";
                }else{
                  //if result are found, loop through theme
                  //and make a form selection block
                  while($row=mysql_fetch_array($result)){
                      audit(	$_SESSION['id'],"Contact is modified to the database successful,..");
              ?>
                <option value="<?php echo $row['id']; ?>">  <?php echo $row['l_name'].", ".$row['f_name']; ?>   </option>
              <?php
                  }
                }
               ?>
            </select>
          </td>
          <td>
            <input type="submit" name="submit" value="Select" id="button">
          </td>
          </tr>
        </table>
    </form>


    <div class="footer_adm">Copyright &copy; 2018 ER IT Consultants. All Rights Reserved</div>
  </body>
</html>
