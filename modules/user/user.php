<?php

$mode = $_REQUEST["mode"] == "form" ? 1 : 0;
if($_REQUEST["mode"]=="proyek") $mode=2;
$moduleid = "user.user";

if(strtoupper($_POST["FormAction"])=="SIMPAN"){
  $val_aktif = $_POST["chkstatus"]	== "" ? "0" : $_POST["chkstatus"];
  $val_pass = trim(encrypt_decrypt('encrypt',$_POST["pass"]));
  if($_POST["fkey"] != ""){
    $sql  = "update tsm_pemakai set cUserName='$_POST[user]', cPassword = '".$val_pass."', cKdGroupUser='$_POST[cmbgroup]', nNamaPemakai='$_POST[nama]', "; 
	$sql .= "cStatus='".$val_aktif."', cUserModify = '$_SESSION[Logged]', dDateModify = CURRENT_TIMESTAMP ";
    $sql .= "where cUserId = '$_POST[fkey]' ";
  }else{
    $sql  = "insert into tsm_pemakai (cUserName,cPassword,cKdGroupUser,nNamaPemakai, cKdPegawai, ";
	$sql .= "cStatus, cUserCreated, dDateCreated, cUserModify, dDateModify) ";
    $sql .= "values('$_POST[user]','".$val_pass."','$_POST[cmbgroup]','$_POST[nama]','$_POST[kdpeg]','".$val_aktif."', ";
	$sql .= "'$_SESSION[Logged]',CURRENT_TIMESTAMP,'$_SESSION[Logged]',CURRENT_TIMESTAMP) ";
  }
  $conn->Execute($sql); 
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}elseif(strtoupper($_POST["FormAction"])=="UPDATEPROYEK"){
  $sql = "DELETE FROM tsm_usersproyek WHERE cUserId = '$_POST[fkey]' ";
  $conn->Execute($sql); 
  foreach($_POST["cakses"] as $k=>$v){
    $val_aktif = $_POST["cakses"][$k] == "" ? "0" : "1"; 
    $sql  = "insert into tsm_pemakai_entity (cUserId,cKdEntity,cStatus) ";
    $sql .= "values('$_POST[fkey]','".$_POST["cakses"][$k]."','".$val_aktif."') ";
    $conn->Execute($sql);
  }
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}	

$admGrdTpl = new TGridTemplate($moduleid);
$sql  = "SELECT peg.cKdPegawai, usr.cUserId,usr.cUserName, usr.cStatus, usr.cKdGroupUser, peg.vNamaPegawai, peg.cKdDept, dept.vNmDept  ";  
$sql .= "FROM (SELECT cKdPegawai, vNamaPegawai, cKdDept FROM ".$config["db_mst"].".ms_pegawai) peg ";
$sql .= "LEFT JOIN tsm_pemakai usr ON peg.cKdPegawai = usr.cKdPegawai  ";
$sql .= "LEFT JOIN (SELECT cKdDept,vNmDept FROM ".$config["db_mst"].".ms_dept) dept ON dept.cKdDept = peg.cKdDept  ";  
if($_GET["key"] != "" || $_GET["mode"] == "form"){
  $sql .= " WHERE peg.cKdPegawai = '$_GET[key]' ";
}
$sql .= "ORDER BY dept.vNmDept, peg.vNamaPegawai ";
$admGrdTpl->moduleid  = $moduleid;
$admGrdTpl->delform   = "m=$moduleid&page=$_GET[page]";
$admGrdTpl->custSQL = $sql;
if($mode=="1"){
  $admGrdTpl->template->MergeBlock("blk_grp","adodb","SELECT cKdGroupUser,vNmGroupUser FROM tsm_groupuser ORDER BY cKdGroupUser");
  $sql = "SELECT cPassword FROM tsm_pemakai WHERE cKdPegawai = '$_GET[key]' ";
  $rs = $conn->Execute($sql);
  if($rs->fields["cPassword"]!=""){
    $cPassword = trim(encrypt_decrypt('decrypt',$rs->fields["cPassword"]));
  }else{
    $cPassword = "";
  }
}
if($mode=="2"){
  $sql  = "SELECT ent.cKdEntity, ent.vNmEntity, COALESCE(up.cStatus,0) AS cStatus ";
  $sql .= "FROM ".$config["db_mst"].".ms_entity ent ";
  $sql .= "LEFT JOIN tsm_pemakai_entity up ON up.cKdEntity = ent.cKdEntity AND up.cUserId = '$_GET[key]' ";
  $sql .= "ORDER BY ent.cKdEntity ";
  $admGrdTpl->template->MergeBlock("blk_dtl","adodb",$sql);
}
$gTpl = new TBlock("form.general_box");
$gTpl->name		= "gTpl";
$gTpl->title    = "User List";
$gTpl->display  = $admGrdTpl->Show(false);
$content = $gTpl->Show(false);

?>