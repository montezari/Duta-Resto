<?php
require_once "../includes/global.inc.php";

$act = $_POST["act"];
$param["data"] = $_POST["data"];
$param["idtamu"] = $_POST["idtamu"];
$param["kodemeja"] = $_POST["kode_meja"];
$param["totalinv"] = $_POST["totalinv"];
$param["invgross"] = isset($_POST["invgross"]) ? $_POST["invgross"] : 0;
$param["invpajak"] = isset($_POST["invpajak"]) ? $_POST["invpajak"] : 0;
$param["invpajakpers"] = isset($_POST["invpajakpers"]) ? $_POST["invpajakpers"] : 0;
$param["invdisc"] = isset($_POST["invdisc"]) ? $_POST["invdisc"] : 0;
$param["invdiscpers"] = isset($_POST["invdiscpers"]) ? $_POST["invdiscpers"] : 0;
$param["invlain"] = isset($_POST["invlain"]) ? $_POST["invlain"] : 0;
$param["invnetto"] = isset($_POST["invnetto"]) ? $_POST["invnetto"] : 0;
$param["chktunai"] = $_POST["chktunai"];
$param["tottunai"] = isset($_POST["tottunai"]) ? $_POST["tottunai"] : 0;
$param["uangtunai"] = isset($_POST["uangtunai"]) ? $_POST["uangtunai"] : 0;
$param["chkcard"] = $_POST["chkcard"];
$param["nokartu"] = $_POST["nokartu"];
$param["notrans"] = $_POST["notrans"];
$param["totcard"] = isset($_POST["totcard"]) ? $_POST["totcard"] : 0;
$param["biayapers"] = isset($_POST["biayapers"]) ? $_POST["biayapers"] : 0;
$param["biaya"] = isset($_POST["biaya"]) ? $_POST["biaya"] : 0;
$param["userkasir"] = $_POST["userid"];

$message = array();
$message["message"] = "Success";
$message["success"] = true;	
$message["code"] = 200;

