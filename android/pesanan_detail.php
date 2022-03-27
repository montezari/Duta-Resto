<?php
require_once "../includes/global.inc.php";

$act = $_POST["act"];
$param["data"] = $_POST["data"];
$param["kdpesandt"] = $_POST["kdpesandt"];
$param["kdpesan"] = $_POST["kdpesan"];
$param["idtamu"] = $_POST["idtamu"];
$param["qty"] = $_POST["qty"];
$param["qtybungkus"] = $_POST["qtybungkus"];
$param["ket"] = $_POST["ket"];

/*
$param["idx"] = $_POST["idx"];
$param["kdpesandt"] = $_POST["kdpesandt"];
$param["kdpesan"] = $_POST["kdpesan"];
$param["idtamu"] = $_POST["idtamu"];
$param["kdbarang"] = $_POST["kdbarang"];
$param["qty"] = isset($_POST["qty"]) ? $_POST["qty"] : 0;
$param["qtybungkus"] = isset($_POST["qtybungkus"]) ? $_POST["qtybungkus"] : 0;
$param["sat"] = $_POST["sat"];
$param["harga"] = isset($_POST["harga"]) ? $_POST["harga"] : 0;;
$param["discpers"] = isset($_POST["discpers"]) ? $_POST["discpers"] : 0;;
$param["disc"] = isset($_POST["disc"]) ? $_POST["disc"] : 0;;
$param["totalharga"] = isset($_POST["totalharga"]) ? $_POST["totalharga"] : 0;;
$param["ket"] = $_POST["ket"];
*/

$message = array();
$message["message"] = "Success";
$message["success"] = true;	
$message["code"] = 200;

function doinsert(){
global $conn, $config, $message, $param;   
  
  if(!empty($param["data"])){
	foreach($param["data"] as $k=>$v){
	  $data = explode("|",$v);  
	  foreach($data as $i=>$j){
		$detail = explode("=",$data[$i]); 			    
		$param[$detail[0]] = $detail[1];
	  }
      $nums = "000".$param["idx"];
      $iddetail = $param["kdpesan"].substr($nums,-3);
	  $sql  = "INSERT INTO tr_pesanandt (cIdx, cKdPesananDt, cKdPesanan, cIdTamu, cKdBarang, vQty, cSatuan, vHarga, cDiscPers, vDiscount, vTotalHarga, ";
	  $sql .= "cKeterangan, vQtyBungkus, vQtyKitchen, vQtyServed ) ";
      $sql .= "VALUES($param[idx],'$iddetail','$param[kdpesan]','$param[idtamu]','$param[kdbarang]',$param[qty],'$param[sat]', ";
	  $sql .= "$param[harga],$param[discpers],$param[disc],$param[totalharga], ";
	  $sql .= "'$param[ket]',$param[qtybungkus],0,0) ";
      $rs = $conn->Execute($sql);
	  if(!$rs){
		$message["message"] = "Failed. Error ".$conn->ErrorMsg();
		$message["success"] = false;	
		$message["code"] = 202;
	  }
	}
    $where = $param["kdpesan"] != "" ? " AND cKdPesanan = '$param[kdpesan]' " : "";	
    $sql  = "UPDATE tr_pesananhd SET cStatus='K', cStatKitchen='P', dTglKirimKitchen=CURRENT_TIMESTAMP ";
	$sql .= "WHERE cIdTamu IS NOT NULL $where ";
    $rs = $conn->Execute($sql);
  }else{
    $message["message"] = "detail data not defined";
    $message["success"] = false;	
    $message["code"] = 202;
  }
  /*
  if($param["kdpesan"]!=""){
    if($param["idx"]!=""){
      $nums = "000".$param["idx"];
      $iddetail = $param["kdpesan"].substr($nums,-3);
	  $sql  = "INSERT INTO tr_pesanandt (cIdx, cKdPesananDt, cKdPesanan, cIdTamu, cKdBarang, vQty, cSatuan, vHarga, cDiscPers, vDiscount, vTotalHarga, ";
	  $sql .= "cKeterangan, vQtyBungkus, vQtyKitchen, vQtyServed ) ";
      $sql .= "VALUES($param[idx],'$iddetail','$param[kdpesan]','$param[idtamu]','$param[kdbarang]',$param[qty],'$param[sat]', ";
	  $sql .= "$param[harga],$param[discpers],$param[disc],$param[totalharga], ";
	  $sql .= "'$param[ket]',$param[qtybungkus],0,0) ";
      $rs = $conn->Execute($sql);
	  if(!$rs){
		$message["message"] = "Failed. Error ".$conn->ErrorMsg();
		$message["success"] = false;	
		$message["code"] = 202;
	  }
    }else{
	  $message["message"] = "index detail blank or null";
	  $message["success"] = false;	
	  $message["code"] = 202;
    }
  }else{
	$message["message"] = "Idtamu blank or null";
	$message["success"] = false;	
	$message["code"] = 202;
  }
  */

  return $message;
}

