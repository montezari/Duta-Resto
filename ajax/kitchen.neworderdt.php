<?php
require_once "../includes/global.inc.php";

if($_POST['idpesan']!=""){

	$data['idpesan'] = $_POST['idpesan'];
	$sql  = "SELECT hd.cKdPesanan, hd.cKdPesanan AS IdPesanan, tm.vNmTamu  FROM tr_pesananhd hd ";
	$sql .= "LEFT JOIN (SELECT cIdTamu, vNmTamu, cKdTable FROM tr_tamu) tm ON tm.cIdTamu = hd.cIdTamu ";
	$sql .= "WHERE hd.cKdPesanan = '".$_POST['idpesan']."'";
	$rs = $conn->Execute($sql);
	$data['idpesanan'] = $rs->fields["IdPesanan"];
	$data['infopesanan'] = "<h5><strong>#".$rs->fields["IdPesanan"]."</strong> ".$rs->fields["vNmTamu"]."</h5>";

	$tpldt = new TSQLTemplate("kitchen.neworderdt","../template/");
	$tpldt->moduleid = "kitchen.newlistorder";
	$sql  = "SELECT dt.cIdx, dt.cKdPesananDt, dt.cKdPesanan, dt.cKdPesanan  as IdPesanan, ";
	$sql .= "dt.cIdTamu, tm.vNmTamu, dt.cKdBarang, brg.vNamaBarang, dt.vQty, dt.cKeterangan ";
	$sql .= "FROM tr_pesanandt dt ";
	$sql .= "LEFT JOIN (SELECT cKdBarang, vNamaBarang FROM ".$config["db_mst"].".ms_barang) brg ON brg.cKdBarang = dt.cKdBarang ";
	$sql .= "LEFT JOIN (SELECT cIdTamu, vNmTamu, cKdTable FROM tr_tamu) tm ON tm.cIdTamu = dt.cIdTamu ";
	$sql .= "WHERE dt.cKdPesanan = '".$_POST['idpesan']."' ";
	$tpldt->SQL = $sql;
	$data['listorder'] = $tpldt->Show(false);

}

echo json_encode($data);
?>
