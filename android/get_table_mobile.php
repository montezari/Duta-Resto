<?php
require_once "../includes/global.inc.php";

		$message = array();
        $message["message"] = "Succsess";
		$message["success"] = true;	
		$message["code"] = 200;

		$sql  = "SELECT tbl.cKdTable, tbl.vNmTable, COALESCE(tm.cIdTamu,'') AS cIdTamu, COALESCE(tm.cKdCustomer,'') AS cKdCustomer, "; 
		$sql .= "COALESCE(tm.vNmTamu,'') AS vNmTamu, COALESCE(tm.cJmlTamu,0) AS cJmlTamu, COALESCE(tm.cStatus,'F') AS cStatus "; 
		$sql .= "FROM ".$config["db_mst"].".ms_tablelayout tbl ";
		$sql .= "LEFT JOIN (SELECT cIdTamu, cKdCustomer, vNmTamu, cKdTable, cJmlTamu, cStatus FROM tr_tamu WHERE cFlag = 'DI' AND cStatus = 'O') tm ";
		$sql .= "ON tm.cKdTable = tbl.cKdTable ";
		$sql .= "ORDER BY tbl.cKdTable";
		$rs = $conn->Execute($sql);
		$message["meja"] = array();
		while(!$rs->EOF){  
			$prod = array();
			$prod["idtamu"] = $rs->fields["cIdTamu"];
			$prod["kode_meja"] = $rs->fields["cKdTable"];
			$prod["nomer_meja"] = $rs->fields["vNmTable"];
			$prod["status"] = $rs->fields["cStatus"];
			$prod["jumlah_tamu"] = $rs->fields["cJmlTamu"];
			$prod["name_customer"] = $rs->fields["vNmTamu"];
			$message["meja"][] = $prod;
		  $rs->MoveNext();
		}
		$rs->Close();
		
		echo json_encode($message);
	?>