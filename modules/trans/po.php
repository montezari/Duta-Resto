<?php

$mode = $_REQUEST["mode"] == "form" ? 1 : 0;
if($_REQUEST["act"] == "bbm"){
  $mode = 2;  
}
if($_REQUEST["act"] == "retur"){
  $mode = 3;  
}
$moduleid = "trans.po";
$jenis = array('T'=>'CASH', 'K'=>'CREDIT');

if(strtoupper($_POST["FormAction"])=="SIMPAN"){
  $notrans = $_POST["nomor"];
  if($_POST["tgl"]!=""){
	$tgl = explode("/",$_POST["tgl"]);
	$tgltrans = $tgl[2]."-".$tgl[1]."-".$tgl[0];
  }else{
	$tgltrans = date('Y-m-d');
  }
  $termpay = isset($_POST["termpay"]) && $_POST["termpay"]!="" ? $_POST["termpay"] : 0;
  $pajak = isset($_POST["pajak"]) && $_POST["pajak"]!="" ? $_POST["pajak"] : "F";
  $total = (isset($_POST["result"]) && $_POST["result"]!="") ? str_replace(",","",$_POST["result"]) : "0";
  $tax = (isset($_POST["tax"]) && $_POST["tax"]!="") ? str_replace(",","",$_POST["tax"]) : "0";
  $taxpers = (isset($_POST["taxpers"]) && $_POST["taxpers"]!="") ? str_replace(",","",$_POST["taxpers"]) : "0";
  $discpers = (isset($_POST["discpers"]) && $_POST["discpers"]!="") ? str_replace(",","",$_POST["discpers"]) : "0";
  $disc = (isset($_POST["disc"]) && $_POST["disc"]!="") ? str_replace(",","",$_POST["disc"]) : "0";
  $biayalain = (isset($_POST["biayalain"]) && $_POST["biayalain"]!="") ? str_replace(",","",$_POST["biayalain"]) : "0";
  $grandtotal = (isset($_POST["grandtotal"]) && $_POST["grandtotal"]!="") ? str_replace(",","",$_POST["grandtotal"]) : "0";
  if($_POST["fact"]=="1"){
    // PO
	if($_POST["fkey"] != ""){
      $sql  = "update tr_appohd set dTglPO='$tgltrans', cKdSupplier = '$_POST[kodesupp]', cTermPay='$termpay', ";
	  $sql .= "dTglJT = DATE_ADD('$tgltrans',INTERVAL $termpay DAY), nTotal='$total', ";
	  $sql .= "cPajak='$pajak',nPersPajak='$taxpers', nPajak='$tax', nPersDiskon='$discpers', nDiskon='$disc', nBiayaLain='$biayalain', nGrandTotal='$grandtotal', ";
	  $sql .= "cKeterangan='$_POST[ket]', ";
	  $sql .= "cKdEntity = NULL, cUserModify = '$_SESSION[Logged]', dDateModify = CURRENT_TIMESTAMP ";
      $sql .= "where cIdPO = '$_POST[fkey]' ";
      $conn->Execute($sql); 
	  $dokID = $_POST["fkey"];
    }else{
      $notrans = settransno("PO");
      $sql  = "insert into tr_appohd (cNoPO, dTglPO, cKdSupplier, cJenisPay, cTermPay, dTglJT, nTotal, ";
	  $sql .= "cPajak, nPersPajak, nPajak, nPersDiskon, nDiskon, nBiayaLain, nGrandTotal, cKeterangan,cStatus, ";
	  $sql .= "cKdEntity, cUserCreated,dDateCreated,cUserModify,dDateModify) ";
      $sql .= "values('$notrans','$tgltrans','$_POST[kodesupp]','$_POST[jenis]','$termpay',";
	  $sql .= "DATE_ADD('$tgltrans',INTERVAL $termpay DAY),'$total',";
	  $sql .= "'$pajak','$taxpers','$tax','$discpers','$disc','$biayalain','$grandtotal','$_POST[ket]','O', ";
	  $sql .= "NULL,'$_SESSION[Logged]',CURRENT_TIMESTAMP,'$_SESSION[Logged]',CURRENT_TIMESTAMP) ";
      $conn->Execute($sql); 
	  $dokID  = $conn->Insert_ID();
    }
    // insert detail
    $sql  = "delete from tr_appodt where cIdPO = '$dokID' ";
    $conn->Execute($sql);
    foreach($_POST["kd_barang"] as $k=>$v){
      $sql  = "INSERT INTO tr_appodt (cIdPO,cNoPO,dTglPO,cKdBarang,nQtyBeli,cSatuan,nHarga,nTotalHarga) ";
      $sql .= "VALUES ('$dokID','$notrans','$tgltrans','".$_POST["kd_barang"][$k]."','".$_POST["val_qty"][$k]."',";	
	  $sql .= "'".$_POST["kd_satuan"][$k]."','".$_POST["harga"][$k]."','".$_POST["jumlah"][$k]."')";
	  $conn->Execute($sql);
    }
  }elseif($_POST["fact"]=="2"){
    // BBM
	$idpo = $_POST["fkey"];
	$nopo = $_POST["nopo"];
	$tglpo = $_POST["tglpo"];
	$notrans = settransno("GR");
	$sql  = "insert into tr_icbbmhd (cIdPO,cNoPO, dTglPO, cNoBBM, dTglBBM, cKdSupplier, cKeterangan, cStatus, ";
	$sql .= "cKdEntity, cUserCreated,dDateCreated,cUserModify,dDateModify) ";
	$sql .= "values('$idpo','$nopo','$tglpo','$notrans','$tgltrans','$_POST[kodesupp]','$_POST[ket]','O', ";
	$sql .= "NULL,'$_SESSION[Logged]',CURRENT_TIMESTAMP,'$_SESSION[Logged]',CURRENT_TIMESTAMP) ";
	$conn->Execute($sql); 
	$dokID  = $conn->Insert_ID();
    // insert detail
    foreach($_POST["kd_barang"] as $k=>$v){
      $sql  = "INSERT INTO tr_icbbmdt (cIdBBM,cIdPODt,cIdPO,cNoBBM,dTglBBM,cNoPO,dTglPO,cKdBarang,nQtyBBM,cSatuan) ";
      $sql .= "VALUES ('$dokID','".$_POST["id_podt"][$k]."','$idpo','$notrans','$tgltrans','$nopo','$tglpo', ";
	  $sql .= "'".$_POST["kd_barang"][$k]."','".$_POST["val_saldo"][$k]."','".$_POST["kd_satuan"][$k]."')";
	  $conn->Execute($sql);
    }
  }elseif($_POST["fact"]=="3"){
    // RETUR
	$idpo = $_POST["fkey"];
	$nopo = $_POST["nopo"];
	$tglpo = $_POST["tglpo"];
	$notrans = settransno("RETURN");
	$sql  = "insert into tr_apreturhd (cIdPO,cNoPO, dTglPO, cNoRetur, dTglRetur, cKdSupplier, cKeterangan, cStatus, ";
	$sql .= "cKdEntity, cUserCreated,dDateCreated,cUserModify,dDateModify) ";
	$sql .= "values('$idpo','$nopo','$tglpo','$notrans','$tgltrans','$_POST[kodesupp]','$_POST[ket]','O', ";
	$sql .= "NULL,'$_SESSION[Logged]',CURRENT_TIMESTAMP,'$_SESSION[Logged]',CURRENT_TIMESTAMP) ";
	$conn->Execute($sql); 
	$dokID  = $conn->Insert_ID();
    // insert detail
    foreach($_POST["kd_barang"] as $k=>$v){
      $sql  = "INSERT INTO tr_apreturdt (cIdRetur,cIdPODt,cIdPO,cNoRetur,dTglRetur,cNoPO,dTglPO,cKdBarang,nQtyRetur,cSatuan) ";
      $sql .= "VALUES ('$dokID','".$_POST["id_podt"][$k]."','$idpo','$notrans','$tgltrans','$nopo','$tglpo', ";
	  $sql .= "'".$_POST["kd_barang"][$k]."','".$_POST["val_saldo"][$k]."','".$_POST["kd_satuan"][$k]."')";
	  $conn->Execute($sql);
    }
  }
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}elseif(strtoupper($_POST["FormAction"])=="HAPUS"){
  $sql = "delete from tr_appodt where cIdPO = '$_POST[fkey]' ";
  $conn->Execute($sql);
  $sql = "delete from tr_appohd where cIdPO = '$_POST[fkey]' ";
  $conn->Execute($sql);
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}

