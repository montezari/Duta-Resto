<?php

$mode = $_REQUEST["mode"] == "form" ? 1 : 0;
$moduleid = "master.table";

if(strtoupper($_POST["FormAction"])=="SIMPAN"){
  $val_status = $_POST["chkstatus"]	== "" ? "F" : $_POST["chkstatus"]; 
  if($_POST["fkey"] != ""){
    $sql  = "update ".$config["db_mst"].".ms_tablelayout set vNmTable='$_POST[nama]', cStatus='".$val_status."', ";
	$sql .= "cUserModify = '$_SESSION[Logged]', dDateModify = CURRENT_TIMESTAMP ";
    $sql .= "where cKdTable = '$_POST[fkey]' ";
  }else{
    $sql  = "insert into ".$config["db_mst"].".ms_tablelayout (vNmTable, cStatus, cUserCreated,dDateCreated,cUserModify,dDateModify) ";
    $sql .= "values('$_POST[nama]','".$val_status."','$_SESSION[Logged]',CURRENT_TIMESTAMP,'$_SESSION[Logged]',CURRENT_TIMESTAMP) ";
  }
  $conn->Execute($sql); 
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}elseif(strtoupper($_POST["FormAction"])=="HAPUS"){
  $sql = "delete from ".$config["db_mst"].".ms_tablelayout where cKdTable = '$_POST[fkey]' ";
  $conn->Execute($sql);
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}

$admGrdTpl = new TGridTemplate($moduleid);
$sql  = "select *, CASE cStatus WHEN 'T' THEN 'ACTIVE' ELSE '-' END AS vStatus ";
$sql .= "from ".$config["db_mst"].".ms_tablelayout "; 
if($_GET["key"] != "" || $_GET["mode"] == "form"){
  $sql .= " WHERE cKdTable = '$_GET[key]' ";
}
$sql .= "ORDER BY cOrder ";
$admGrdTpl->moduleid  = $moduleid;
$admGrdTpl->delform   = "m=$moduleid&page=$_GET[page]";
$admGrdTpl->custSQL = $sql;
$gTpl = new TBlock("form.general_box");
$gTpl->name		= "gTpl";
$gTpl->title    = "Master Data Table Layout";
$gTpl->display  = $admGrdTpl->Show(false);
$content = $gTpl->Show(false);

?>