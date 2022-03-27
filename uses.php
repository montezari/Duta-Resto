<?php
  require_once "includes/global.inc.php";
  if(isset($_REQUEST["m"]) && $_REQUEST["m"] != ""){
    list($m,$f) = explode(".",$_REQUEST["m"]);
	include("modules/$m/$f.php");
  }
?>