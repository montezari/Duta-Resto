<?php
require_once "../includes/global.inc.php";

$act = $_POST["act"];

$param["kdpesan"] = $_POST["kdpesan"];
$param["tglpesan"] = $_POST["tglpesan"];
$param["idtamu"] = $_POST["idtamu"];
$param["ket"] = $_POST["ket"];
$param["status"] = $_POST["status"];
$param["statuskit"] = $_POST["statuskit"];
$param["userwaiter"] = $_POST["userid"];

$datas = array();
$message = array();
$message["message"] = "Success";
$message["success"] = true;	
$message["code"] = 200;

function doinsert(){
global $conn, $config, $message, $param;   
  
  if($param["idtamu"]!=""){
    $sql = "SELECT COUNT(*) AS jml FROM tr_pesananhd WHERE cIdTamu = '$param[idtamu]' ";
	$rs = $conn->Execute($sql);
	$jml = $rs->fields["jml"];
	++$jml;
	$nums = "000".$jml;
    $idheader = $param["idtamu"].substr($nums,-3);
    $sql  = "INSERT INTO tr_pesananhd (cKdPesanan,dTglPesanan,cIdTamu,cKeterangan,cStatus,cStatKitchen,cUserWaiter, ";
    $sql .= "dTglKirimKitchen,cKdEntity,cUserCreated,dDateCreated,cUserModify,dDateModify) ";
    //$sql .= "VALUES('$idheader',CURRENT_TIMESTAMP,'$param[idtamu]','$param[ket]','O','O','$param[userwaiter]', ";
	// langsung ke kitchen
	$sql .= "VALUES('$idheader',CURRENT_TIMESTAMP,'$param[idtamu]','$param[ket]','K','P','$param[userwaiter]', ";
    $sql .= "NULL,NULL,'$_SESSION[Logged]',CURRENT_TIMESTAMP,'$_SESSION[Logged]',CURRENT_TIMESTAMP) ";
    $rs = $conn->Execute($sql);
	//echo $sql; 
    if(!$rs){
	  $message["message"] = "Failed. Error ".$conn->ErrorMsg();
	  $message["success"] = false;	
	  $message["code"] = 202;
    }else{
	  $message["kdpesan"] = $idheader;	  
	}
  }else{
	$message["message"] = "Idtamu blank or null";
	$message["success"] = false;
	$message["kdpesan"] = "";
	$message["code"] = 202;
  }
  

  return $message;
}

function doupdate(){
global $conn, $config, $message, $param;   
  
  $sql  = "SELECT COUNT(*) as jml FROM tr_pesananhd WHERE cKdPesanan = '$param[kdpesan]' ";   
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $sql  = "UPDATE tr_pesananhd SET cKeterangan = '$param[ket]' ";
    $sql .= "WHERE cKdPesanan = '$param[kdpesan]' "; 
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
   
  $where  = $param["idtamu"] != "" ? " AND cIdTamu = '$param[idtamu]' " : "";	
  $where .= $param["kdpesan"] != "" ? " AND cKdPesanan = '$param[kdpesan]' " : "";	
  $sql  = "SELECT COUNT(*) as jml FROM tr_pesananhd WHERE cIdTamu IS NOT NULL $where ";   
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $sql = "DELETE FROM tr_pesanandt WHERE cIdTamu IS NOT NULL $where ";
    $rs = $conn->Execute($sql);
    $sql = "DELETE FROM tr_pesananhd WHERE cIdTamu IS NOT NULL $where ";
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

function setstatus(){
global $conn, $config, $message, $param;   
   
  $where  = $param["idtamu"] != "" ? " AND cIdTamu = '$param[idtamu]' " : "";	
  $where .= $param["kdpesan"] != "" ? " AND cKdPesanan = '$param[kdpesan]' " : "";	
  $sql  = "SELECT COUNT(*) as jml FROM tr_pesananhd WHERE cIdTamu IS NOT NULL $where ";   
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $sql = "UPDATE tr_pesananhd SET cStatus='$param[status]' WHERE cIdTamu IS NOT NULL $where ";
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

function doselect(){
global $conn, $config, $message, $param;   

  $where  = $param["idtamu"] != "" ? " AND hd.cIdTamu = '$param[idtamu]' " : "";	
  $where .= $param["kdpesan"] != "" ? " AND hd.cKdPesanan = '$param[kdpesan]' " : "";	
  $sql  = "SELECT hd.cKdPesanan,hd.dTglPesanan,hd.cIdTamu,hd.cKeterangan,hd.cStatus,hd.cStatKitchen,hd.cUserWaiter,hd.dTglKirimKitchen ";
  $sql .= "FROM tr_pesananhd hd ";
  $sql .= "WHERE hd.cIdTamu IS NOT NULL $where ORDER BY hd.cKdPesanan ";
  $rs = $conn->Execute($sql);
  if($rs->RecordCount()==0){
	$message["message"] = "Empty data";
	$message["success"] = false;	
	$message["code"] = 202;
  }else{
	$message["pesananhd"] = array();
	while(!$rs->EOF){
	  $datas = array();
	  $datas["kdpesan"] = $rs->fields["cKdPesanan"];
	  $datas["tglpesan"] = $rs->fields["dTglPesanan"];
	  $datas["idtamu"] = $rs->fields["cIdTamu"];
	  $datas["ket"] = $rs->fields["cKeterangan"];
	  $datas["status"] = $rs->fields["cStatus"];
	  $datas["statuskit"] = $rs->fields["cStatKitchen"];
	  $datas["userwaiter"] = $rs->fields["cUserWaiter"];
	  $message["pesananhd"][] = $datas;
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
  case "status":
   $msg = setstatus(); 
  break;
  case "select":
   $msg = doselect(); 
  break;
}
	
echo json_encode($msg);

?>