<?php

require_once "../includes/global.inc.php";

	if($_POST){

		$act = $_POST["act"];
		$idtamu = $_POST['idtamu'];
		$waiter = $_POST['userid'];
		$flag = $_POST['flag'];
		$kode_meja = $_POST['kode_meja'];
		$kode_meja_update = $_POST['kode_meja_update'];
		$jumlah_tamu = $_POST['jumlah_tamu'];
		$status = $_POST['status'];
		$kode_customer = isset($_POST['kode_customer']) && $_POST['kode_customer']!="" ? "'".$_POST['kode_customer']."'" : "NULL";
		$name_customer = $_POST['name_customer'];
		$telp = $_POST['telp'];
		$alamat = $_POST['alamat'];
		$email = $_POST['email'];
		
		$message = array();
        $message["message"] = "Success";
		$message["success"] = true;	
		$message["code"] = 200;
		
		function doinsert(){ 
		global $conn, $config, $message;
		global $idtamu,$waiter,$flag,$kode_meja,$jumlah_tamu,$status,$kode_customer,$name_customer,$telp,$alamat,$email;
		  // DI : Dine In, TA : Take Away, DL : Delivery
		  //$nums = "000".$_SESSION["Logged"];
		  //$idtamu = date('YmsHis').substr($nums,-5);	 
		  $idtamu = $waiter.date('YmsHis');	 
		  $sql  = "insert into tr_tamu (cIdTamu,dTglMasuk,cFlag,cKdCustomer,vNmTamu,cKdTable,cJmlTamu,cTelp,cAlamat,cEmail,cStatus,cWaiter, ";
		  $sql .= "cKdEntity,cUserCreated,dDateCreated,cUserModify,dDateModify) ";
		  $sql .= "values('$idtamu',CURRENT_TIMESTAMP,'$flag',$kode_customer,'$name_customer',";
		  $sql .= "'$kode_meja',$jumlah_tamu,'$telp','$alamat','$email','O',$waiter, ";
		  $sql .= "NULL,'$_SESSION[Logged]',CURRENT_TIMESTAMP,'$_SESSION[Logged]',CURRENT_TIMESTAMP) ";
		  $rs = $conn->Execute($sql); 
		  //echo $sql; 
		  if(!$rs){
		    $message["message"] = "Failed. Error ".$conn->ErrorMsg();
		    $message["success"] = false;	
		    $message["idtamu"] = "";
		    $message["code"] = 202;
		  }else{
		    if(($flag=="DL") && (trim($email)!="")){
			  dosendinfodelivery($idtamu,trim($email),trim($name_customer));
			}
			$message["idtamu"] = $idtamu;
		  }
		}

		function docheckout(){ 
		global $conn, $config, $message;
		global $idtamu,$waiter,$flag,$kode_meja,$jumlah_tamu,$status,$kode_customer,$name_customer;
		
		  $sql  = "SELECT COUNT(*) as jml FROM tr_tamu WHERE cStatus = 'O' AND cKdTable='$kode_meja' ";   
		  $rs = $conn->Execute($sql);
		  if($rs->fields["jml"]>0){
			$sql = "UPDATE tr_tamu SET cStatus='F' WHERE cStatus = 'O' AND cKdTable='$kode_meja' ";
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
		}

		function dofinish(){ 
		global $conn, $config, $message;
		global $idtamu,$waiter,$flag,$kode_meja,$jumlah_tamu,$status,$kode_customer,$name_customer;
		
		  $sql  = "SELECT COUNT(*) as jml FROM tr_tamu WHERE cStatus = 'O' AND cIdTamu='$idtamu' ";   
		  $rs = $conn->Execute($sql);
		  if($rs->fields["jml"]>0){
			$sql = "UPDATE tr_tamu SET cStatus='F' WHERE cStatus = 'O' AND cIdTamu='$idtamu' ";
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
		}

		function doupdate(){ 
		global $conn, $config, $message;
		global $idtamu,$waiter,$flag,$kode_meja,$jumlah_tamu,$status,$kode_customer,$name_customer;
		
		  $sql = "SELECT cIdTamu FROM tr_tamu WHERE cStatus = 'O' AND cKdTable='$kode_meja' ";   
		  $rs = $conn->Execute($sql);
		  $idtamu = $rs->fields["cIdTamu"];
		  if($rs->fields["cIdTamu"]!=""){
			  $sql  = "update tr_tamu set cFlag='$flag',cKdCustomer=$kode_customer,vNmTamu='$name_customer',cJmlTamu=$jumlah_tamu, ";
			  $sql .= "cUserModify='$waiter',dDateModify=CURRENT_TIMESTAMP ";
			  $sql .= "where cIdTamu='$idtamu' ";
			  $rs = $conn->Execute($sql); 
			  if(!$rs){
				$message["message"] = "Failed. Error ".$conn->ErrorMsg();
				$message["success"] = false;	
				$message["idtamu"] = "";
				$message["code"] = 202;
			  }else{
				$message["idtamu"] = $idtamu;
			  }
		  }else{
			$message["message"] = "Update failed";
			$message["success"] = false;	
			$message["code"] = 202;
		  }

		}

		function dopindahhmeja(){ 
		global $conn, $config, $message;
		global $idtamu,$waiter,$flag,$kode_meja,$jumlah_tamu,$status,$kode_customer,$name_customer,$kode_meja_update;
		
		  $sql = "SELECT cIdTamu FROM tr_tamu WHERE cStatus = 'O' AND cKdTable='$kode_meja' ";   
		  $rs = $conn->Execute($sql);
		  $idtamu = $rs->fields["cIdTamu"];
		  if($rs->fields["cIdTamu"]!=""){
			  $sql  = "update tr_tamu set cKdTable='$kode_meja_update', ";
			  $sql .= "cUserModify='$waiter',dDateModify=CURRENT_TIMESTAMP ";
			  $sql .= "where cIdTamu='$idtamu' ";
			  $rs = $conn->Execute($sql); 
			  if(!$rs){
				$message["message"] = "Failed. Error ".$conn->ErrorMsg();
				$message["success"] = false;	
				$message["idtamu"] = "";
				$message["code"] = 202;
			  }else{
				$message["idtamu"] = $idtamu;
			  }
		  }else{
			$message["message"] = "Update failed";
			$message["success"] = false;	
			$message["code"] = 202;
		  }

		}

		function getidtamu(){ 
		global $conn, $config, $message;
		global $idtamu,$waiter,$flag,$kode_meja,$jumlah_tamu,$status,$kode_customer,$name_customer;
		
		  $sql = "SELECT cIdTamu FROM tr_tamu WHERE cStatus = 'O' AND cKdTable='$kode_meja' ";   
		  $rs = $conn->Execute($sql);
		  if($rs->fields["cIdTamu"]!=""){
		    $message["idtamu"] = $rs->fields["cIdTamu"];  
		  }else{
			$message["message"] = "Data not found";
			$message["success"] = false;	
			$message["code"] = 202;
		  }
		}

		function gettamu_takeaway(){ 
		global $conn, $config, $message;
		global $idtamu,$waiter,$flag,$kode_meja,$jumlah_tamu,$status,$kode_customer,$name_customer;
		
		  $sql = "SELECT * FROM tr_tamu WHERE cStatus = 'O' AND cFlag='TA' order by dTglMasuk ";   
		  $rs = $conn->Execute($sql);
		  if($rs->RecordCount()>0){
			$message["takeaway"] = array();
			while(!$rs->EOF){
			  $datas = array();
			  $datas["idtamu"] = $rs->fields["cIdTamu"];
			  $datas["tglmasuk"] = $rs->fields["dTglMasuk"];
			  $datas["kode_customer"] = $rs->fields["cKdCustomer"];
			  $datas["name_customer"] = $rs->fields["vNmTamu"];
			  $datas["kode_meja"] = $rs->fields["cKdTable"];
			  $datas["jumlah_tamu"] = $rs->fields["cJmlTamu"];
			  $datas["status"] = $rs->fields["cStatus"];
			  $datas["userid"] = $rs->fields["cWaiter"];
			  $message["takeaway"][] = $datas;
			  $rs->MoveNext();
			}
			$rs->Close();
		  }else{
			$message["message"] = "Data not found";
			$message["success"] = false;	
			$message["code"] = 202;
		  }
		}

		function gettamu_delivery(){ 
		global $conn, $config, $message;
		global $idtamu,$waiter,$flag,$kode_meja,$jumlah_tamu,$status,$kode_customer,$name_customer;
		
		  $sql = "SELECT * FROM tr_tamu WHERE cStatus = 'O' AND cFlag='DL' order by dTglMasuk ";   
		  $rs = $conn->Execute($sql);
		  if($rs->RecordCount()>0){
			$message["delivery"] = array();
			while(!$rs->EOF){
			  $datas = array();
			  $datas["idtamu"] = $rs->fields["cIdTamu"];
			  $datas["tglmasuk"] = $rs->fields["dTglMasuk"];
			  $datas["kode_customer"] = $rs->fields["cKdCustomer"];
			  $datas["name_customer"] = $rs->fields["vNmTamu"];
			  $datas["kode_meja"] = $rs->fields["cKdTable"];
			  $datas["jumlah_tamu"] = $rs->fields["cJmlTamu"];
			  $datas["status"] = $rs->fields["cStatus"];
			  $datas["userid"] = $rs->fields["cWaiter"];
			  $message["delivery"][] = $datas;
			  $rs->MoveNext();
			}
			$rs->Close();
		  }else{
			$message["message"] = "Data not found";
			$message["success"] = false;	
			$message["code"] = 202;
		  }
		}

		switch($act){
		  case "checkin":
		   $msg = doinsert(); 
		  break;
		  case "checkout":
		   $msg = docheckout(); 
		  break;
		  case "finish":
		   $msg = dofinish(); 
		  break;
		  case "update":
		   $msg = doupdate(); 
		  break;
		  case "getidtamu":
		   $msg = getidtamu(); 
		  break;
		  case "pindahmeja":
		   $msg = dopindahhmeja(); 
		  break;
		  case "takeaway":
		   $msg = gettamu_takeaway(); 
		  break;
		  case "delivery":
		   $msg = gettamu_delivery(); 
		  break;
		}


		echo json_encode($message);
	}
?>