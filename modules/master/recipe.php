<?php

$mode = $_REQUEST["mode"] == "form" ? 1 : 0;
$moduleid = "master.recipe";

if(strtoupper($_POST["FormAction"])=="SIMPAN"){
  $val_status = $_POST["chkstatus"] == "" ? "F" : $_POST["chkstatus"]; 
  if($_POST["fkey"] != ""){
    $sql  = "update ".$config["db_mst"].".tm_recipehd set cKdBarang='$_POST[kode]',  ";
	$sql .= "cKeterangan='$_POST[ket]',cAktif='".$val_status."', ";
	$sql .= "cKdEntity = NULL, cUserModify = '$_SESSION[Logged]', dDateModify = CURRENT_TIMESTAMP ";
    $sql .= "where cKdRecipe = '$_POST[fkey]' ";
    $conn->Execute($sql); 
	$dokID = $_POST["fkey"];
  }else{
    $sql  = "insert into ".$config["db_mst"].".tm_recipehd (cKdBarang, cKeterangan,cAktif, ";
	$sql .= "cKdEntity, cUserCreated,dDateCreated,cUserModify,dDateModify) ";
    $sql .= "values('$_POST[kode]','$_POST[ket]','".$val_status."',";
	$sql .= "NULL,'$_SESSION[Logged]',CURRENT_TIMESTAMP,'$_SESSION[Logged]',CURRENT_TIMESTAMP) ";
    $conn->Execute($sql); 
	$dokID  = $conn->Insert_ID();
  }
  // insert detail
  $sql  = "delete from ".$config["db_mst"].".tm_recipebrgdt where cKdRecipe = '$dokID' ";
  $conn->Execute($sql);
  foreach($_POST["kd_barang"] as $k=>$v){
    $sql  = "INSERT INTO ".$config["db_mst"].".tm_recipebrgdt (cKdRecipe,cKdBarang,nQty,cSatuan) ";
    $sql .= "VALUES ('$dokID','".$_POST["kd_barang"][$k]."','".$_POST["val_qty"][$k]."','".$_POST["kd_satuan"][$k]."')";	
	$conn->Execute($sql);
  }
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}elseif(strtoupper($_POST["FormAction"])=="HAPUS"){
  if($_POST["fkey"] != ""){
    $sql = "delete from ".$config["db_mst"].".tm_recipebrgdt where cKdRecipe = '$_POST[fkey]' ";
    $conn->Execute($sql);
    $sql = "delete from ".$config["db_mst"].".tm_recipehd where cKdRecipe = '$_POST[fkey]' ";
    $conn->Execute($sql);
  }else{
    $sql = "update ".$config["db_mst"].".tm_recipehd set cAktif = 'F' where cKdBarang = '$_POST[fbarang]' ";
    $conn->Execute($sql);
    $sql = "update ".$config["db_mst"].".tm_recipehd set cAktif = 'T' where cKdRecipe = '$_POST[fid]' ";
    $conn->Execute($sql);
  }
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}

$admGrdTpl = new TGridTemplate($moduleid);
$sql  = "select hd.*, brg.vNamaBarang, CASE hd.cAktif WHEN 'T' THEN 'AKTIF' ELSE '' END AS vStatus "; 
$sql .= "from ".$config["db_mst"].".tm_recipehd hd ";
$sql .= "LEFT JOIN ".$config["db_mst"].".ms_barang brg ON brg.cKdBarang = hd.cKdBarang ";
if($_GET["key"] != "" || $_GET["mode"] == "form"){
  $sql .= " WHERE hd.cKdRecipe = '$_GET[key]' ";
}
$sql .= "ORDER BY brg.vNamaBarang ";
$admGrdTpl->moduleid  = $moduleid;
$admGrdTpl->delform   = "m=$moduleid&page=$_GET[page]";
$admGrdTpl->custSQL = $sql;
if($mode=="1"){
  $sql  = "SELECT dt.*, brg.vNamaBarang, sat.cAlias FROM ".$config["db_mst"].".tm_recipebrgdt dt ";
  $sql .= "LEFT JOIN ".$config["db_mst"].".ms_barang brg ON brg.cKdBarang = dt.cKdBarang ";
  $sql .= "LEFT JOIN ".$config["db_mst"].".ms_satuan sat ON sat.cSatuan = dt.cSatuan ";
  $sql .= "WHERE dt.cKdRecipe = '$_GET[key]' ";
  $admGrdTpl->template->MergeBlock("grid_dtl","adodb",$sql);
}
$gTpl = new TBlock("form.general_box");
$gTpl->name		= "gTpl";
$gTpl->title    = "Master Data Recipes";
$gTpl->display  = $admGrdTpl->Show(false);
$content = $gTpl->Show(false);

?>