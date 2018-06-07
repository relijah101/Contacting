<?php
if(!isset($_POST['id'])){
  header("location: modify.php");
  exit;
}else{
  session_start();
}
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
</head>
<body class="ui-widget">
  <h2 class="ui-widget-header">Modify a contact - ERROR</h2>
<?php
//used to compare name entered is equal to the value assigned
if(isset($_POST['submit'])){
  $error;
  $send;
//used to check if all fields are filled
  if(empty($_POST['f_name'])){
    $error .="*Firstname field is empty</br>";
    $send ="no";
  }
  if(empty($_POST['l_name'])){
    $error .="*Lastname field is empty</br>";
    $send ="no";
  }
  if(empty($_POST['address1'])){
    $error .="*P.O.Box field is empty</br>";
    $send ="no";
  }
  if(empty($_POST['address2'])){
    $error .="*Region field is empty</br>";
    $send ="no";
  }
  if(empty($_POST['address3'])){
    $error .="*District field is empty</br>";
    $send ="no";
  }
  if(empty($_POST['postcode'])){
    $error .="*Zipcode field is empty</br>";
    $send ="no";
  }
  if(empty($_POST['country'])){
    $error .="*Country field is empty</br>";
    $send ="no";
  }
  if(empty($_POST['prim_tel'])){
    $error .="*Primary tel field is empty</br>";
    $send ="no";
  }
  if(empty($_POST['email'])){
    $error .="*Email field is empty</br>";
    $send ="no";
  }
  if(empty($_POST['birthday'])){
    $error .="*Birthday field is empty</br>";
    $send ="no";
  }
  if($send=="no"){
    echo "<p id='error_msg'>$error.<br/><h6><a href='show_modcontact.php'>&laquo; Go back</a></h6></p>";
  }
  else{
//use conn file to excute these code
        require_once "conn/connect.php";
        require_once "clean.php";
        require_once "logs.php";
        $firstname= clean_input($_POST['f_name']);
        $lastname= clean_input($_POST['l_name']);
        $address1= clean_input($_POST['address1']);
        $address2= clean_input($_POST['address2']);
        $address3= clean_input($_POST['address3']);
        $postcode= clean_input($_POST['postcode']);
        $country= clean_input($_POST['country']);
        $primary= clean_input($_POST['prim_tel']);
        $secondary= clean_input($_POST['sec_tel']);
        $email= clean_input($_POST['email']);
        $birthday= clean_input($_POST['birthday']);

//used to insert data into my contact table
  $query="UPDATE `my_contact` SET `f_name`='$firstname',`l_name`='$lastname',`address1`='$address1',`address2`='$address2',
  `address3`='$address3',`postcode`='$postcode',`country`='$country',`prim_tel`='$primary',`sec_tel`='$secondary',`email`='$email',
  `birthday`='$birthday' WHERE id='$_POST[id]' AND user_id='$_SESSION[id]'";
  $result= mysql_query($query);
//used to show output after insert of data
        if($result){
            audit(	$_SESSION['id'],"Contsct is updated to the database successful,..");
          header("location:modify.php");
        }
        else {
          echo "<p id='error'>Unsuccessful.</p>".mysql_error();

        }
      }
}
?>
<div class="footer_adm">Copyright &copy; 2018 ER IT Consultants. All Rights Reserved</div>
</body>
</html>
