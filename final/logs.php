<?php
function audit($id,$activity){
  require_once "conn/connect.php";
  $qry="insert into logs(user_id,activity) values ('$id','$activity')";
  $result=mysql_query($qry) or die('error occured');
}


?>
