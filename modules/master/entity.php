<?php

$mode = $_REQUEST["mode"] == "form" ? 1 : 0;
$moduleid = "master.entity";

if(strtoupper($_POST["FormAction"])=="SIMPAN"){
  if($_POST["fkey"] != ""){
    $sql  = "update ".$config["db_mst"].".ms_entity set vNmEntity='$_POST[nama]', ";
	$sql .= "cUserModify = '$_SESSION[Logged]', dDateModify = CURRENT_TIMESTAMP ";
    $sql .= "where cKdEntity = '$_POST[fkey]' ";
  }else{
    $sql  = "insert into ".$config["db_mst"].".ms_entity (cKdEntity,vNmEntity, cApp, cUserCreated,dDateCreated,cUserModify,dDateModify) ";
    $sql .= "values('$_POST[kode]','$_POST[nama]','RST','$_SESSION[Logged]',CURRENT_TIMESTAMP,'$_SESSION[Logged]',CURRENT_TIMESTAMP) ";
  }
  $conn->Execute($sql); 
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}elseif(strtoupper($_POST["FormAction"])=="HAPUS"){
  $sql = "delete from ".$config["db_mst"].".ms_entity where cKdEntity = '$_POST[fkey]' ";
  $conn->Execute($sql);
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}

$admGrdTpl = new TGridTemplate($moduleid);
$sql  = "select * from ".$config["db_mst"].".ms_entity "; 
if($_GET["key"] != "" || $_GET["mode"] == "form"){
  $sql .= " WHERE cKdEntity = '$_GET[key]' ";
}
$sql .= "ORDER BY cKdEntity ";
$admGrdTpl->moduleid  = $moduleid;
$admGrdTpl->delform   = "m=$moduleid&page=$_GET[page]";
$admGrdTpl->custSQL = $sql;
$gTpl = new TBlock("form.general_box");
$gTpl->name		= "gTpl";
$gTpl->title    = "Master Data Branch";
$gTpl->display  = $admGrdTpl->Show(false);
$content = $gTpl->Show(false);

?>