<?php
require_once "../includes/global.inc.php";

$page = $_GET['page'];
$limit = $_GET['rows']; 
$sidx = $_GET['sidx'];
$sord = $_GET['sord'];
$searchTerm = $_GET['searchTerm'];
if(!$sidx) $sidx =1;
if ($searchTerm=="") {
	$searchTerm="%";
} else {
	$searchTerm = "%" . $searchTerm . "%";
}

$sql = "SELECT COUNT(*) AS count FROM ".$config["db_mst"].".ms_barang WHERE vNmBarang like '$searchTerm' ";
$rs = $conn->Execute($sql);
$count = $rs->fields["count"];

if( $count >0 ) {
	$total_pages = ceil($count/$limit);
} else {
	$total_pages = 0;
}
if ($page > $total_pages) $page=$total_pages;
$start = $limit*$page - $limit; 

$sql  = "SELECT brg.cKdBarang, brg.vNamaBarang, grp.vNmGrupBarang, brg.cSatuan, sat.cAlias FROM ".$config["db_mst"].".ms_barang brg ";
$sql .= "LEFT JOIN (SELECT cKdGrupBarang, vNmGrupBarang FROM ".$config["db_mst"].".ms_grupbarang) grp ON grp.cKdGrupBarang = brg.cKdGrupBarang ";
$sql .= "LEFT JOIN (SELECT cSatuan, cAlias FROM ".$config["db_mst"].".ms_satuan) sat ON sat.cSatuan = brg.cSatuan ";

if($total_pages!=0) $sql = $sql." WHERE brg.vNamaBarang like '$searchTerm'  ORDER BY $sidx $sord LIMIT $start , $limit";
else $sql =  $sql." WHERE brg.vNamaBarang like '$searchTerm'  ORDER BY $sidx $sord";
$rs = $conn->Execute($sql);

$response->page = $page;
$response->total = $total_pages;
$response->records = $count;
$i=0;
while(!$rs->EOF){
  $response->rows[$i]["cKdBarang"]=$rs->fields["cKdBarang"];
  $response->rows[$i]["vNamaBarang"]=$rs->fields["vNamaBarang"];
  $response->rows[$i]["vNmGrupBarang"]=$rs->fields["vNmGrupBarang"];
  $response->rows[$i]["cSatuan"]=$rs->fields["cSatuan"];
  $response->rows[$i]["cAlias"]=$rs->fields["cAlias"];
  $i++;
  $rs->MoveNext();
}        
$rs->Close();

echo json_encode($response);

?>