$admGrdTpl = new TGridTemplate($moduleid);
$sql  = "select hd.*, supp.vNmSupplier, '$mode' as cFlag "; 
$sql .= "from tr_appohd hd ";
$sql .= "LEFT JOIN ".$config["db_mst"].".ms_supplier supp ON supp.cKdSupplier = hd.cKdSupplier ";
if($_GET["key"] != "" || $_GET["mode"] == "form"){
  $sql .= " WHERE hd.cIdPO = '$_GET[key]' ";
}
$sql .= "ORDER BY hd.cIdPO DESC ";

$admGrdTpl->moduleid  = $moduleid;
$admGrdTpl->delform   = "m=$moduleid&page=$_GET[page]";
$admGrdTpl->custSQL = $sql;
if($mode=="1"){
  $admGrdTpl->template->MergeBlock("blk_jns",$jenis);
  $sql  = "SELECT dt.*, brg.vNamaBarang, sat.cAlias FROM tr_appodt dt ";
  $sql .= "LEFT JOIN ".$config["db_mst"].".ms_barang brg ON brg.cKdBarang = dt.cKdBarang ";
  $sql .= "LEFT JOIN ".$config["db_mst"].".ms_satuan sat ON sat.cSatuan = dt.cSatuan ";
  $sql .= "WHERE dt.cIdPO = '$_GET[key]' ";
  $admGrdTpl->template->MergeBlock("grid_dtl","adodb",$sql);
}else if(($mode=="2") || ($mode=="3")){
  $admGrdTpl->template->MergeBlock("blk_gud","adodb","SELECT cKdGudang, vNmGudang FROM ".$config["db_mst"].".ms_gudang ORDER BY cKdGudang");
  $sql  = "SELECT dt.*, brg.vNamaBarang, sat.cAlias, '$mode' as cFlag, ";
  $sql .= "COALESCE(bbm.nQtyBBM,0) AS nQtyBBM, COALESCE(retur.nQtyRetur,0) AS nQtyRetur, ";
  $sql .= "dt.nQtyBeli-COALESCE(retur.nQtyRetur,0)-COALESCE(bbm.nQtyBBM,0) AS nQtySaldo ";  
  $sql .= "FROM tr_appodt dt "; 
  $sql .= "LEFT JOIN ".$config["db_mst"].".ms_barang brg ON brg.cKdBarang = dt.cKdBarang "; 
  $sql .= "LEFT JOIN ".$config["db_mst"].".ms_satuan sat ON sat.cSatuan = dt.cSatuan "; 
  $sql .= "LEFT JOIN ( ";
  $sql .= "SELECT cIdPODt, cIdPO, cKdBarang, SUM(nQtyBBM) AS nQtyBBM "; 
  $sql .= "FROM tr_icbbmdt GROUP BY cIdPODt, cIdPO, cKdBarang ";
  $sql .= ") bbm ON bbm.cIdPODt = dt.cIdPODt AND bbm.cIdPO = dt.cIdPO AND bbm.cKdBarang = dt.cKdBarang ";
  $sql .= "LEFT JOIN ( ";
  $sql .= "SELECT cIdPODt, cIdPO, cKdBarang, SUM(nQtyRetur) AS nQtyRetur "; 
  $sql .= "FROM tr_apreturdt GROUP BY cIdPODt, cIdPO, cKdBarang ";
  $sql .= ") retur ON retur.cIdPODt = dt.cIdPODt AND retur.cIdPO = dt.cIdPO AND retur.cKdBarang = dt.cKdBarang "; 
  $sql .= "WHERE dt.cIdPO = '$_GET[key]' ";
  $admGrdTpl->template->MergeBlock("grid_dtl","adodb",$sql);
}
$gTpl = new TBlock("form.general_box");
$gTpl->name		= "gTpl";
$gTpl->title    = "Purchase Order ";
$gTpl->display  = $admGrdTpl->Show(false);
$content = $gTpl->Show(false);

?>