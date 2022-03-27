<?php
require_once "../includes/global.inc.php";

if($_POST['onprogress-fkey']!=""){
	foreach($_POST["idpesandt"] as $key => $value){
	  $qty = isset($_POST['qtykitchen'][$key]) && ($_POST['qtykitchen'][$key]!="") ? $_POST['qtykitchen'][$key] : 0;
	  $sql  = "UPDATE tr_pesanandt SET  vQtyKitchen = COALESCE(vQtyKitchen,0)+".$qty." WHERE cKdPesananDt = '".$_POST['idpesandt'][$key]."'";
	  $conn->Execute($sql);
	}	
	// jika sudah selesai semua set cStatKitchen = 'F'
	$sql  = "SELECT COUNT(*) AS jml FROM tr_pesanandt dt ";
	$sql .= "WHERE cKdPesanan = '".$_POST['onprogress-fkey']."' AND (dt.vQty-COALESCE(dt.vQtyKitchen,0)) <> 0 ";
	$rs = $conn->Execute($sql);
	if($rs->fields["jml"]=="0"){
	  $sql  = "UPDATE tr_pesananhd SET  cStatKitchen = 'F' WHERE cKdPesanan = '".$_POST['onprogress-fkey']."' ";
	  $conn->Execute($sql);
	}

}
echo "Succees update order.";
?>
