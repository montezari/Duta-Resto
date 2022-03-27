<?php
require_once "../includes/global.inc.php";

	$message = array();
	$message["message"] = "Succsess login";
	$message["success"] = true;	
	$message["code"] = 200;

	$sql  = "SELECT * FROM ".$config["db_mst"].".ms_grupbarang WHERE cShowAndroid = 'T' ORDER BY cPaket, vNmGrupBarang ";
	$rs = $conn->Execute($sql);
	$message["kategori"] = array();
	while(!$rs->EOF){ 
		$prod = array();
		$prod["kode_kategori"] = $rs->fields["cKdGrupBarang"];
		$prod["judul_kategori"] = $rs->fields["vNmGrupBarang"];
		$message["kategori"][] = $prod;
	  $rs->MoveNext();
	}
    $rs->Close();

	$sql  = "SELECT brg.*, ";
	$sql .= "CASE WHEN vImagePath <> '' THEN CONCAT('".$config["http_url"]."',vImagePath) ";
	$sql .= "ELSE CONCAT('".$config["http_url"]."','/uploads/files/no_thumb.jpg') end  as cImagePath, ";
	$sql .= "grp.vNmGrupBarang, brg.cKeterangan ";
	//$sql .= "FROM ".$config["db_mst"].".ms_barang brg ";
	$sql .= "FROM ( ";
    $sql .= "SELECT cKdBarang, vNamaBarang, cSatuan, vHargaJual, cKdGrupBarang, vImagePath, cShowAndroid, 'F' as cPaket, cKeterangan ";
	$sql .= "FROM ".$config["db_mst"].".ms_barang ";
	$sql .= "UNION ALL ";
	$sql .= "SELECT cKdPaket, vNmPaket, '', vHargaJual, cKdGrupBarang, vImagePath, 'T' as cShowAndroid, 'T' as cPaket, cKeterangan ";
	$sql .= "FROM ".$config["db_mst"].".ms_pakethd ";
	$sql .= ") brg ";
	$sql .= "LEFT JOIN (SELECT cKdGrupBarang,vNmGrupBarang FROM ".$config["db_mst"].".ms_grupbarang WHERE cShowAndroid = 'T') grp ";
	$sql .= "ON grp.cKdGrupBarang = brg.cKdGrupBarang ";
	$sql .= "WHERE brg.cShowAndroid = 'T' ";
	$sql .= "ORDER BY grp.vNmGrupBarang, brg.vNamaBarang ";
	$rs = $conn->Execute($sql);
	$message["product"] = array();
	while(!$rs->EOF){
	  $prod = array();
	  $prod["kode_product"] = $rs->fields["cKdBarang"];
      $prod["description"] = $rs->fields["vNamaBarang"];
      $prod["keterangan"] = $rs->fields["cKeterangan"];
      $prod["satuan"] = $rs->fields["cSatuan"];
	  $prod["qty"] = 0;
	  $prod["unit_price"] = round($rs->fields["vHargaJual"]);
	  $prod["kode_kategori"] = $rs->fields["cKdGrupBarang"];
      $prod["image_product"] = $rs->fields["cImagePath"];
	  $prod["detail"] = array();
	  if($rs->fields["cPaket"]=="T"){
	    $sql  = "SELECT dt.cKdBarang, brg.vNamaBarang, brg.cSatuan, '0' as vHargaJual FROM ".$config["db_mst"].".ms_paketbrgdt dt ";
		$sql .= "LEFT JOIN ".$config["db_mst"].".ms_barang brg ON dt.cKdBarang = brg.cKdBarang WHERE cKdPaket = '".$rs->fields["cKdBarang"]."' ";
		$sql .= "ORDER BY brg.vNamaBarang ";
		$rsdet = $conn->Execute($sql);
		while(!$rsdet->EOF){
	      $detail = array();
		  $detail["kode_product"] = $rsdet->fields["cKdBarang"];
		  $detail["description"] = $rsdet->fields["vNamaBarang"];
		  //$detail["satuan"] = $rsdet->fields["cSatuan"];
		  //$detail["unit_price"] = round($rsdet->fields["vHargaJual"]);
		  $rsdet->MoveNext();
		}
		$rsdet->Close();
	    $prod["detail"][] = $detail;	
	  }else{
		$detail = [];
		$prod["detail"] = [];
		//$prod["detail"][] = array([''=>'']);
		//$prod["detail"] = '';	
	  }
	  $message["product"][] = $prod;
	  $rs->MoveNext();
	}
    $rs->Close();
	echo json_encode($message);

?>