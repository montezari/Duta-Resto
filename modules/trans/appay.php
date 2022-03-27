<?php

$mode = $_REQUEST["mode"] == "form" ? 1 : 0;
$moduleid = "trans.appay";

if(strtoupper($_POST["FormAction"])=="SIMPAN"){
  $notrans = settransno("PAY");
  $novch = settransno("VCH");
  if($_POST["tgl"]!=""){
	$tgl = explode("/",$_POST["tgl"]);
	$tgltrans = $tgl[2]."-".$tgl[1]."-".$tgl[0];
  }else{
	$tgltrans = date('Y-m-d');
  }
  $totalpay = (isset($_POST["payment"]) && $_POST["payment"]!="") ? str_replace(",","",$_POST["payment"]) : "0";
  $sql  = "insert into tr_appaymenthd (cNoPay,dTglPay,cKdSupplier,nTotalPay,cNoVoucher,cKeterangan,cStatus,";
  $sql .= "cKdEntity,cUserCreated,dDateCreated,cUserModify,dDateModify) ";
  $sql .= "values('$notrans','$tgltrans','$_POST[kdsupp]','$totalpay','$novch','','O', ";
  $sql .= "NULL,'$_SESSION[Logged]',CURRENT_TIMESTAMP,'$_SESSION[Logged]',CURRENT_TIMESTAMP) ";
  $conn->Execute($sql); 
  $dokID  = $conn->Insert_ID();
  // insert detail
  $sql  = "delete from tr_appaymentdt where cIdAPPay = '$dokID' ";
  $conn->Execute($sql);
  foreach($_POST["nopo"] as $k=>$v){
    if($_POST["podate"][$k]!=""){
	  $tgl = explode("/",$_POST["podate"][$k]);
	  $tglpo = $tgl[2]."-".$tgl[1]."-".$tgl[0];
    }else{
	  $tglpo = "NULL";
    }
    $remain = (isset($_POST["remain"][$k]) && $_POST["remain"][$k]!="") ? str_replace(",","",$_POST["remain"][$k]) : "0";
    $pay = (isset($_POST["pay"][$k]) && $_POST["pay"][$k]!="") ? str_replace(",","",$_POST["pay"][$k]) : "0";
	$sql  = "INSERT INTO tr_appaymentdt (cIdAPPay,cIdPO,cNoPay,dTglPay,cNoPO,dTglPO,nTotalInv,nPayment) ";
    $sql .= "VALUES ('$dokID','".$_POST["idpo"][$k]."','$notrans','$tgltrans','".$_POST["nopo"][$k]."','$tglpo',";	
    $sql .= "'$remain','$pay')";
	$conn->Execute($sql);
    $sql  = "UPDATE tr_appohd SET nTotalPay = COALESCE(nTotalPay,0)+$pay WHERE cIdPO = '".$_POST["idpo"][$k]."' ";  
	$conn->Execute($sql);
  }
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}

$admGrdTpl = new TGridTemplate($moduleid);
$sql  = "SELECT hd.cKdSupplier, supp.vNmSupplier, MIN(hd.dTglJT) AS dTglJT, SUM(hd.nGrandTotal) AS nGrandTotal, ";
$sql .= "SUM(COALESCE(ret.nTotalRetur,0)) AS nTotalRetur, SUM(COALESCE(hd.nTotalPay,0)) AS nTotalPay, "; 
$sql .= "SUM(hd.nGrandTotal)-SUM(COALESCE(ret.nTotalRetur,0))-SUM(COALESCE(hd.nTotalPay,0)) AS nSaldo, count(*) as jml ";
$sql .= "FROM tr_appohd hd "; 
$sql .= "LEFT JOIN ( ";
$sql .= "  SELECT ret.cIdPO, SUM(ret.nQtyRetur*po.nHarga) AS nTotalRetur "; 
$sql .= "  FROM tr_apreturdt ret, tr_appodt po ";
$sql .= "  WHERE ret.cIdPODt = po.cIdPODt "; 
$sql .= "  GROUP BY ret.cIdPO "; 
$sql .= ") ret ON ret.cIdPO = hd.cIdPO ";
$sql .= "LEFT JOIN ".$config["db_mst"].".ms_supplier supp ON supp.cKdSupplier = hd.cKdSupplier "; 
if($_GET["key"] != "" || $_GET["mode"] == "form"){
  $sql .= " WHERE hd.cKdSupplier = '$_GET[key]' ";
}
$sql .= "GROUP BY hd.cKdSupplier, supp.vNmSupplier ";
$sql .= "HAVING SUM(hd.nGrandTotal)-SUM(COALESCE(ret.nTotalRetur,0))-SUM(COALESCE(hd.nTotalPay,0)) <> 0 ";
$sql .= "ORDER BY MIN(hd.dTglJT) "; 

$admGrdTpl->moduleid  = $moduleid;
$admGrdTpl->delform   = "m=$moduleid&page=$_GET[page]";
$admGrdTpl->custSQL = $sql;
$gTpl = new TBlock("form.general_box");

if($mode=="1"){
  $sql  = "SELECT hd.cIdPO, hd.cNoPO, hd.dTglPO, hd.dTglJT, hd.nGrandTotal, COALESCE(ret.nTotalRetur,0) AS nTotalRetur, COALESCE(hd.nTotalPay,0) AS nTotalPay, "; 
  $sql .= "hd.nGrandTotal-COALESCE(ret.nTotalRetur,0)-COALESCE(hd.nTotalPay,0) AS nSaldo ";
  $sql .= "FROM tr_appohd hd "; 
  $sql .= "LEFT JOIN ( ";
  $sql .= "  SELECT ret.cIdPO, SUM(ret.nQtyRetur*po.nHarga) AS nTotalRetur "; 
  $sql .= "  FROM tr_apreturdt ret, tr_appodt po ";
  $sql .= "  WHERE ret.cIdPODt = po.cIdPODt "; 
  $sql .= "  GROUP BY ret.cIdPO ";
  $sql .= ") ret ON ret.cIdPO = hd.cIdPO ";
  $sql .= "WHERE (COALESCE(hd.nGrandTotal,0)-COALESCE(ret.nTotalRetur,0)) <> COALESCE(hd.nTotalPay,0) "; 
  $sql .= "AND hd.cKdSupplier = '$_GET[key]' ";
  $sql .= "ORDER BY hd.dTglJT "; 
  $admGrdTpl->template->MergeBlock("grid_dtl","adodb",$sql);
}

$gTpl->name		= "gTpl";
$gTpl->title    = "AP Payment";
$gTpl->display  = $admGrdTpl->Show(false);
$content = $gTpl->Show(false);

?>