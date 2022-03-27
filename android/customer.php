<?php
require_once "../includes/global.inc.php";

$act = $_POST["act"];
$param["kdcust"] = $_POST["kdcust"];
$param["nmcust"] = $_POST["nmcust"];
$param["alamat"] = $_POST["alamat"]; 
$param["kota"] = $_POST["kota"];
$param["telp"] = $_POST["telp"];
$param["email"] = $_POST["email"];
$param["jk"] = $_POST["jk"];
$param["status"] = $_POST["status"];

$message = array();
$message["message"] = "Success";
$message["success"] = true;	
$message["code"] = 200;

function doinsert(){
global $conn, $config, $message, $param;   
  
  $sql  = "INSERT INTO ".$config["db_mst"].".ms_customer (cKdCustomer,vNmCustomer,vAlamat,cKota,cTelp,cEmail,cJenisKelamin, cStatus, ";
  $sql .= "cUserCreated,dDateCreated,cUserModify,dDateModify) ";
  $sql .= "VALUES('$param[kdcust]','$param[nmcust]','$param[alamat]','$param[kota]','$param[telp]','$param[email]','$param[jk]','T', ";
  $sql .= "'$_SESSION[Logged]',CURRENT_TIMESTAMP,'$_SESSION[Logged]',CURRENT_TIMESTAMP) ";
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
  
  $sql  = "SELECT COUNT(*) as jml FROM ".$config["db_mst"].".ms_customer WHERE cKdCustomer = '$param[kdcust]' ";   
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $sql  = "UPDATE ".$config["db_mst"].".ms_customer SET vNmCustomer = '$param[nmcust]',vAlamat='$param[alamat]',cKota='$param[kota]',cTelp='$param[telp]', ";
    $sql .= "cEmail='$param[email]',cJenisKelamin=$param[jk],cStatus='$param[status]', ";
    $sql .= "cUserModify='$_SESSION[Logged]',dDateModify=CURRENT_TIMESTAMP ";
    $sql .= "WHERE cKdCustomer = '$param[kdcust]' "; 
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
   
  $sql  = "SELECT COUNT(*) as jml FROM ".$config["db_mst"].".ms_customer WHERE cKdCustomer = '$param[kdcust]' ";   
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $sql = "DELETE FROM ".$config["db_mst"].".ms_customer WHERE cKdCustomer = '$param[kdcust]' ";
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
   
  $sql  = "SELECT COUNT(*) as jml FROM ".$config["db_mst"].".ms_customer WHERE cKdCustomer = '$param[kdcust]' ";   
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $sql = "UPDATE ".$config["db_mst"].".ms_customer SET cStatus='$param[status]' WHERE cKdCustomer = '$param[kdcust]' ";
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

  $where  = $param["kdcust"] != "" ? " AND cKdCustomer = '$param[kdcust]' " : "";	
  $where .= $param["nmcust"] != "" ? " AND vNmCustomer LIKE '%$param[nmcust]%' " : "";	
  $where .= $param["status"] != "" ? " AND cStatus = '$param[status]' " : "";	
  $sql  = "SELECT * FROM ".$config["db_mst"].".ms_customer ";
  $sql .= "WHERE cKdCustomer IS NOT NULL $where ORDER BY vNmCustomer ";
  $rs = $conn->Execute($sql);
  if($rs->RecordCount()==0){
	$message["message"] = "Empty data";
	$message["success"] = false;	
	$message["code"] = 202;
  }else{
	$message["customer"] = array();
	while(!$rs->EOF){
	  $datas = array();
	  $datas["kdcust"] = $rs->fields["cKdCustomer"];
	  $datas["nmcust"] = $rs->fields["vNmCustomer"];
	  $datas["alamat"] = $rs->fields["vAlamat"];
	  $datas["kota"] = $rs->fields["cKota"];
	  $datas["telp"] = $rs->fields["cTelp"];
	  $datas["email"] = $rs->fields["cEmail"];
	  $datas["jk"] = $rs->fields["cJenisKelamin"];
	  $datas["status"] = $rs->fields["cStatus"];
	  $message["customer"][] = $datas;
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