<?php

$script = $_GET['src'];
if(isset($_GET['src'])){
  if(file_exists("includes/js/".$script.".js")) {
    echo file_get_contents("includes/js/".$script.".js");
  }elseif(file_exists("includes/js/".$script.".php")) {
    echo require_once "includes/js/".$script.".php";
  }else{
    echo "";
  }
}else{
  echo "";
}
?>