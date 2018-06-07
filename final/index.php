<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>login page </title>
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
		<h1 class="ui-widget-header">Contact Management System</h1>
		<form method="post" action="index.php">
			<table class="login_table" style="width:40%; margin: 0px auto;">
				<tr>
					<td><strong>UserName</strong></td>
					<td><input type="text" name="username" size="15" maxlength="25" pattern="[a-zA-Z 0-9]+"></td>
				</tr>
				<tr>
					<td><strong>Password</strong></td>
					<td><input type="password" name="password" size="15" maxlength="25" pattern="[a-zA-Z0-9 ]{8,}"></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-top:15px;"><input type="submit" name="submit" value="login" id="button"><br>
						<input type="hidden" name="ab" value="cd"></td>
					</tr>
					<tr>
						  <td colspan="2" style="padding-top:15px;text-align:center;"><h5><a href="forget_password.php"> Forget Password</a></h5></td>
						</tr>
				<tr>
				  <td colspan="2" style="padding-top:15px;text-align:center;"><h5><a href="register.php">&raquo; Register</a></h5></td>
				</tr>
			</table>
		</form>
		<?php
			//chech if user is coming from a form (value posted == value entered by user kwenye form)
			if($_POST['ab'] == "cd"){
				$error;
				$send;
				if(empty($_POST['username'])){
					$error="*username field is empty.<br>";
					$send ="no";
				}
				if(empty($_POST['password'])){
					$error .="*password field is empty.<br>";
					$send ="no";
				}
				if($send=="no"){
					echo "<span id=\"error_msg\">$error</span>";

				}else{
				require_once "conn/connect.php";
				require_once "logs.php";
				require_once "clean.php";
				$table_name="users";
				$username = $_POST['username'];
				$password = $_POST['password'];
				$sql="SELECT * FROM $table_name WHERE username='$username' AND password= password(\"$password\") AND status = '1'";
			$result = @mysql_query($sql,$con) or die(mysql_error());
					if (mysql_num_rows($result)==1){
						while($row=mysql_fetch_array($result)){
							//handle good login
						$_SESSION['name']=$row['username'];
						$_SESSION['id']=$row['id'];
						//check if is admin
						if($row['role'] == "admin"){
							  audit(	$_SESSION['id'],"Admin login to the system successful,..");
									header("location:admin/menu.php");
									exit;
						}

					}
					  audit(	$_SESSION['id'],"User login to the system successful,..");
						header('location:administration.php');

					}else{
						$msg = "<span id='error_msg'>Wrong username or password. Please try again.</span>";
						echo $msg;
					}

				}
			}

		?>
			<div class="footer_adm">Copyright &copy; 2018 ER IT Consultants. All Rights Reserved</div>
		</body>
</html>