function doupdate(){
global $conn, $config, $message, $param;   
  
  $sql  = "SELECT COUNT(*) as jml FROM tr_pesanandt WHERE cKdPesananDt = '$param[kdpesandt]' ";   
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $sql  = "UPDATE tr_pesanandt SET vQty='$param[qty]', vQtyBungkus='$param[qtybungkus]',cKeterangan='$param[ket]', vTotalHarga=vHarga*$param[qty] ";
    $sql .= "WHERE cKdPesananDt = '$param[kdpesandt]' "; 
    $rs = $conn->Execute($sql);
  }else{
	$message["message"] = "Data not found";
	$message["success"] = false;	
	$message["code"] = 202;
  }

  if(!$rs){
	$message["message"] = "Failed. Error ".$conn->ErrorMsg();
	$message["success"] = false;	
	$message["code"] = 202;
  }
   
   return $message;
}

function dodelete(){
global $conn, $config, $message, $param;   
   
  $where  = $param["kdpesan"] != "" ? " AND cKdPesanan = '$param[kdpesan]' " : "";	
  $where .= $param["kdpesandt"] != "" ? " AND cKdPesananDt = '$param[kdpesandt]' " : "";	
  $sql  = "SELECT COUNT(*) as jml FROM tr_pesanandt WHERE cIdTamu IS NOT NULL $where ";   
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $sql = "DELETE FROM tr_pesanandt WHERE cIdTamu IS NOT NULL $where ";
    $rs = $conn->Execute($sql);
  }else{
	$message["message"] = "Data not found";
	$message["success"] = false;	
	$message["code"] = 202;
  }
 
  if(!$rs){
	$message["message"] = "Failed. Error ".$conn->ErrorMsg();
	$message["success"] = false;	
	$message["code"] = 202;
  }
   
   return $message;
}

