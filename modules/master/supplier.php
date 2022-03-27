<?php

$mode = $_REQUEST["mode"] == "form" ? 1 : 0;
$moduleid = "master.supplier";

if(strtoupper($_POST["FormAction"])=="SIMPAN"){
  if($_POST["fkey"] != ""){
    $sql  = "update ".$config["db_mst"].".ms_supplier set vNmSupplier='$_POST[nama]',  ";
	$sql .= "cUserModify = '$_SESSION[Logged]', dDateModify = CURRENT_TIMESTAMP ";
    $sql .= "where cKdSupplier = '$_POST[fkey]' ";
  }else{
    $sql  = "insert into ".$config["db_mst"].".ms_supplier (cKdSupplier,vNmSupplier, cUserCreated,dDateCreated,cUserModify,dDateModify) ";
    $sql .= "values('$_POST[kode]','$_POST[nama]','$_SESSION[Logged]',CURRENT_TIMESTAMP,'$_SESSION[Logged]',CURRENT_TIMESTAMP) ";
  }
  $conn->Execute($sql); 
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}elseif(strtoupper($_POST["FormAction"])=="HAPUS"){
  $sql = "delete from ".$config["db_mst"].".tm_dept where cKdSupplier = '$_POST[fkey]' ";
  $conn->Execute($sql);
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}

$admGrdTpl = new TGridTemplate($moduleid);
$sql  = "select * from ".$config["db_mst"].".ms_supplier "; 
if($_GET["key"] != "" || $_GET["mode"] == "form"){
  $sql .= " WHERE cKdSupplier = '$_GET[key]' ";
}
$sql .= "ORDER BY cKdSupplier ";
$admGrdTpl->moduleid  = $moduleid;
$admGrdTpl->delform   = "m=$moduleid&page=$_GET[page]";
$admGrdTpl->custSQL = $sql;
$gTpl = new TBlock("form.general_box");
$gTpl->name		= "gTpl";
$gTpl->title    = "Master Data Supplier";
$gTpl->display  = $admGrdTpl->Show(false);
$content = $gTpl->Show(false);

?>