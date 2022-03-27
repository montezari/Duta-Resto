<?php
require_once "../includes/global.inc.php";

$act = $_POST["act"];

$param["idx"] = $_POST["idx"];
$param["kdpesan"] = $_POST["kdpesan"];
$param["idtamu"] = $_POST["idtamu"];
$param["status"] = $_POST["status"];
$param["statuskitchen"] = $_POST["statuskitchen"];
$param["ketkithen"] = $_POST["ketkithen"];

$message = array();
$message["message"] = "Success";
$message["success"] = true;	
$message["code"] = 200;

function setstatus(){
global $conn, $config, $message, $param;   
   
  $where  = $param["idtamu"] != "" ? " AND cIdTamu = '$param[idtamu]' " : "";	
  $where .= $param["kdpesan"] != "" ? " AND cKdPesanan = '$param[kdpesan]' " : "";	
  $sql  = "SELECT COUNT(*) as jml FROM tr_pesananhd WHERE cIdTamu IS NOT NULL $where ";   
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $sql  = "UPDATE tr_pesananhd SET cStatus='$param[status]', cStatKitchen='$param[statuskitchen]' ";
	$sql .= "WHERE cIdTamu IS NOT NULL $where ";
    $rs = $conn->Execute($sql);
    if(!$rs){
	  $message["message"] = "Failed. Error ".$conn->ErrorMsg();
	  $message["success"] = false;	
	  $message["code"] = 202;
    }
  }else{
	$message["message"] = "Data not found";
	$message["success"] = false;	
	$message["code"] = 202;
  }
  
   
   return $message;
}

function sendtokitchen(){
global $conn, $config, $message, $param;   
   
  $where  = $param["idtamu"] != "" ? " AND cIdTamu = '$param[idtamu]' " : "";	
  $where .= $param["kdpesan"] != "" ? " AND cKdPesanan = '$param[kdpesan]' " : "";	
  $sql  = "SELECT COUNT(*) as jml FROM tr_pesananhd WHERE cIdTamu IS NOT NULL $where ";   
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $sql  = "UPDATE tr_pesananhd SET cStatus='K', cStatKitchen='P', dTglKirimKitchen=CURRENT_TIMESTAMP ";
	$sql .= "WHERE cIdTamu IS NOT NULL $where ";
    $rs = $conn->Execute($sql);
    if(!$rs){
	  $message["message"] = "Failed. Error ".$conn->ErrorMsg();
	  $message["success"] = false;	
	  $message["code"] = 202;
    }
  }else{
	$message["message"] = "Data not found";
	$message["success"] = false;	
	$message["code"] = 202;
  }
  
   
   return $message;
}

function getalert(){
global $conn, $config, $message, $param;   
   
  $where  = $param["idtamu"] != "" ? " AND cIdTamu = '$param[idtamu]' " : "";	
  $where .= $param["kdpesan"] != "" ? " AND cKdPesanan = '$param[kdpesan]' " : "";	
  $sql  = "SELECT COUNT(*) as jml FROM tr_pesananhd WHERE cIdTamu IS NOT NULL AND cStatus='K' AND cStatKitchen = 'F' $where ";   
  $rs = $conn->Execute($sql);
  $datas = array();
  $datas["finishitem"] = $rs->fields["jml"];
  $message["pesanan"][] = $datas;
  if(!$rs){
	$message["message"] = "Failed. Error ".$conn->ErrorMsg();
	$message["success"] = false;	
	$message["code"] = 202;
  }
  
   return $message;
}

