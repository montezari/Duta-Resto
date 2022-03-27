<?php
require_once "../includes/global.inc.php";

$data['sukses'] = false;
if($_POST['idpesan']!=""){

	$data['idpesan'] = $_POST['idpesan'];
	$sql  = "UPDATE tr_pesananhd SET cUserKitchen = '$_SESSION[Logged]', dTglCook = CURRENT_TIMESTAMP, cStatKitchen = 'P' WHERE cKdPesanan = '".$_POST['idpesan']."'";
	$rs = $conn->Execute($sql);
	if($rs){
	  $sql  = "UPDATE tr_pesanandt SET vQtyKitchen = 0, vQtyServed = 0, cStatKitchen = 'O' WHERE cKdPesanan = '".$_POST['idpesan']."'";
	  $rs = $conn->Execute($sql);
	  if($rs){
	    $data['sukses'] = true;
	  }
    }
}

echo json_encode($data);
?>
