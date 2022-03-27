<?php

$mode = $_REQUEST["mode"] == "form" ? 1 : 0;
$moduleid = "master.paket";

if(strtoupper($_POST["FormAction"])=="SIMPAN"){
  $val_image = $_POST["gbr"] == "" ? "" : $UPLOAD_WEB_DIR.$_POST["gbr"]; 
  $val_status = $_POST["chkstatus"] == "" ? "F" : $_POST["chkstatus"]; 
  $harga = ($_POST["harga"]!="") ? str_replace(",","",$_POST["harga"]) : "0";
  if($_POST["fkey"] != ""){
    $sql  = "update ".$config["db_mst"].".ms_pakethd set vNmPaket='$_POST[nama]', cKdGrupBarang='$_POST[cmbgroup]',  ";
	$sql .= "vHargaJual='$harga',vImagePath='$val_image',cKeterangan='$_POST[ket]',cAktif='".$val_status."', ";
	$sql .= "cKdEntity = NULL, cUserModify = '$_SESSION[Logged]', dDateModify = CURRENT_TIMESTAMP ";
    $sql .= "where cKdPaket = '$_POST[fkey]' ";
    $conn->Execute($sql); 
	$dokID = $_POST["fkey"];
  }else{
    $sql  = "insert into ".$config["db_mst"].".ms_pakethd (cKdPaket,vNmPaket, cKdGrupBarang, vHargaJual, vImagePath, cKeterangan,cAktif, ";
	$sql .= "cKdEntity, cUserCreated,dDateCreated,cUserModify,dDateModify) ";
    $sql .= "values('$_POST[kode]','$_POST[nama]','$_POST[cmbgroup]','$harga','$val_image','$_POST[ket]','".$val_status."',";
	$sql .= "NULL,'$_SESSION[Logged]',CURRENT_TIMESTAMP,'$_SESSION[Logged]',CURRENT_TIMESTAMP) ";
    $conn->Execute($sql); 
	$dokID  = $_POST["kode"];
  }
  // insert detail
  $sql  = "delete from ".$config["db_mst"].".ms_paketbrgdt where cKdPaket = '$dokID' ";
  $conn->Execute($sql);
  foreach($_POST["kd_barang"] as $k=>$v){
    $sql  = "INSERT INTO ".$config["db_mst"].".ms_paketbrgdt (cKdPaket,cKdBarang,nQty,cSatuan) ";
    $sql .= "VALUES ('$dokID','".$_POST["kd_barang"][$k]."','".$_POST["val_qty"][$k]."','".$_POST["kd_satuan"][$k]."')";	
	$conn->Execute($sql);
  }
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}elseif(strtoupper($_POST["FormAction"])=="HAPUS"){
  $sql = "delete from ".$config["db_mst"].".ms_paketbrgdt where cKdPaket = '$_POST[fkey]' ";
  $conn->Execute($sql);
  $sql = "delete from ".$config["db_mst"].".ms_pakethd where cKdPaket = '$_POST[fkey]' ";
  $conn->Execute($sql);
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}

$admGrdTpl = new TGridTemplate($moduleid);
$sql  = "select hd.*, grp.vNmGrupBarang, "; 
$sql .= "CASE WHEN hd.vImagePath IS NOT NULL THEN REPLACE(hd.vImagePath,'$UPLOAD_WEB_DIR','') ";
$sql .= "ELSE '' END as cImage, ";
$sql .= "CASE WHEN hd.vImagePath = NULL THEN CONCAT('".$config["http_url"]."','/images/no_thumb.jpg') ";
$sql .= "WHEN TRIM(hd.vImagePath) = '' THEN CONCAT('".$config["http_url"]."','/images/no_thumb.jpg') ";
$sql .= "ELSE CONCAT('".$config["http_url"]."',hd.vImagePath) END as cImagePath ";
$sql .= "from ".$config["db_mst"].".ms_pakethd hd ";
$sql .= "LEFT JOIN ".$config["db_mst"].".ms_grupbarang grp ON grp.cKdGrupBarang = hd.cKdGrupBarang ";
if($_GET["key"] != "" || $_GET["mode"] == "form"){
  $sql .= " WHERE cKdPaket = '$_GET[key]' ";
}
$sql .= "ORDER BY cKdPaket ";
$admGrdTpl->moduleid  = $moduleid;
$admGrdTpl->delform   = "m=$moduleid&page=$_GET[page]";
$admGrdTpl->custSQL = $sql;
if($mode=="1"){
  $var_no_image = $config["http_url"].'/images/no_thumb.jpg';
  
  $admGrdTpl->template->MergeBlock("blk_grp","adodb","SELECT cKdGrupBarang, vNmGrupBarang FROM ".$config["db_mst"].".ms_grupbarang ORDER BY cKdGrupBarang");

  $sql  = "SELECT dt.*, brg.vNamaBarang, sat.cAlias FROM ".$config["db_mst"].".ms_paketbrgdt dt ";
  $sql .= "LEFT JOIN ".$config["db_mst"].".ms_barang brg ON brg.cKdBarang = dt.cKdBarang ";
  $sql .= "LEFT JOIN ".$config["db_mst"].".ms_satuan sat ON sat.cSatuan = dt.cSatuan ";
  $sql .= "WHERE dt.cKdPaket = '$_GET[key]' ";
  $admGrdTpl->template->MergeBlock("grid_dtl","adodb",$sql);
}
$gTpl = new TBlock("form.general_box");
$gTpl->name		= "gTpl";
$gTpl->title    = "Master Data Packages";
$gTpl->display  = $admGrdTpl->Show(false);
$content = $gTpl->Show(false);

?>