<?php
require_once "../includes/global.inc.php";

$sql  = "SELECT COUNT(*) as jml FROM tr_pesananhd hd "; 
$sql .= "LEFT JOIN (SELECT cIdTamu, cStatus FROM tr_tamu) tm ON tm.cIdTamu = hd.cIdTamu ";
$sql .= "WHERE tm.cStatus = 'O' AND hd.cStatus = 'K' AND hd.cStatKitchen = 'O' ";
$rs = $conn->Execute($sql);
$jml = $rs->fields["jml"];

$data['current'] = $jml;
$data['neworder'] = "";
$data['infopesanan'] = "";
$data['update'] = false;
if(($_POST['counter']!="") && ($_POST['counter']!=$jml)){
	$data['update'] = true;
	$data['neworder'] = $jml>0 ? "<span class='badge badge-red font-11'>".$jml."</span>" : "";
    
	$tpl = new TSQLTemplate("kitchen.neworder","../template/");
	$tpl->moduleid = "kitchen.listpercust";
	$sql  = "SELECT hd.cKdPesanan, hd.cKdPesanan as IdPesanan, hd.dTglPesanan, ";
	$sql .= "DATE_FORMAT(dTglKirimKitchen,'%b %d, %Y %H:%s') AS dTglKirimKitchen, tm.vNmTamu, tbl.vNmTable ";
	$sql .= "FROM tr_pesananhd hd ";
	$sql .= "LEFT JOIN (SELECT cIdTamu, vNmTamu, cKdTable, cStatus FROM tr_tamu) tm ON tm.cIdTamu = hd.cIdTamu ";
	$sql .= "LEFT JOIN ".$config["db_mst"].".ms_tablelayout tbl ON tbl.cKdTable = tm.cKdTable ";
	$sql .= "WHERE tm.cStatus = 'O' AND hd.cStatus = 'K' AND hd.cStatKitchen = 'O' ORDER BY hd.dTglKirimKitchen ";
	$tpl->SQL = $sql;
	$data['listcust'] = $tpl->Show(false);

	$sql  = "SELECT cKdPesanan as cid FROM tr_pesananhd hd ";
	$sql .= "WHERE hd.cStatus = 'K' AND hd.cStatKitchen = 'O' ORDER BY hd.dTglKirimKitchen LIMIT 0,1 ";
	$rs = $conn->Execute($sql);
	$idpesan = $rs->fields["cid"];

	$sql  = "SELECT hd.cKdPesanan, hd.cKdPesanan AS IdPesanan, tm.vNmTamu  FROM tr_pesananhd hd ";
	$sql .= "LEFT JOIN (SELECT cIdTamu, vNmTamu, cKdTable FROM tr_tamu) tm ON tm.cIdTamu = hd.cIdTamu ";
	$sql .= "WHERE hd.cKdPesanan = '$idpesan'";
	$rs = $conn->Execute($sql);
	$data['idpesanan'] = $rs->fields["IdPesanan"];
	$data['infopesanan'] = "<h5><strong>#".$rs->fields["IdPesanan"]."</strong> ".$rs->fields["vNmTamu"]."</h5>";
	
	$data['listorder'] = "";
	if(trim($data['idpesanan'])!=""){ 
	  $tpldt = new TSQLTemplate("kitchen.neworderdt","../template/");
	  $tpldt->moduleid = "kitchen.newlistorder";
	  $sql  = "SELECT dt.cIdx, dt.cKdPesananDt, dt.cKdPesanan, dt.cKdPesanan  as IdPesanan, ";
	  $sql .= "dt.cIdTamu, dt.cKdBarang, brg.vNamaBarang, dt.vQty, dt.cKeterangan ";
	  $sql .= "FROM tr_pesanandt dt ";
	  $sql .= "LEFT JOIN (SELECT cKdBarang, vNamaBarang FROM ".$config["db_mst"].".ms_barang) brg ON brg.cKdBarang = dt.cKdBarang ";
	  $sql .= "WHERE dt.cKdPesanan = '$idpesan' ";
	  $tpldt->SQL = $sql;
	  $data['listorder'] = $tpldt->Show(false);
	}

}

echo json_encode($data);
?>