function doselect(){
global $conn, $config, $message, $param;   
  
  $where  = $param["kdpesan"] != "" ? " AND dt.cKdPesanan = '$param[kdpesan]' " : "";	
  $where .= $param["kdpesandt"] != "" ? " AND dt.cKdPesananDt = '$param[kdpesandt]' " : "";	
  $where .= $param["idtamu"] != "" ? " AND dt.cIdTamu = '$param[idtamu]' " : "";	
  if(($param["idtamu"]=="") && ($param["kdpesan"]!="")){ 
    $sql  = "SELECT dt.cIdx,dt.cKdPesananDt,dt.cKdPesanan,dt.cIdTamu,dt.cKdBarang,brg.vNamaBarang,dt.vQty,sat.cAlias, dt.cSatuan, ";
    $sql .= "dt.vHarga, dt.cDiscPers, dt.vDiscount, dt.vTotalHarga, dt.cKeterangan ";
    $sql .= "FROM tr_pesanandt dt ";
    $sql .= "LEFT JOIN ( ";
	$sql .= "SELECT cKdBarang, vNamaBarang, cSatuan FROM  ".$config["db_mst"].".ms_barang ";
	$sql .= "UNION ALL "; 
	$sql .= "SELECT cKdPaket, vNmPaket, '' AS cSatuan FROM  ".$config["db_mst"].".ms_pakethd ";	
	$sql .= " ) brg ON brg.cKdBarang = dt.cKdBarang ";
    $sql .= "LEFT JOIN ".$config["db_mst"].".ms_satuan sat ON sat.cSatuan = dt.cSatuan ";
    $sql .= "WHERE dt.cIdTamu IS NOT NULL $where ORDER BY dt.cIdx ";
  }elseif(($param["idtamu"]!="") && ($param["kdpesan"]=="")){
    $sql  = "SELECT @row_number:=@row_number+1 AS cIdx, '' as cKdPesananDt, '' as cKdPesanan, ";
	$sql .= "dt.cIdTamu,dt.cKdBarang,dt.vNamaBarang,dt.vQty,dt.cAlias, dt.cSatuan,dt.vHarga,dt.cDiscPers,dt.vDiscount,dt.vTotalHarga,dt.cKeterangan ";
	$sql .= "FROM (SELECT dt.cIdTamu,dt.cKdBarang,brg.vNamaBarang,SUM(dt.vQty) as vQty,sat.cAlias, dt.cSatuan, ";
    $sql .= "dt.vHarga, dt.cDiscPers, dt.vDiscount, SUM(dt.vTotalHarga) as vTotalHarga, '' as cKeterangan ";
    $sql .= "FROM tr_pesanandt dt ";
    $sql .= "LEFT JOIN ( ";
	$sql .= "SELECT cKdBarang, vNamaBarang, cSatuan FROM  ".$config["db_mst"].".ms_barang ";
	$sql .= "UNION ALL "; 
	$sql .= "SELECT cKdPaket, vNmPaket, '' AS cSatuan FROM  ".$config["db_mst"].".ms_pakethd ";	
	$sql .= " ) brg ON brg.cKdBarang = dt.cKdBarang ";
    $sql .= "LEFT JOIN ".$config["db_mst"].".ms_satuan sat ON sat.cSatuan = dt.cSatuan ";
    $sql .= "WHERE dt.cIdTamu IS NOT NULL $where ";
    $sql .= "GROUP BY dt.cIdTamu,dt.cKdBarang,brg.vNamaBarang,sat.cAlias, dt.cSatuan, dt.vHarga, dt.cDiscPers, dt.vDiscount ";
	$sql .= ") as dt, (SELECT @row_number:=0) AS t ";
	$sql .= "ORDER BY dt.cKdBarang ";
  }
  $rs = $conn->Execute($sql);
  if($rs->RecordCount()==0){
	$message["message"] = "Empty data";
	$message["success"] = false;	
	$message["code"] = 202;
  }else{
	$message["pesanandt"] = array();
	while(!$rs->EOF){
	  $datas = array();
	  $datas["idx"] = $rs->fields["cIdx"];
	  $datas["kdpesandt"] = $rs->fields["cKdPesananDt"];
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
	  $message["pesanandt"][] = $datas;
	  $rs->MoveNext();
	}
	$rs->Close();
  }
  
  return $message;
}

function doselect_gabungbill(){
global $conn, $config, $message, $param;   
  
  $listgabung = "";
  if(!empty($param["idtamu"])){
	/*
	$byk = count($param["data"]);
	$idx = 1;
	foreach($param["data"] as $k=>$v){
	  $data = explode("|",$v);  
	  foreach($data as $i=>$j){
		$detail = explode("=",$data[$i]); 			    
		$sep = $idx<$byk ? "," : "";
		$listgabung .= $detail[1].$sep;
	  }
	  $idx++;
    */
	$byk = count($param["idtamu"]);
	$idx = 1;
    foreach($param["idtamu"] as $i=>$j){
	  $sep = ($idx<$byk) ? "," : "";
	  $listgabung .= $j.$sep;
      $idx++;
    }
  }else{
	$message["message"] = "Empty data";
	$message["success"] = false;	
	$message["code"] = 202;
  }
  if($listgabung!=""){
    $where = "AND dt.cIdTamu IN ($listgabung) ";
	$sql  = "SELECT @row_number:=@row_number+1 AS cIdx, '' as cKdPesananDt, '' as cKdPesanan, ";
	$sql .= "dt.cIdTamu,dt.cKdBarang,dt.vNamaBarang,dt.vQty,dt.cAlias, dt.cSatuan,dt.vHarga,dt.cDiscPers,dt.vDiscount,dt.vTotalHarga,dt.cKeterangan ";
	$sql .= "FROM (SELECT dt.cIdTamu,dt.cKdBarang,brg.vNamaBarang,SUM(dt.vQty) as vQty,sat.cAlias, dt.cSatuan, ";
    $sql .= "dt.vHarga, dt.cDiscPers, dt.vDiscount, SUM(dt.vTotalHarga) as vTotalHarga, '' as cKeterangan ";
    $sql .= "FROM tr_pesanandt dt ";
    $sql .= "LEFT JOIN ( ";
	$sql .= "SELECT cKdBarang, vNamaBarang, cSatuan FROM  ".$config["db_mst"].".ms_barang ";
	$sql .= "UNION ALL "; 
	$sql .= "SELECT cKdPaket, vNmPaket, '' AS cSatuan FROM  ".$config["db_mst"].".ms_pakethd ";	
	$sql .= " ) brg ON brg.cKdBarang = dt.cKdBarang ";
    $sql .= "LEFT JOIN ".$config["db_mst"].".ms_satuan sat ON sat.cSatuan = dt.cSatuan ";
    $sql .= "WHERE dt.cIdTamu IS NOT NULL $where ";
    $sql .= "GROUP BY dt.cIdTamu,dt.cKdBarang,brg.vNamaBarang,sat.cAlias, dt.cSatuan, dt.vHarga, dt.cDiscPers, dt.vDiscount ";
	$sql .= ") as dt, (SELECT @row_number:=0) AS t ";
	$sql .= "ORDER BY dt.cKdBarang ";
  }
  $rs = $conn->Execute($sql);
  if($rs->RecordCount()==0){
	$message["message"] = "Empty data";
	$message["success"] = false;	
	$message["code"] = 202;
  }else{
	$message["pesanandt"] = array();
	while(!$rs->EOF){
	  $datas = array();
	  $datas["idx"] = $rs->fields["cIdx"];
	  $datas["kdpesandt"] = $rs->fields["cKdPesananDt"];
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
	  $message["pesanandt"][] = $datas;
	  $rs->MoveNext();
	}
	$rs->Close();
  }
  
  return $message;
}

