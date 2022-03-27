<?php

$mode = $_REQUEST["mode"] == "form" ? 1 : 0;
$moduleid = "trans.adjust";
$jenis = array('1'=>'STOCK','2'=>'PEMUTIHAN');

if(strtoupper($_POST["FormAction"])=="SIMPAN"){
  $notrans = $_POST["nomor"];
  if($_POST["tgl"]!=""){
	$tgl = explode("/",$_POST["tgl"]);
	$tgltrans = $tgl[2]."-".$tgl[1]."-".$tgl[0];
  }else{
	$tgltrans = date('Y-m-d');
  }
  if($_POST["fkey"] != ""){
    $sql  = "update tr_adjusthd set cJenis='$_POST[jenis]',  ";
	$sql .= "cKeterangan='$_POST[ket]',";
	$sql .= "cKdEntity = NULL, cUserModify = '$_SESSION[Logged]', dDateModify = CURRENT_TIMESTAMP ";
    $sql .= "where cIdAdjust = '$_POST[fkey]' ";
    $conn->Execute($sql); 
	$dokID = $_POST["fkey"];
  }else{
    $notrans = settransno("ADJ");
    $sql  = "insert into tr_adjusthd (cNoAdjust,dTglAdjust,cJenis,cKeterangan,cStatus, ";
	$sql .= "cKdEntity, cUserCreated,dDateCreated,cUserModify,dDateModify) ";
    $sql .= "values('$notrans','$tgltrans','$_POST[jenis]','$_POST[ket]','O',";
	$sql .= "NULL,'$_SESSION[Logged]',CURRENT_TIMESTAMP,'$_SESSION[Logged]',CURRENT_TIMESTAMP) ";
    $conn->Execute($sql); 
	$dokID  = $conn->Insert_ID();
  }
  // insert detail
  $sql  = "delete from tr_adjustdt where cIdAdjust = '$dokID' ";
  $conn->Execute($sql);
  foreach($_POST["kd_barang"] as $k=>$v){
    $sql  = "INSERT INTO tr_adjustdt (cIdAdjust,cNoAdjust,dTglAdjust,cKdBarang,nQtyAdjust,cSatuan) ";
    $sql .= "VALUES ('$dokID','$notrans','$tgltrans','".$_POST["kd_barang"][$k]."','".$_POST["val_qty"][$k]."','".$_POST["kd_satuan"][$k]."')";	
	$conn->Execute($sql);
  }
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}elseif(strtoupper($_POST["FormAction"])=="HAPUS"){
  if($_POST["fkey"] != ""){
    $sql = "delete from tr_adjustdt where cIdAdjust = '$_POST[fkey]' ";
    $conn->Execute($sql);
    $sql = "delete from tr_adjusthd where cIdAdjust = '$_POST[fkey]' ";
    $conn->Execute($sql);
  }
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}

$admGrdTpl = new TGridTemplate($moduleid);
$sql  = "select hd.*, CASE hd.cJenis WHEN '1' THEN 'STOCK' WHEN '2' THEN 'PEMUTIHAN' ELSE '' END AS vJenis "; 
$sql .= "from tr_adjusthd hd ";
if($_GET["key"] != "" || $_GET["mode"] == "form"){
  $sql .= " WHERE hd.cIdAdjust = '$_GET[key]' ";
}
$sql .= "ORDER BY hd.cNoAdjust ";
$admGrdTpl->moduleid  = $moduleid;
$admGrdTpl->delform   = "m=$moduleid&page=$_GET[page]";
$admGrdTpl->custSQL = $sql;
if($mode=="1"){
  $admGrdTpl->template->MergeBlock("blk_jns",$jenis);
  $sql  = "SELECT dt.*, brg.vNamaBarang, sat.cAlias FROM tr_adjustdt dt ";
  $sql .= "LEFT JOIN ".$config["db_mst"].".ms_barang brg ON brg.cKdBarang = dt.cKdBarang ";
  $sql .= "LEFT JOIN ".$config["db_mst"].".ms_satuan sat ON sat.cSatuan = dt.cSatuan ";
  $sql .= "WHERE dt.cIdAdjust = '$_GET[key]' ";
  $admGrdTpl->template->MergeBlock("grid_dtl","adodb",$sql);
}
$gTpl = new TBlock("form.general_box");
$gTpl->name		= "gTpl";
$gTpl->title    = "Adjustment Form";
$gTpl->display  = $admGrdTpl->Show(false);
$content = $gTpl->Show(false);

?>