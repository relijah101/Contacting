 <?php
session_start();
//used to check if someone login
if(isset($_SESSION['name']) & !empty($_SESSION['name'])){

?>

<!DOCTYPE html>
<html>
	<head>
		<title>add contact</title>
		<script type="text/javascript" src="script/jquery.js"></script>
		<script type="text/javascript" src="script/jquery-ui.js"></script>
		<link rel="stylesheet" href="styles/jquery-ui.min.css"/>
		<link rel="stylesheet" href="styles/mystyle.css"/>
		<script>
			$(function(){
					$("#birthday").datepicker({
						dateFormat:"yy-mm-dd"
					});
					$("#button").button();
					var reg = ["Arusha","Kilimanjaro","Daresalaam","Mbeya","Iringa","Wete","Mkoani","Zanzibar","Koani",
					"Morogoro","Geita","Njombe","Shinyanga","Ruvuma","Pwani","Tanga","Songwe","Katavi","Manyara","Mkokotoni",
					"Dodoma","Kigoma","Kagera","Mara","Mtwara","Lindi", "Singida","Iringa","Rukwa","Tabora","Simiyu"];
					$("#region").autocomplete({
						source: reg
					});
			});
		</script>
		</head>
	<body class="ui-widget">
		<h1 class="ui-widget-header">Add a contact</h1>
		<h6><a href="administration.php">&laquo; Go back</a></h6>
			<form method="post" action="addcontact.php">
			<table class="table">
				<tr>
					<td>Firstname :</td>
					<td><input type=text name="firstname" maxlength=30 pattern="[a-zA-Z]+" value= "<?php echo $_POST[firstname];?>"></td>
				</tr>
				<tr>
					<td>Lastname :</td>
					<td><input type=text name="lastname" maxlength=30 pattern="[a-zA-Z]+" value= "<?php echo $_POST[lastname];?>"></td>
				</tr>
				<tr>
					<td>P.O.Box :</td>
					<td><input type=text name="address1" maxlength=15 pattern="[0-9]{1,}" value= "<?php echo $_POST[address1];?>"></td>
				</tr>
				<tr>
					<td>Region :</td>
					<td><input id="region" type=text name="address2" maxlength=15 pattern="[a-zA-Z]+" value="<?php echo $_POST[address2];?>"></td>
				</tr>
				<tr>
					<td>District :</td>
					<td><input type=text name="address3" maxlength=20 pattern="[a-zA-Z\s]+" value="<?php echo $_POST[address3];?>"></td>
				</tr>
				<tr>
					<td>Country :</td>
					<td><input type=text name="country" maxlength=20 pattern="[a-zA-Z]+" value="<?php echo $_POST[country];?>"></td>
				</tr>
				<tr>
					<td>Zipcode :</td>
					<td><input type=text name="pcode" maxlength=5 pattern="[+][0-9]{3}" value="<?php echo $_POST[pcode];?>"></td>
				</tr>
				<tr>
					<td>Primary tel :</td>
					<td><input type=text name="primary" maxlength=30 pattern="[0][0-9]{9}" value="<?php echo $_POST[primary];?>"></td>
				</tr>
				<tr>
					<td>Secondary tel :</td>
					<td><input type=text name="secondary" maxlength=30 pattern="[0][0-9]{9}" value="<?php echo $_POST[secondary];?>"></td>
				</tr>
				<tr>
					<td>Email :</td>
					<td><input type=text name="email" maxlength=50 pattern="[a-z0-9]+@[a-z]+[.][a-z]{2,3}" value="<?php echo $_POST[email];?>"></td></tr>
				<tr>
					<td>Birthday :yy-mm-dd</td>
					<td><input type=text name="birthday" id="birthday" maxlength=20 pattern="[0-9]{4}[-][0-9]{1,2}[-][0-9]{1,2}"  value="<?php echo $_POST[birthday];?>"></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-top:15px;"><input type="submit" name="Add" value="Submit" id="button" class=""></td>
				</tr>

			</table>

			<input type="hidden" name="rm" value="jm">
		</form>
		<?php
//used to compare name entered is equal to the value assigned
		if($_POST['rm'] == "jm"){
			$error;
			$send;
//used to check if all fields are filled
			if(empty($_POST['firstname'])){
				$error .="*Firstname field is empty</br>";
				$send ="no";
			}
			if(empty($_POST['lastname'])){
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
			if(empty($_POST['country'])){
				$error .="*Country field is empty</br>";
				$send ="no";
			}
			if(empty($_POST['pcode'])){
				$error .="*Zipcode field is empty</br>";
				$send ="no";
			}
			if(empty($_POST['primary'])){
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
				echo "<span id='error'>$error</span>";
			}
			else{
//use conn file to excute these code
						require_once "conn/connect.php";
						require_once "clean.php";
            require_once "logs.php";
						$firstname= clean_input($_POST['firstname']);
						$lastname= clean_input($_POST['lastname']);
						$address1= clean_input($_POST['address1']);
						$address2= clean_input($_POST['address2']);
						$address3= clean_input($_POST['address3']);
						$postcode= clean_input($_POST['pcode']);
						$country= clean_input($_POST['country']);
						$primary= clean_input($_POST['primary']);
						$secondary= clean_input($_POST['secondary']);
						$email= clean_input($_POST['email']);
						$birthday= clean_input($_POST['birthday']);

//used to insert data into my contact table
						$query= "INSERT INTO my_contact VALUES "
						. "('', '	$_SESSION[id]', '$firstname', '$lastname', '$address1', '$address2', '$address3', '$postcode', '$country', '$primary', '$secondary', '$email', '$birthday')";
						$result= mysql_query($query);
//used to show output after insert of data
						if($result){
                audit(	$_SESSION['id'],"add contact to the database successful,..");
							header("location:addcontact.php");
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
<?php
}
?>
