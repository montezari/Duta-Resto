<?php

$mode = $_REQUEST["mode"] == "form" ? 1 : 0;
$moduleid = "master.items";

if(strtoupper($_POST["FormAction"])=="SIMPAN"){
  $val_image = $_POST["gbr"] == "" ? "" : $UPLOAD_WEB_DIR.$_POST["gbr"]; 
  $val_status = $_POST["chkstatus"] == "" ? "F" : $_POST["chkstatus"]; 
  $val_andro = $_POST["showandro"] == "" ? "F" : $_POST["showandro"]; 
  $harga = ($_POST["harga"]!="") ? str_replace(",","",$_POST["harga"]) : "0";
  if($_POST["fkey"] != ""){
	$sql  = "update ".$config["db_mst"].".ms_barang set vNamaBarang='$_POST[nama]',cKdGrupBarang='$_POST[cmbgroup]', ";
	$sql .= "cSatuan = '$_POST[cmbsatuan]', cJenis = '1', cStatus='".$val_status."' ,vStockMinimum=0, cKeterangan = '$_POST[ket]', vHargaJual = '$harga', ";
	$sql .= "vImagePath = '$val_image',cShowAndroid='".$val_andro."',cKdEntity = NULL, cUserModify = '$_SESSION[Logged]', dDateModify = CURRENT_TIMESTAMP ";
    $sql .= "where cKdBarang = '$_POST[fkey]' ";
  }else{
	$sql  = "insert into ".$config["db_mst"].".ms_barang (cKdBarang,vNamaBarang,cKdGrupBarang,cSatuan,cJenis,cStatus,vStockMinimum,cKeterangan,vHargaJual, ";
	$sql .= "vImagePath,cShowAndroid,cKdEntity,cUserCreated,dDateCreated,cUserModify,dDateModify) ";
    $sql .= "values('$_POST[kode]','$_POST[nama]','$_POST[cmbgroup]','$_POST[cmbsatuan]','1','".$val_status."',0,'$_POST[ket]','$harga',";
	$sql .= "'$val_image','".$val_andro."',NULL,'$_SESSION[Logged]',CURRENT_TIMESTAMP,'$_SESSION[Logged]',CURRENT_TIMESTAMP) ";
  }
  $conn->Execute($sql); 
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}elseif(strtoupper($_POST["FormAction"])=="HAPUS"){
  //$sql = "select count(*) as jml from ".$config["db_mst"].".ms_barang WHERE cKdGrupBarang = '$_POST[fkey]' ";
  //$rs = $conn->Execute($sql); 	
  //if($rs->fields["jml"]==0){
	  $sql = "delete from ".$config["db_mst"].".ms_barang where cKdBarang = '$_POST[fkey]' ";
	  $conn->Execute($sql);
	  header("Location: $config[http]$_SERVER[REQUEST_URI]");
	  exit;
  //}else{
  //	echo "<script>alert('This data can not be deleted because it is in use.');</script>";
  //	echo "<script>window.location = 'index.php?m=$moduleid'</script>";
  //}
}

$admGrdTpl = new TGridTemplate($moduleid);
$sql  = "SELECT brg.*, ";
$sql .= "CASE WHEN vImagePath IS NOT NULL THEN REPLACE(vImagePath,'$UPLOAD_WEB_DIR','') ";
$sql .= "ELSE '' END as cImage, ";
$sql .= "CASE WHEN vImagePath = NULL THEN CONCAT('".$config["http_url"]."','/images/no_thumb.jpg') ";
$sql .= "WHEN TRIM(vImagePath) = '' THEN CONCAT('".$config["http_url"]."','/images/no_thumb.jpg') ";
$sql .= "ELSE CONCAT('".$config["http_url"]."',vImagePath) END as cImagePath, ";
$sql .= "grp.vNmGrupBarang ";
$sql .= "FROM ".$config["db_mst"].".ms_barang brg ";
$sql .= "LEFT JOIN ".$config["db_mst"].".ms_grupbarang grp ON grp.cKdGrupBarang = brg.cKdGrupBarang ";
$sql .= "LEFT JOIN ".$config["db_mst"].".ms_satuan sat ON sat.cSatuan = brg.cSatuan ";
if($_GET["key"] != "" || $_GET["mode"] == "form"){
  $sql .= " WHERE brg.cKdBarang = '$_GET[key]' ";
}
$sql .= "ORDER BY grp.vNmGrupBarang, brg.vNamaBarang ";

$admGrdTpl->moduleid  = $moduleid;
$admGrdTpl->delform   = "m=$moduleid&page=$_GET[page]";
$admGrdTpl->custSQL = $sql;
if($mode=="1"){
  $var_no_image = $config["http_url"].'/images/no_thumb.jpg';
  $admGrdTpl->template->MergeBlock("blk_grp","adodb","SELECT cKdGrupBarang, vNmGrupBarang FROM ".$config["db_mst"].".ms_grupbarang ORDER BY cKdGrupBarang");
  $admGrdTpl->template->MergeBlock("blk_sat","adodb","SELECT cSatuan, cAlias FROM ".$config["db_mst"].".ms_satuan ORDER BY cAlias");
}
$gTpl = new TBlock("form.general_box");
$gTpl->name		= "gTpl";
$gTpl->title    = "Master Data Items";
$gTpl->display  = $admGrdTpl->Show(false);
$content = $gTpl->Show(false);

?>