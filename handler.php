<?php
  require_once "includes/global.inc.php";

  $mainTpl = new TMainPage();
  //$mm = new TMainMenu();
  //$mainTpl->mainmenu = $mm->Build($_SESSION["Logged"]);
  $content = "Modul tidak diketemukan...!!!";
  $css_js  = setcss_js();
  $idxmodul = "index"; $namamodul = ""; 
  $notrans_form = ""; $qrbarc_form = "";
  if(isset($_REQUEST["m"]) && $_REQUEST["m"] != ""){
	list($m,$f) = explode(".",$_REQUEST["m"]);
    $modpath = "modules/$m/$f.php";
	switch ($m) {
		case "user":
		  $namamodul = "System Manager";
		  $idxmodul = "";
		break;
		case "master":
		  $namamodul = "Master Data";
		  $idxmodul = "";
		break;
		case "trans":
		  $namamodul = "Transaction";	
		  $idxmodul = "";
		break;
		case "report":
		  $namamodul = "Reports";	
		  $idxmodul = "";
		break;
	}
	if($m!="admin"){
	  if(isset($_SESSION["Logged"])){
      //if(isset($_SESSION["Logged"]) && $mm->isakses($_SESSION["Logged"],$_REQUEST["m"])){
		if($_GET["mode"] != "form"){
		  //$button["A"] = $sm->Modules[$modId[0]][$modId[1]]->Write  == "1" ? "valid" : "";
		  //$button["E"] = $sm->Modules[$modId[0]][$modId[1]]->Change == "1" ? "valid" : "";
		  //$button["D"] = $sm->Modules[$modId[0]][$modId[1]]->Delete == "1" ? "valid" : "";
		  $button["A"] = "valid";
		  $button["E"] = "valid";
		  $button["D"] = "valid";
		}	
	  }else{  
		echo "<script>alert('Anda tidak mendapatkan akses modul ini.');</script>";
        echo "<script>window.location = 'index.php'</script>";
	  }
	}
    $modpath = "modules/$m/$f.php"; 
    if(file_exists($modpath)){
	  include($modpath);
    }
  }elseif(isset($_SESSION["Logged"])){
	$sql = "SELECT cFlag FROM ".$config["db_mst"].".ms_pegawai WHERE cKdPegawai = '$_SESSION[KdPegawai]' ";	
	$rs = $conn->Execute($sql);
	$usrflag = $rs->fields["cFlag"];
	switch ($usrflag) {
		case "9":
		  $moduleid = "index";	
		  $fpageTpl = new TTemplate("index.content");
		break;
		case "4":
		  $idxmodul = "orders";
		  $moduleid = "kitchen.list";
		  $fpageTpl = new TTemplate("index.kitchen");
		break;
		default:
		  $moduleid = "index";	
		  $fpageTpl = new TTemplate("index.content");
	}
    /********************** dashboard ***********************/
	$dateparam = date('Y-m-d');
	// type order	
	$sql  = "SELECT COUNT(*) AS jml FROM tr_tamu ";
    $rs = $conn->Execute($sql);
    $byk = $rs->fields["jml"]>0 ? $rs->fields["jml"] : 1;
	$sql  = "SELECT mst.cId, COALESCE(dt.jml,0) AS jml FROM ";
	$sql .= "(SELECT CAST('DI' AS CHAR(2)) AS cId UNION ALL SELECT CAST('TA' AS CHAR(2)) AS cId UNION ALL SELECT CAST('DL' AS CHAR(2)) AS cId) mst ";
	$sql .= "LEFT JOIN (";
	$sql .= "SELECT cFlag, COUNT(*) AS jml FROM tr_tamu WHERE MONTH(dTglMasuk)=MONTH(CURRENT_DATE()) AND YEAR(dTglMasuk)=YEAR(CURRENT_DATE()) GROUP BY cFlag";
	$sql .= ") dt ON dt.cFlag = mst.cId ";
    $rs = $conn->Execute($sql);
	while(!$rs->EOF){
	  if($rs->fields["cId"]=="DI"){
	    $typeord_di = ($rs->fields["jml"]/$byk)*100;
	  }elseif($rs->fields["cId"]=="TA"){
	    $typeord_ta = ($rs->fields["jml"]/$byk)*100;
	  }elseif($rs->fields["cId"]=="DL"){
		$typeord_dl = ($rs->fields["jml"]/$byk)*100;
	  }
	  $rs->MoveNext();
	}
	$rs->Close();

	$TypeOrderTpl = new TTemplate("index.content.typeorder");
    $TypeOrderTpl->moduleid = "index.content.typeorder";
    $typeorder = $TypeOrderTpl->Show(false);

	// sales summary
	$sql  = "SELECT SUM(nInvNetto) as nInvNetto, COUNT(*) AS jml FROM tr_fakturhd WHERE DATE_FORMAT(dTglInv,'%Y-%m-%d') = '$dateparam' ";
    $SalesSumTpl = new TSQLTemplate("index.content.salessum");
    $SalesSumTpl->moduleid = "index.content.salessum";
    $SalesSumTpl->SQL = $sql;
    $salessum = $SalesSumTpl->Show(false);
	
	// distribution index
	$sql  = "SELECT SUM(nInvNetto) nInvNetto FROM tr_fakturhd WHERE DATE_FORMAT(dTglInv,'%Y-%m-%d') = '2015-02-27' ";
    $DistIndexTpl = new TSQLTemplate("index.content.dist");
    $DistIndexTpl->moduleid = "index.content.dist";
    $DistIndexTpl->SQL = $sql;
    $distindex = $DistIndexTpl->Show(false);

	// ap jatuh tempo
    $sql  = "SELECT hd.cIdPO, hd.cNoPO, hd.dTglPO, hd.dTglJT, supp.vNmSupplier, hd.nGrandTotal, ";
    $sql .= "COALESCE(ret.nTotalRetur,0) AS nTotalRetur, COALESCE(hd.nTotalPay,0) AS nTotalPay, "; 
    $sql .= "hd.nGrandTotal-COALESCE(ret.nTotalRetur,0)-COALESCE(hd.nTotalPay,0) AS nSaldo, ";
    $sql .= "CASE WHEN datediff(hd.dTglJT,CURRENT_DATE())<0 THEN 'Over Due' ";
	$sql .= "WHEN (datediff(hd.dTglJT,CURRENT_DATE())>0) and (datediff(hd.dTglJT,CURRENT_DATE())<=15) THEN 'Must Pay' ELSE 'On Progress' END as cFlag, ";
    $sql .= "CASE WHEN datediff(hd.dTglJT,CURRENT_DATE())<0 THEN 'label label-danger label-sm' ";
	$sql .= "WHEN (datediff(hd.dTglJT,CURRENT_DATE())>0) and (datediff(hd.dTglJT,CURRENT_DATE())<=15) THEN 'label label-warning label-sm' ";
	$sql .= "ELSE 'label label-success label-sm' END as cClass ";
	$sql .= "FROM tr_appohd hd "; 
    $sql .= "LEFT JOIN ".$config["db_mst"].".ms_supplier supp ON supp.cKdSupplier = hd.cKdSupplier "; 
    $sql .= "LEFT JOIN ( ";
    $sql .= "  SELECT ret.cIdPO, SUM(ret.nQtyRetur*po.nHarga) AS nTotalRetur "; 
    $sql .= "  FROM tr_apreturdt ret, tr_appodt po ";
    $sql .= "  WHERE ret.cIdPODt = po.cIdPODt "; 
    $sql .= "  GROUP BY ret.cIdPO ";
    $sql .= ") ret ON ret.cIdPO = hd.cIdPO ";
    $sql .= "WHERE (COALESCE(hd.nGrandTotal,0)-COALESCE(ret.nTotalRetur,0)) <> COALESCE(hd.nTotalPay,0) "; 
    $sql .= "ORDER BY hd.dTglJT LIMIT 0,5 ";
    $APOverDueTpl = new TSQLTemplate("index.content.apduedate");
    $APOverDueTpl->moduleid = "index.content.apduedate";
    $APOverDueTpl->SQL = $sql;
    $apoverdue = $APOverDueTpl->Show(false);
    /********************** end dashboard ***********************/
	
	$content = $fpageTpl->Show(false);
  }

if(!isset($_SESSION["Logged"])){
  $fpageTpl = new TTemplate("sm.frmlogin");
  $content = $fpageTpl->Show(false);
}else{
  $sql = "SELECT cKdPegawai, vNamaPegawai FROM ".$config["db_mst"].".ms_pegawai WHERE cPelayan = 'T' ORDER BY vNamaPegawai ";
  $fTeamTpl = new TSQLTemplate("index.employee");
  $fTeamTpl->moduleid = "index.employee";
  $fTeamTpl->SQL = $sql;
  $team_status = $fTeamTpl->Show(false);
}

$mainTpl->content = $content;

?>