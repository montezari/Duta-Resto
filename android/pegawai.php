<?php
require_once "../includes/global.inc.php";

	$message = array();
	$message["message"] = "Succsess";
	$message["success"] = true;	
	$message["code"] = 200;
    
	// 0 : default, 1 : waiter, 2 : kasir, 3 waiter dan kasir, 4 : kitchen, 9 : management
	$sql  = "select * from ".$config["db_mst"].".ms_pegawai order by cFlag "; 
	$rs = $conn->Execute($sql);
	$message["pegawai"] = array();
	while(!$rs->EOF){  
		$datas = array();
		$datas["userid"] = $rs->fields["cKdPegawai"];
		$datas["namauser"] = $rs->fields["vNamaPegawai"];
		$datas["namasingkat"] = $rs->fields["vNmSingkat"];
		$datas["flag"] = $rs->fields["cFlag"];
		$datas["pin"] = $rs->fields["cPIN"];
		$message["pegawai"][] = $datas;
	  $rs->MoveNext();
	}
	$rs->Close();

	echo json_encode($message);
?>