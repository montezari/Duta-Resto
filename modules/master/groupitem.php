<?php

$mode = $_REQUEST["mode"] == "form" ? 1 : 0;
$moduleid = "master.groupitem";

if(strtoupper($_POST["FormAction"])=="SIMPAN"){
  $val_andro = $_POST["showandro"] == "" ? "F" : $_POST["showandro"]; 
  $val_paket = $_POST["paket"] == "" ? "F" : $_POST["paket"]; 
  if($_POST["fkey"] != ""){
    $sql  = "update ".$config["db_mst"].".ms_grupbarang set vNmGrupBarang='$_POST[nama]', cShowAndroid='".$val_andro."',cPaket='".$val_paket."', ";
	$sql .= "cUserModify = '$_SESSION[Logged]', dDateModify = CURRENT_TIMESTAMP ";
    $sql .= "where cKdGrupBarang = '$_POST[fkey]' ";
  }else{
    $sql  = "INSERT INTO ".$config["db_mst"].".ms_grupbarang (cKdGrupBarang,vNmGrupBarang,cShowAndroid,cPaket,cUserCreated,dDateCreated,cUserModify,dDateModify) ";
    $sql .= "values('$_POST[kode]','$_POST[nama]','".$val_andro."','".$val_paket."', ";
	$sql .= "'$_SESSION[Logged]',CURRENT_TIMESTAMP,'$_SESSION[Logged]',CURRENT_TIMESTAMP) ";
  }
  $conn->Execute($sql); 
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}elseif(strtoupper($_POST["FormAction"])=="HAPUS"){
  $sql = "select count(*) as jml from ".$config["db_mst"].".ms_barang WHERE cKdGrupBarang = '$_POST[fkey]' ";
  $rs = $conn->Execute($sql); 	
  if($rs->fields["jml"]==0){
    $sql = "delete from ".$config["db_mst"].".ms_grupbarang WHERE cKdGrupBarang = '$_POST[fkey]' ";
    $conn->Execute($sql); 
    header("Location: $config[http]$_SERVER[REQUEST_URI]");
    exit;
  }else{
	echo "<script>alert('This data can not be deleted because it is in use.');</script>";
	echo "<script>window.location = 'index.php?m=$moduleid'</script>";
  }
}	

$admGrdTpl = new TGridTemplate($moduleid);
$sql  = "SELECT * FROM ".$config["db_mst"].".ms_grupbarang  ";
if($_GET["key"] != "" || $_GET["mode"] == "form"){
  $sql .= " WHERE cKdGrupBarang = '$_GET[key]' ";
}
$sql .= " ORDER BY cKdGrupBarang ";
$admGrdTpl->moduleid  = $moduleid;
$admGrdTpl->delform   = "m=$moduleid&page=$_GET[page]";
$admGrdTpl->custSQL = $sql;
$gTpl = new TBlock("form.general_box");
$gTpl->name		= "gTpl";
$gTpl->title    = "Master Group Item";
$gTpl->display  = $admGrdTpl->Show(false);
$content = $gTpl->Show(false);

?>