function doselect(){
global $conn, $config, $message, $param;   

/*
  $where  = $param["idtamu"] != "" ? " AND dt.cIdTamu = '$param[idtamu]' " : "";	
  $where .= $param["kdpesan"] != "" ? " AND dt.cKdPesanan = '$param[kdpesan]' " : "";	
  $where .= $param["status"] != "" ? " AND dt.cStatus = '$param[status]' " : "";	
  $where .= $param["statuskitchen"] != "" ? " AND dt.cStatKitchen = '$param[statuskitchen]' " : "";	
  $sql  = "SELECT dt.cIdx,dt.cKdPesanan,hd.cIdTamu,dt.cKdBarang,brg.vNamaBarang,dt.vQty,sat.cAlias, dt.cSatuan, ";
  $sql .= "dt.vHarga, dt.cDiscPers, dt.vDiscount, dt.vTotalHarga, hd.cStatus,dt.cKeterangan,hd.cStatKitchen,hd.cKetKitchen ";
  $sql .= "FROM tr_pesanandt dt ";
  $sql .= "LEFT JOIN tr_pesananhd hd ON hd.cKdPesanan = dt.cKdPesanan ";
  $sql .= "LEFT JOIN ".$config["db_mst"].".ms_barang brg ON brg.cKdBarang = dt.cKdBarang ";
  $sql .= "LEFT JOIN ".$config["db_mst"].".ms_satuan sat ON sat.cSatuan = dt.cSatuan ";
  $sql .= "WHERE dt.cIdTamu IS NOT NULL $where ORDER BY dt.cIdx ";
  $rs = $conn->Execute($sql);
  if($rs->RecordCount()==0){
	$message["message"] = "Empty data";
	$message["success"] = false;	
	$message["code"] = 202;
  }else{
	$message["kitchen"] = array();
	while(!$rs->EOF){
	  $datas = array();
	  $datas["idx"] = $rs->fields["cIdx"];
	  $datas["kdpesan"] = $rs->fields["cKdPesanan"];
	  $datas["idtamu"] = $rs->fields["cIdTamu"];
	  $datas["kdbarang"] = $rs->fields["cKdBarang"];
	  $datas["nmbarang"] = $rs->fields["vNamaBarang"];
	  $datas["qty"] = $rs->fields["vQty"];
	  $datas["sat"] = $rs->fields["cSatuan"];
	  $datas["nsat"] = $rs->fields["cAlias"];
	  $datas["harga"] = round($rs->fields["vHarga"]);
	  $datas["discpers"] = round($rs->fields["cDiscPers"]);
	  $datas["disc"] = round($rs->fields["vDiscount"]);
	  $datas["totalharga"] = round($rs->fields["vTotalHarga"]);
	  $datas["ket"] = $rs->fields["cKeterangan"];
	  $datas["status"] = $rs->fields["cStatus"];
	  $datas["statuskitchen"] = $rs->fields["cStatKitchen"];
	  $datas["ketkithen"] = $rs->fields["cKetKitchen"];
	  $message["kitchen"][] = $datas;
	  $rs->MoveNext();
	}
	$rs->Close();
  }
*/

  $where  = $param["idtamu"] != "" ? " AND cIdTamu = '$param[idtamu]' " : "";	
  $where .= $param["kdpesan"] != "" ? " AND cKdPesanan = '$param[kdpesan]' " : "";	
  $where .= $param["status"] != "" ? " AND cStatus = '$param[status]' " : "";	
  $where .= $param["statuskitchen"] != "" ? " AND cStatKitchen = '$param[statuskitchen]' " : "";	
  $sql  = "SELECT * from tr_pesananhd WHERE cIdTamu IS NOT NULL $where ORDER BY cKdPesanan ";
  $rs = $conn->Execute($sql);
  if($rs->RecordCount()==0){
	$message["message"] = "Empty data";
	$message["success"] = false;	
	$message["code"] = 202;
  }else{
	$message["kitchen"] = array();
	while(!$rs->EOF){
	  $datas = array();
	  $datas["kdpesan"] = $rs->fields["cKdPesanan"];
	  $datas["tglpesan"] = $rs->fields["dTglPesanan"];
	  $datas["idtamu"] = $rs->fields["cIdTamu"];
	  $datas["ket"] = $rs->fields["cKeterangan"];
	  $datas["status"] = $rs->fields["cStatus"];
	  $datas["statuskitchen"] = $rs->fields["cStatKitchen"];
	  $datas["userwaiter"] = $rs->fields["cUserWaiter"];
	  $datas["tglkirimkitchen"] = $rs->fields["dTglKirimKitchen"];
	  $datas["userkitchen"] = $rs->fields["cUserKitchen"];
	  $datas["tglcook"] = $rs->fields["dTglCook"];
	  $datas["ketkithen"] = $rs->fields["cKetKitchen"];
	  $message["kitchen"][] = $datas;
	  $rs->MoveNext();
	}
	$rs->Close();
  }

  return $message;
}

switch($act){
  case "status":
   $msg = setstatus(); 
  break;
  case "sendkitchen":
   $msg = sendtokitchen(); 
  break;
  case "select":
   $msg = doselect(); 
  break;
  case "alert":
   $msg = getalert(); 
  break;
}
	
echo json_encode($msg);

?>