<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>register page </title>
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
		<h1 class="ui-widget-header">Registration Form</h1>
		<form method="post" action="register.php">
			<table class="login_table" style="width:50%; margin: 0px auto;">
		    <tr>
					<td style="width:50%;"><strong>First Name</strong></td>
					<td><input type="text" name="f_name" size="20" maxlength="50" pattern="[a-zA-Z]+"></td>
				</tr>
		    <tr>
					<td><strong>Last Name</strong></td>
					<td><input type="text" name="l_name" size="20" maxlength="35" pattern="[a-zA-Z]+"></td>
				</tr>
		    <tr>
					<td><strong>Phone Number</strong></td>
					<td><input type="text" name="phone_no" size="20" maxlength="35" pattern="[0][0-9]{9}"></td>
				</tr>
		    <tr>
					<td><strong>Email</strong></td>
					<td><input type="text" name="email" size="20" maxlength="35" pattern="[a-z0-9]+@[a-z]+[.][a-z]{2,3}"></td>
				</tr>
				<tr>
					<td><strong>UserName</strong></td>
					<td><input type="text" name="username" size="20" maxlength="35" pattern="[a-zA-Z 0-9]+"></td>
				</tr>
				<tr>
					<td><strong>Password</strong></td>
					<td><input type="password" name="password" size="20" maxlength="35" pattern="[a-zA-Z0-9 ]{8,}"></td>
				</tr>
		    <tr>
					<td><strong>Retype Password</strong></td>
					<td><input type="password" name="r_password" size="20" maxlength="35" pattern="[a-zA-Z0-9 ]{8,}"></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-top:15px;"><input type="submit" name="submit" value="register" id="button"><br>
						<input type="hidden" name="ab" value="cd"></td>
				</tr>
			</table>
		</form>
	<?php
			if($_POST['ab'] == "cd"){
				$error;
				$send;
			  if(empty($_POST['f_name'])){
			    $error.="*first name field is empty.<br>";
			    $send ="no";
			  }
			  if(empty($_POST['l_name'])){
			    $error.="*last name field is empty.<br>";
			    $send ="no";
			  }
			  if(empty($_POST['phone_no'])){
			    $error.="*phone number field is empty.<br>";
			    $send ="no";
			  }
				if(empty($_POST['email'])){
					$error.="*email field is empty.<br>";
					$send ="no";
				}
			  if(empty($_POST['username'])){
			    $error.="*username field is empty.<br>";
			    $send ="no";
			  }
				if(empty($_POST['password'])){
					$error .="*password field is empty.<br>";
					$send ="no";
				}
			  if(empty($_POST['r_password'])){
			    $error .="*retype password field is empty.<br>";
			    $send ="no";
			  }
			  if($_POST['r_password'] !=$_POST['password']){
			    $error .="* passwords do not match, please retype again.<br>";
			    $send ="no";
			  }
				if($send=="no"){
					echo "<span id=\"error_msg\">$error</span>";

				}else{
			  require_once "conn/connect.php";
			  require_once "clean.php";
				require_once "logs.php";
			  $firstname= clean_input($_POST['f_name']);
			  $lastname= clean_input($_POST['l_name']);
			  $phone_no= clean_input($_POST['phone_no']);
			  $email= clean_input($_POST['email']);
			  $username= clean_input($_POST['username']);
			  $password= $_POST['password'];
			  //$r_password= $_POST['retypepassword'];
			  $date = @date("Y-m-d");
			  $table_name="users";
			  $query= "INSERT INTO $table_name (id, f_name, l_name, phonenumber, email, username, password, date) VALUES "
			    . "('', '$firstname', '$lastname', '$phone_no', '$email', '$username', password(\"$password\"), '$date')";
			  $result= mysql_query($query) or die(mysql_error());
				$id = mysql_insert_id($con);
				  audit($id,"New user is register in the system successful,..");
					header('location:index.php');
				}
			}

		?>
		<div class="footer_adm">Copyright &copy; 2018 ER IT Consultants. All Rights Reserved</div>
	</body>
</html>
