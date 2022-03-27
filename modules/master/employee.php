<?php

$mode = $_REQUEST["mode"] == "form" ? 1 : 0;
$moduleid = "master.employee";

if(strtoupper($_POST["FormAction"])=="SIMPAN"){
  //$val_pelayan = $_POST["chkwaiter"] == "" ? "F" : $_POST["chkwaiter"]; 
  if($_POST["fkey"] != ""){
    $sql  = "update ".$config["db_mst"].".ms_pegawai set vNamaPegawai='$_POST[nama]', vNmSingkat='$_POST[alias]', ";
	$sql .= "cKdDept='$_POST[cmbdept]',cFlag='$_POST[cmbgrp]',cPIN='$_POST[pin]', cKdEntity='$_POST[cmbentity]',  ";
	$sql .= "cUserModify = '$_SESSION[Logged]', dDateModify = CURRENT_TIMESTAMP ";
    $sql .= "where cKdPegawai = '$_POST[fkey]' ";
  }else{
    $sql  = "insert into ".$config["db_mst"].".ms_pegawai (vNamaPegawai,vNmSingkat,cKdDept, cFlag, cPIN, cKdEntity, ";
	$sql .= "cUserCreated,dDateCreated,cUserModify,dDateModify) ";
    $sql .= "values('$_POST[nama]','$_POST[alias]','$_POST[cmbdept]','$_POST[cmbgrp]','$_POST[pin]', '$_POST[cmbentity]', ";
	$sql .= "'$_SESSION[Logged]',CURRENT_TIMESTAMP,'$_SESSION[Logged]',CURRENT_TIMESTAMP) ";
  }
  $conn->Execute($sql); 
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}elseif(strtoupper($_POST["FormAction"])=="HAPUS"){
  $sql = "delete from ".$config["db_mst"].".ms_pegawai where cKdPegawai = '$_POST[fkey]' ";
  $conn->Execute($sql);
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}

$admGrdTpl = new TGridTemplate($moduleid);
$sql  = "SELECT peg.*, ent.vNmEntity, dep.vNmDept, CASE peg.cPelayan WHEN 'T' THEN 'YES' ELSE '-' END AS vPelayan, ";
$sql .= "peg.cFlag, CASE peg.cFlag WHEN '1' THEN 'WAITER' WHEN '2' THEN 'KASIR' WHEN '3' THEN 'WAITER & KASIR' ";
$sql .= "WHEN '4' THEN 'KITCHEN' WHEN '9' THEN 'MANAGEMENT' ELSE '-' END AS vFlag, ";
$sql .= "peg.cPIN FROM ".$config["db_mst"].".ms_pegawai peg "; 
$sql .= "LEFT JOIN ".$config["db_mst"].".ms_entity ent ON ent.cKdEntity = peg.cKdEntity "; 
$sql .= "LEFT JOIN ".$config["db_mst"].".ms_dept dep ON dep.cKdDept = peg.cKdDept "; 
if($_GET["key"] != "" || $_GET["mode"] == "form"){
  $sql .= " WHERE peg.cKdPegawai = '$_GET[key]' ";
}
$sql .= "ORDER BY peg.cKdEntity, peg.cKdDept, peg.cKdPegawai ";
$admGrdTpl->moduleid  = $moduleid;
$admGrdTpl->delform   = "m=$moduleid&page=$_GET[page]";
$admGrdTpl->custSQL = $sql;
if($mode=="1"){
  $admGrdTpl->template->MergeBlock("blk_ent","adodb","SELECT cKdEntity, vNmEntity FROM ".$config["db_mst"].".ms_entity ORDER BY cKdEntity");
  $admGrdTpl->template->MergeBlock("blk_dept","adodb","SELECT cKdDept,vNmDept FROM ".$config["db_mst"].".ms_dept ORDER BY cKdDept");
  
  $sql  = "SELECT '0' AS cId, '-' as cName UNION ";
  $sql .= "SELECT '1' as cId, 'WAITER' AS cName UNION ";
  $sql .= "SELECT '2' AS cId, 'KASIR' AS cName UNION ";
  $sql .= "SELECT '3' AS cId, 'WAITER & KASIR' AS cName UNION ";
  $sql .= "SELECT '4' AS cId, 'KITCHEN' AS cName UNION ";
  $sql .= "SELECT '9' AS cId, 'MANAGEMENT' AS cName ";
  $admGrdTpl->template->MergeBlock("blk_grp","adodb",$sql);


}
$gTpl = new TBlock("form.general_box");
$gTpl->name = "gTpl";
$gTpl->title = "Master Data Employee";
$gTpl->display = $admGrdTpl->Show(false);
$content = $gTpl->Show(false);

?>