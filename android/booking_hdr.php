<?php
require_once "../includes/global.inc.php";

$act = $_POST["act"];
$param["tglawal"] = $_POST["tglawal"];
$param["tglakhir"] = $_POST["tglakhir"];

$param["kdbook"] = $_POST["kdbook"];
$param["tglbook"] = $_POST["tglbook"];
$param["jambook"] = $_POST["jambook"]; 
$param["kdcust"] = $_POST["kdcust"];
$param["atasnama"] = $_POST["atasnama"];
$param["notelp"] = $_POST["notelp"];
$param["jmltamu"] = isset($_POST["jmltamu"]) ? $_POST["jmltamu"] : 0;
$param["uangmuka"] = isset($_POST["uangmuka"]) ? $_POST["uangmuka"] : 0;
$param["ket"] = $_POST["ket"];
$param["status"] = $_POST["status"];

$message = array();
$message["message"] = "Success";
$message["success"] = true;	
$message["code"] = 200;

function doinsert(){
global $conn, $config, $message, $param;   
  
  $kdbook = settransno("BOOK");
  $sql  = "INSERT INTO tr_bookinghd (cKdBooking,dTglBooking,dJamBooking,cKdCustomer,vAtasNama,vNoTelp,vJmlTamu,vUangMuka,cKeterangan,cStatus, ";
  $sql .= "cKdEntity,cUserCreated,dDateCreated,cUserModify,dDateModify) ";
  $sql .= "VALUES('$kdbook','$param[tglbook]','$param[jambook]','$param[kdcust]','$param[atasnama]','$param[notelp]',$param[jmltamu], ";
  $sql .= "$param[uangmuka],'$param[ket]','O', ";
  $sql .= "NULL,'$_SESSION[Logged]',CURRENT_TIMESTAMP,'$_SESSION[Logged]',CURRENT_TIMESTAMP) ";
  $rs = $conn->Execute($sql);
  if(!$rs){
	$message["message"] = "Failed. Error ".$conn->ErrorMsg();
	$message["success"] = false;	
	$message["code"] = 202;
  }

  return $message;
}

function doupdate(){
global $conn, $config, $message, $param;   
  
  $sql  = "SELECT COUNT(*) as jml FROM tr_bookinghd WHERE cKdBooking = '$param[kdbook]' ";   
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $sql  = "UPDATE tr_bookinghd SET dTglBooking = '$param[tglbook]',dJamBooking='$param[jambook]',cKdCustomer='$param[kdcust]',vAtasNama='$param[atasnama]', ";
    $sql .= "vNoTelp='$param[notelp]',vJmlTamu=$param[jmltamu],vUangMuka=$param[uangmuka],cKeterangan='$param[ket]', ";
    $sql .= "cStatus='$param[status]', cUserModify='$_SESSION[Logged]',dDateModify=CURRENT_TIMESTAMP ";
    $sql .= "WHERE cKdBooking = '$param[kdbook]' "; 
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

function dodelete(){
global $conn, $config, $message, $param;   
   
  $sql  = "SELECT COUNT(*) as jml FROM tr_bookinghd WHERE cKdBooking = '$param[kdbook]' ";   
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $sql = "DELETE FROM tr_bookinghd WHERE cKdBooking = '$param[kdbook]' ";
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

function setstatus(){
global $conn, $config, $message, $param;   
   
  $sql  = "SELECT COUNT(*) as jml FROM tr_bookinghd WHERE cKdBooking = '$param[kdbook]' ";   
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $sql = "UPDATE tr_bookinghd SET cStatus='$param[status]' WHERE cKdBooking = '$param[kdbook]' ";
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

  $where  = $param["kdbook"] != "" ? " AND cKdBooking = '$param[kdbook]' " : "";	
  $where .= ($param["tglawal"] != "") && ($param["tglakhir"] != "") ? " AND (dTglBooking >= '$param[tglawal]' AND dTglBooking <= '$param[tglakhir]' ) " : "";	
  $where .= $param["status"] != "" ? " AND cStatus = '$param[status]' " : "";	
  $sql  = "SELECT cKdBooking,DATE_FORMAT(dTglBooking,'%Y-%m-%d') as dTglBooking, DATE_FORMAT(dJamBooking,'%H:%i') as dJamBooking,cKdCustomer,vAtasNama,vNoTelp,";
  $sql .= "vJmlTamu,vUangMuka,cKeterangan,cStatus FROM tr_bookinghd ";
  $sql .= "WHERE cKdBooking IS NOT NULL $where ORDER BY dTglBooking ";
  $rs = $conn->Execute($sql);
  if($rs->RecordCount()==0){
	$message["message"] = "Empty data";
	$message["success"] = false;	
	$message["code"] = 202;
  }else{
	$message["booking"] = array();
	while(!$rs->EOF){
	  $datas = array();
	  $datas["kdbook"] = $rs->fields["cKdBooking"];
	  $datas["tglbook"] = $rs->fields["dTglBooking"];
	  $datas["jambook"] = $rs->fields["dJamBooking"];
	  $datas["kdcust"] = $rs->fields["cKdCustomer"];
	  $datas["atasnama"] = $rs->fields["vAtasNama"];
	  $datas["notelp"] = $rs->fields["vNoTelp"];
	  $datas["jmltamu"] = $rs->fields["vJmlTamu"];
	  $datas["uangmuka"] = $rs->fields["vUangMuka"];
	  $datas["ket"] = $rs->fields["cKeterangan"];
	  $datas["status"] = $rs->fields["cStatus"];
	  $message["bookhd"][] = $datas;
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