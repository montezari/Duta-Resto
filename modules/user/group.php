<?php

$mode = $_REQUEST["mode"] == "form" ? 1 : 0;
$moduleid = "user.group";

if(strtoupper($_POST["FormAction"])=="SIMPAN"){
  $val_aktif = $_POST["chkstatus"]	== "" ? "F" : $_POST["chkstatus"]; 
  if($_POST["fkey"] != ""){
    $sql  = "update tsm_groupuser set vNmGroupUser='$_POST[nama]', cAktif='".$val_aktif."', cUserModify = '$_SESSION[Logged]', dDateModify = CURRENT_TIMESTAMP ";
    $sql .= "where cKdGroupUser = '$_POST[fkey]' ";
  }else{
    $sql  = "insert into tsm_groupuser (vNmGroupUser,cAktif, cUserCreated, dDateCreated, cUserModify, dDateModify) ";
    $sql .= "values('$_POST[nama]','".$val_aktif."','$_SESSION[Logged]',CURRENT_TIMESTAMP,'$_SESSION[Logged]',CURRENT_TIMESTAMP) ";
  }
  $conn->Execute($sql); 
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}elseif(strtoupper($_POST["FormAction"])=="HAPUS"){
  $sql = "delete from tsm_groupuser where cKdGroupUser = '$_POST[fkey]' ";
  $conn->Execute($sql);
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}

$admGrdTpl = new TGridTemplate($moduleid);
$sql  = "select * from tsm_groupuser "; 
if($_GET["key"] != "" || $_GET["mode"] == "form"){
  $sql .= " WHERE cKdGroupUser = '$_GET[key]' ";
}
$sql .= "ORDER BY cKdGroupUser ";
$admGrdTpl->moduleid  = $moduleid;
$admGrdTpl->delform   = "m=$moduleid&page=$_GET[page]";
$admGrdTpl->custSQL = $sql;
$gTpl = new TBlock("form.general_box");
$gTpl->name		= "gTpl";
$gTpl->title    = "User Group";
$gTpl->display  = $admGrdTpl->Show(false);
$content = $gTpl->Show(false);

?>