function doselect_void(){
global $conn, $config, $message, $param;   
  
  $where  = $param["kdpesan"] != "" ? " AND dt.cKdPesanan = '$param[kdpesan]' " : "";	
  $where .= $param["kdpesandt"] != "" ? " AND dt.cKdPesananDt = '$param[kdpesandt]' " : "";	
  $where .= $param["idtamu"] != "" ? " AND dt.cIdTamu = '$param[idtamu]' " : "";	
  $sql  = "SELECT dt.cIdx,dt.cKdPesananDt,dt.cKdPesanan,dt.cIdTamu,dt.cKdBarang,brg.vNamaBarang,dt.vQty,sat.cAlias, dt.cSatuan, ";
  $sql .= "dt.vHarga, dt.cDiscPers, dt.vDiscount, dt.vTotalHarga, dt.cKeterangan, ";
  $sql .= "CASE WHEN brg.vImagePath <> '' THEN CONCAT('".$config["http_url"]."',brg.vImagePath) ";
  $sql .= "ELSE CONCAT('".$config["http_url"]."','/uploads/files/no_thumb.jpg') end as cImagePath ";
  $sql .= "FROM tr_pesanandt dt ";
  $sql .= "LEFT JOIN ( ";
  $sql .= "SELECT cKdBarang, vNamaBarang, cSatuan, vImagePath FROM  ".$config["db_mst"].".ms_barang ";
  $sql .= "UNION ALL "; 
  $sql .= "SELECT cKdPaket, vNmPaket, '' AS cSatuan, vImagePath FROM  ".$config["db_mst"].".ms_pakethd ";	
  $sql .= " ) brg ON brg.cKdBarang = dt.cKdBarang ";
  $sql .= "LEFT JOIN ".$config["db_mst"].".ms_satuan sat ON sat.cSatuan = dt.cSatuan ";
  $sql .= "WHERE dt.cIdTamu IS NOT NULL $where ORDER BY dt.cIdx ";
  $rs = $conn->Execute($sql);
  if($rs->RecordCount()==0){
	$message["message"] = "Empty data";
	$message["success"] = false;	
	$message["code"] = 202;
  }else{
	$message["pesanandt"] = array();
	while(!$rs->EOF){
	  $datas = array();
	  $datas["idx"] = $rs->fields["cIdx"];
	  $datas["kdpesandt"] = $rs->fields["cKdPesananDt"];
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
      $datas["image_product"] = $rs->fields["cImagePath"];
	  $message["pesanandt"][] = $datas;
	  $rs->MoveNext();
	}
	$rs->Close();
  }
  
  return $message;
}

switch($act){
  case "insert":
   $msg = doinsert(); 
  break;
  case "update":
   $msg = doupdate(); 
  break;
  case "delete":
   $msg = dodelete(); 
  break;
  case "select":
   $msg = doselect(); 
  break;
  case "select_gabungbill":
   $msg = doselect_gabungbill(); 
  break;
  case "select_void":
   $msg = doselect_void(); 
  break;
}
	
echo json_encode($msg);

?>