function dopayment(){
global $conn, $config, $message, $param;   

  if(!empty($param["idtamu"])){
	$byk = count($param["idtamu"]);
	$idx = 1;
	$totalinv = 0;
	$invno = settransno("INV");
	// simpan detail dlu
	/*
	foreach($param["data"] as $k=>$v){
	  $data = explode("|",$v);  
	  foreach($data as $i=>$j){
		$detail = explode("=",$data[$i]); 			    
		$param[$detail[0]] = $detail[1];
	  }
	*/
	foreach($param["idtamu"] as $i=>$j){
	  $idtamu = $j;
	  if($idtamu==""){
  	    // jika yg di lempar adalah kode meja
		/*
		$invno = settransno("INV");
        $nums = "000".$param["idx"];
        $iddetail = $invno.substr($nums,-3);
	    $sql = "SELECT cIdTamu FROM tr_tamu WHERE cStatus = 'O' AND cKdTable='$param[kode_meja]' ";   
	    $rs = $conn->Execute($sql);
	    $param["idtamu"] = $rs->fields["cIdTamu"];
		$sql = "SELECT SUM(vTotalHarga) AS vTotalInv FROM tr_pesanandt WHERE cIdTamu = '$param[idtamu]' ";
		$rs = $conn->Execute($sql);
		$param["totalinv"] = $rs->fields["vTotalInv"];
	    $totalinv += $rs->fields["vTotalInv"];
	    */
		$message["message"] = "Id tamu not defined.";
		$message["success"] = false;	
		$message["code"] = 202;
	  }else{
  	    // jika yg di lempar adalah id tamu
        $nums = "000".$idx;
        $iddetail = $invno.substr($nums,-3);
		$sql = "SELECT SUM(vTotalHarga) AS vTotalInv FROM tr_pesanandt WHERE cIdTamu = '$idtamu' ";
		$rs = $conn->Execute($sql);
		$param["totalinv"] = $rs->fields["vTotalInv"];
	    $totalinv += $rs->fields["vTotalInv"];
	  }	  
	  if($idtamu!=""){
		$sql  = "INSERT INTO tr_fakturdt (cNoInvDt,cNoInv,cIdTamu,vTotalInv) values (";
	    $sql .= "'$iddetail','$invno','$idtamu','$param[totalinv]') ";	
	    $rs = $conn->Execute($sql);
	    if($rs){
	       $sql = "UPDATE tr_tamu SET cStatus = 'F' WHERE cIdTamu = '$idtamu' ";   
		   $rs = $conn->Execute($sql);
	       if(!$rs){
			  $message["message"] = "Failed. Error ".$conn->ErrorMsg();
			  $message["success"] = false;	
			  $message["code"] = 202;
		   }
		}else{  
		  $message["message"] = "Failed. Error ".$conn->ErrorMsg();
		  $message["success"] = false;	
		  $message["code"] = 202;
	    }
	  }else{
		$message["message"] = "Id tamu by kode meja not defined.";
		$message["success"] = false;	
		$message["code"] = 202;
	  }
	  $idx++;
	}
	if($message["code"]!=202){
	  // simpan header
	  $totalinv = ($totalinv=="") ? 0 : $totalinv;
	  $param["invpajak"] = str_replace(",","",$param["invpajak"]);
	  $param["invdisc"] = str_replace(",","",$param["invdisc"]);
	  $param["invlain"] = str_replace(",","",$param["invlain"]);
	  $param["invnetto"] = str_replace(",","",$param["invnetto"]);
	  $param["tottunai"] = str_replace(",","",$param["tottunai"]);
	  $param["uangtunai"] = str_replace(",","",$param["uangtunai"]);
	  $param["totcard"] = str_replace(",","",$param["totcard"]);
	  $param["biaya"] = str_replace(",","",$param["biaya"]);
      $sql  = "INSERT INTO tr_fakturhd (cNoInv,dTglInv,cStatus,nInvGross,nInvPajak,nInvPajakPrs,nInvDisc,nInvDiscPrs,nInvLain,nInvNetto, ";
	  $sql .= "cTunai,vTotalTunai,vUangTunai,cDKCard,cNoKartu,cNoTransaksi,vTotalDKCard,cDKBiayaPers,cDKBiaya, ";
	  $sql .= "cUserKasir,cKdEntity,cUserCreated,dDateCreated,cUserModify,dDateModify) values (";
      $sql .= "'$invno',CURRENT_TIMESTAMP,'F',$totalinv,$param[invpajak],$param[invpajakpers],$param[invdisc],$param[invdiscpers], ";
	  $sql .= "$param[invlain],$param[invnetto],'$param[chktunai]',$param[tottunai],$param[uangtunai],'$param[chkcard]','$param[nokartu]', ";
	  $sql .= "'$param[notrans]',$param[totcard],$param[biayapers],$param[biaya], ";
	  $sql .= "'$param[userkasir]',NULL,'$_SESSION[Logged]',CURRENT_TIMESTAMP,'$_SESSION[Logged]',CURRENT_TIMESTAMP) ";
      $rs = $conn->Execute($sql);
	  if(!$rs){
	    $message["message"] = "Failed. Error ".$conn->ErrorMsg();
	    $message["success"] = false;	
	    $message["code"] = 202;
	  }
    }
  }else{
	$message["message"] = "Data table to payment not defined.";
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

function dopayment_gabungbill(){
global $conn, $config, $message, $param;   

  if(!empty($param["idtamu"])){
	$byk = count($param["idtamu"]);
	$idx = 1;
	$totalinv = 0;
	$invno = settransno("INV");
	// simpan detail dlu
	foreach($param["idtamu"] as $i=>$j){
	  $idtamu = $j;
	  if($idtamu==""){
		$message["message"] = "Id tamu not defined.";
		$message["success"] = false;	
		$message["code"] = 202;
	  }else{
  	    // jika yg di lempar adalah id tamu
        $nums = "000".$idx;
        $iddetail = $invno.substr($nums,-3);
		$sql = "SELECT SUM(vTotalHarga) AS vTotalInv FROM tr_pesanandt WHERE cIdTamu = '$idtamu' ";
		$rs = $conn->Execute($sql);
		$param["totalinv"] = $rs->fields["vTotalInv"];
	    $totalinv += $rs->fields["vTotalInv"];
	  }	  
	  if($idtamu!=""){
		$sql  = "INSERT INTO tr_fakturdt (cNoInvDt,cNoInv,cIdTamu,vTotalInv) values (";
	    $sql .= "'$iddetail','$invno','$idtamu','$param[totalinv]') ";	
	    $rs = $conn->Execute($sql);
	    if($rs){
	       $sql = "UPDATE tr_tamu SET cStatus = 'F' WHERE cIdTamu = '$idtamu' ";   
		   $rs = $conn->Execute($sql);
	       if(!$rs){
			  $message["message"] = "Failed. Error ".$conn->ErrorMsg();
			  $message["success"] = false;	
			  $message["code"] = 202;
		   }
		}else{  
		  $message["message"] = "Failed. Error ".$conn->ErrorMsg();
		  $message["success"] = false;	
		  $message["code"] = 202;
	    }
	  }else{
		$message["message"] = "Id tamu by kode meja not defined.";
		$message["success"] = false;	
		$message["code"] = 202;
	  }
	  $idx++;
	}

	if($message["code"]!=202){
	  // simpan header
	  $totalinv = ($totalinv=="") ? 0 : $totalinv;
	  $param["invpajak"] = str_replace(",","",$param["invpajak"]);
	  $param["invdisc"] = str_replace(",","",$param["invdisc"]);
	  $param["invlain"] = str_replace(",","",$param["invlain"]);
	  $param["invnetto"] = str_replace(",","",$param["invnetto"]);
	  $param["tottunai"] = str_replace(",","",$param["tottunai"]);
	  $param["uangtunai"] = str_replace(",","",$param["uangtunai"]);
	  $param["totcard"] = str_replace(",","",$param["totcard"]);
	  $param["biaya"] = str_replace(",","",$param["biaya"]);
      $sql  = "INSERT INTO tr_fakturhd (cNoInv,dTglInv,cStatus,nInvGross,nInvPajak,nInvPajakPrs,nInvDisc,nInvDiscPrs,nInvLain,nInvNetto, ";
	  $sql .= "cTunai,vTotalTunai,vUangTunai,cDKCard,cNoKartu,cNoTransaksi,vTotalDKCard,cDKBiayaPers,cDKBiaya, ";
	  $sql .= "cUserKasir,cKdEntity,cUserCreated,dDateCreated,cUserModify,dDateModify) values (";
      $sql .= "'$invno',CURRENT_TIMESTAMP,'F',$totalinv,$param[invpajak],$param[invpajakpers],$param[invdisc],$param[invdiscpers], ";
	  $sql .= "$param[invlain],$param[invnetto],'$param[chktunai]',$param[tottunai],$param[uangtunai],'$param[chkcard]','$param[nokartu]', ";
	  $sql .= "'$param[notrans]',$param[totcard],$param[biayapers],$param[biaya], ";
	  $sql .= "'$param[userkasir]',NULL,'$_SESSION[Logged]',CURRENT_TIMESTAMP,'$_SESSION[Logged]',CURRENT_TIMESTAMP) ";
      $rs = $conn->Execute($sql);
	  if(!$rs){
	    $message["message"] = "Failed. Error ".$conn->ErrorMsg();
	    $message["success"] = false;	
	    $message["code"] = 202;
	  }
    }
  }else{
	$message["message"] = "Data table to payment not defined.";
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

switch($act){
  case "payment":
   $msg = dopayment(); 
  break;
  case "payment_gabungbill":
   $msg = dopayment_gabungbill(); 
  break;
}

echo json_encode($msg);

?>