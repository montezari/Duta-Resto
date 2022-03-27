<?php
require_once "../includes/global.inc.php";

$act = $_POST["act"];

$param["idx"] = $_POST["idx"];
$param["kdbookdt"] = $_POST["kdbookdt"];
$param["kdbook"] = $_POST["kdbook"];
$param["kdtable"] = $_POST["kdtable"];
$param["status"] = $_POST["status"];
$param["ket"] = $_POST["ket"];

$message = array();
$message["message"] = "Success";
$message["success"] = true;	
$message["code"] = 200;

function doinsert(){
global $conn, $config, $message, $param;   
  
  if($param["kdbook"]!=""){
    if($param["idx"]!=""){
      $nums = "000".$param["idx"];
      $iddetail = $param["kdbook"].substr($nums,-3);
      $sql  = "INSERT INTO tr_bookingtabledt (cIdx,cKdBookingDt,cKdBooking,cKdTable,cStatus,cKeterangan) ";
      $sql .= "VALUES($param[idx],'$iddetail','$param[kdbook]','$param[kdtable]','O','$param[ket]') ";
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
	$message["message"] = "Booking code blank or null";
	$message["success"] = false;	
	$message["code"] = 202;
  }
  

  return $message;
}

function doupdate(){
global $conn, $config, $message, $param;   
  
  $sql  = "SELECT COUNT(*) as jml FROM tr_bookingtabledt WHERE cKdBookingDt = '$param[kdbookdt]' ";   
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $sql  = "UPDATE tr_bookingtabledt SET cKdTable = '$param[kdtable]',cStatus='$param[status]',cKeterangan='$param[ket]' ";
    $sql .= "WHERE cKdBookingDt = '$param[kdbookdt]' "; 
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
   
  $where  = $param["kdbook"] != "" ? " AND cKdBooking = '$param[kdbook]' " : "";	
  $where .= $param["kdbookdt"] != "" ? " AND cKdBookingDt = '$param[kdbookdt]' " : "";	
  $sql  = "SELECT COUNT(*) as jml FROM tr_bookingtabledt WHERE cKdBooking IS NOT NULL $where ";   
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $sql = "DELETE FROM tr_bookingtabledt WHERE cKdBooking IS NOT NULL $where ";
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
   
  $where  = $param["kdbook"] != "" ? " AND cKdBooking = '$param[kdbook]' " : "";	
  $where .= $param["kdbookdt"] != "" ? " AND cKdBookingDt = '$param[kdbookdt]' " : "";	
  $sql  = "SELECT COUNT(*) as jml FROM tr_bookingtabledt WHERE cKdBooking IS NOT NULL $where ";   
  $rs = $conn->Execute($sql);
  if($rs->fields["jml"]>0){
    $sql = "UPDATE tr_bookingtabledt SET cStatus='$param[status]' WHERE cKdBooking IS NOT NULL $where ";
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

  $where  = $param["kdbook"] != "" ? " AND dt.cKdBooking = '$param[kdbook]' " : "";	
  $where .= $param["kdbookdt"] != "" ? " AND dt.cKdBookingDt = '$param[kdbookdt]' " : "";	
  $sql  = "SELECT dt.cIdx, dt.cKdBookingDt, dt.cKdBooking, dt.cKdTable, tbl.vNmTable, dt.cStatus, dt.cKeterangan ";
  $sql .= "FROM tr_bookingtabledt dt ";
  $sql .= "LEFT JOIN ".$config["db_mst"].".ms_tablelayout tbl ON tbl.cKdTable = dt.cKdTable ";
  $sql .= "WHERE dt.cKdBooking IS NOT NULL $where ORDER BY dt.cIdx ";
  $rs = $conn->Execute($sql);
  if($rs->RecordCount()==0){
	$message["message"] = "Empty data";
	$message["success"] = false;	
	$message["code"] = 202;
  }else{
	$message["booking"] = array();
	while(!$rs->EOF){
	  $datas = array();
	  $datas["idx"] = $rs->fields["cIdx"];
	  $datas["kdbookdt"] = $rs->fields["cKdBookingDt"];
	  $datas["kdbook"] = $rs->fields["cKdBooking"];
	  $datas["kdtable"] = $rs->fields["cKdTable"];
	  $datas["nmtable"] = $rs->fields["vNmTable"];
	  $datas["status"] = $rs->fields["cStatus"];
	  $datas["ket"] = $rs->fields["cKeterangan"];
	  $message["booktbl"][] = $datas;
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