<?php
//do not allow tose special character
function clean_input($value){
  $bad_chars= array("{", "}", "[", "]", ";", ":", ",", "\\", "|", "?", ")", "(", ">", "<", "$", "%", "^", "&", "*", "!");
//replace empty in all badcharacters appear
  $value= str_ireplace($bad_chars, "", $value);
  return $value;

}
?>
