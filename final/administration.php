<?php
session_start();

if(isset($_SESSION['name']) & !empty($_SESSION['name'])){
?>
<!DOCTYPE html>
<html>
	<head>
		<title>adminstration</title>
		<script type="text/javascript" src="script/jquery.js"></script>
		<script type="text/javascript" src="script/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="styles/jquery-ui.min.css"/>
		<link rel="stylesheet" href="styles/mystyle.css"/>
		<script>
			$(function(){
				$("#menu1").menu();
				$("#menu2").menu();
				$("#menu3").menu();
				$("#menu4").menu();
				$("#menu5").menu();
			});
		</script>
	<!-- codes of uploading contact from phone to my system -->
		  <script type="text/javascript" src="http://api.bridgeit.mobi/bridgeit/bridgeit.js"></script>
			<script type="text/javascript">
function onAfterReturnFromContacts(event)  {
    if( event.value ){
        var text = unescape(event.value);

        var record = bridgeit.url2Object(text);
        var elem = document.getElementById('contacts');
        var ul = document.createElement('ul');
        ul.setAttribute('data-role', 'listview');
        ul.setAttribute('data-inset', 'true');
        ul.setAttribute('data-divider-theme','d');
        var recordHTML = '';
        for (var key in record)  {
            recordHTML += "<li><span class='ellipsis'><strong>"
            + key + ": </strong>" + record[key] + "</span></li>";
        }
        ul.innerHTML = recordHTML;
        $(elem).prepend(ul);
        $('#contacts ul:first-child').listview().listview('refresh');
    }
}
</script>
	</head>
	<body class="ui-widget">
		<h1 class="ui-widget-header">My Contact Administration System</h1>
		<p><strong>Administration</strong></p>
		<ul id="menu1" class="ui-menu">
			<li><a href=addcontact.php>Add a Contact</a></li>
			<li><a id='contactListBtn'  type="button" onclick="bridgeit.fetchContact('contactListBtn', 'onAfterReturnFromContacts');">Upload  Contact</a></li>
			<li><a href=showcontact.php>Show Contact</a></li>
			<li><a href=modify.php>Modify a Contact</a></li>
			<li><a href=delete.php>Delete a Contact</a></li>

		</ul>
		<p><strong>View Records</strong></p>
		<ul id="menu2" class="ui-menu">
			<li><a href=showcontactsbyname.php>Show Contact Ordered by Name</a></li>
		</ul>
		<p><strong>Reminders</strong></p>
		<ul id="menu3" class="ui-menu">
		<li>
			<?php
			require_once "conn/connect.php";
			$date = @date("Y-m-d");
			$table_name = "reminder";
			//to show active reminder
			$sql = "SELECT id, title, description FROM $table_name WHERE user_id='$_SESSION[id]' AND date = '$date' AND flag='1'";
			$result = @mysql_query($sql,$con) or die(mysql_error());
			if(mysql_num_rows($result) == 0){
				echo " Today is ". $date. " No reminders today";
			}else{
				echo " Today is ". $date . " Today's reminder :";
				while($row=mysql_fetch_array($result)){
					echo "<em><a href='reminder.php'>$row[title] </a></em> [$row[description]]<br>";
				}
			}
			 ?>

		</li>
		<li><a href=addreminder.php>Add reminder</a></li>
		<li><a href=reminder.php>Show reminder</a></li>
	</ul>
	<p><strong>Manage Account</strong></p>
	<ul id="menu4" class="ui-menu">
		<li><a href=change_user_pwd.php>Change Password</a></li>
	</ul>
		<p><strong>Leave</strong></p>
		<ul id="menu5" class="ui-menu">
			<li><a href=logout.php>Logout</a></li>
		</ul>
	<div class="footer_adm">Copyright &copy; 2018 ER IT Consultants. All Rights Reserved</div>
	</body>
</html>
<?php
}else{
	header("location:index.php");
}
?>
