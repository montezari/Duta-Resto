<?php
require_once "includes/global.inc.php";

$valid = true;
if (($_REQUEST["m"] == "master.entity") && isset($_GET['kode'])){
  $sql = "SELECT COUNT(*) as jml FROM ".$config["db_mst"].".ms_entity WHERE cKdEntity = '".$_GET['kode']."' ";
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $valid=false;
  }
}
if (($_REQUEST["m"] == "master.dept") && isset($_GET['kode'])){
  $sql = "SELECT COUNT(*) as jml FROM ".$config["db_mst"].".ms_dept WHERE cKdDept = '".$_GET['kode']."' ";
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $valid=false;
  }
}
if (($_REQUEST["m"] == "master.satuan") && isset($_GET['kode'])){
  $sql = "SELECT COUNT(*) as jml FROM ".$config["db_mst"].".ms_satuan WHERE cSatuan = '".$_GET['kode']."' ";
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $valid=false;
  }
}
if (($_REQUEST["m"] == "master.groupitem") && isset($_GET['kode'])){
  $sql = "SELECT COUNT(*) as jml FROM ".$config["db_mst"].".ms_grupbarang WHERE cKdGrupBarang = '".$_GET['kode']."' ";
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $valid=false;
  }
}
if (($_REQUEST["m"] == "master.table") && isset($_GET['nama'])){
  $sql = "SELECT COUNT(*) as jml FROM ".$config["db_mst"].".ms_tablelayout WHERE vNmTable = '".$_GET['nama']."' ";
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $valid=false;
  }
}
if (($_REQUEST["m"] == "master.items") && isset($_GET['kode'])){
  $sql = "SELECT COUNT(*) as jml FROM ".$config["db_mst"].".ms_barang WHERE cKdBarang = '".$_GET['kode']."' ";
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $valid=false;
  }
}
if (($_REQUEST["m"] == "master.paket") && isset($_GET['kode'])){
  $sql = "SELECT COUNT(*) as jml FROM ".$config["db_mst"].".ms_pakethd WHERE cKdPaket = '".$_GET['kode']."' ";
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $valid=false;
  }
}
if (($_REQUEST["m"] == "user.user") &&  isset($_GET['user'])){
  $sql = "SELECT COUNT(*) as jml FROM tsm_pemakai WHERE cUserName = '".$_GET['user']."' and cUserId <> '".$_GET['id']."' ";
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $valid=false;
  }
}


echo json_encode(array(
    'valid' => $valid
));

?>